<?
/* =====================================================
  프로그램명 : 삼일교회 V4
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 2007-07-13
2007-07-13 header("Content-type: text/html; charset=euc-kr"); 추가
2010-01-28 RGBOARD_VERSION 상수 선언부분 config.php 에서 본 파일로 이동
 ===================================================== */
	// 삼일교회버전 2014-03-20 ver 4.3.2 (베타버전)
define('RGBOARD_VERSION', '4.3.2');
header("Content-type: text/html; charset=utf-8");

	set_magic_quotes_runtime(0);
	error_reporting(E_ALL ^ E_NOTICE);
//	error_reporting(E_ALL);
	
	// 외부에서 오는 변수 가져오기
	$_P = new variables_class($_POST); // POST 변수 가져오기
	$_G = new variables_class($_GET); // GET 변수 가져오기
	$_R = new variables_class($_REQUEST); // REQUEST 변수 가져오기
	$_C = new variables_class($_COOKIE); // COOKIE 변수 가져오기
	
	// site_path 와 site_url을 외부에서 입력하면 더이상 프로그램을 실행하지 않는다.
	if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	

	// 변수 초기화
	$_auth=false;			// 권한 초기화
	$_bbs_auth=false;	// 게시판 권한 초기화
	$_mb=false;				// 회원정보초기화
	$_group_info=false;	// 그룹정보 초기화
	$_bbs_info=false;	// 게시판정보 초기화

	// 메인 라이브러리
	include_once($site_path.'samil_include/config.php');
	include_once($_path['inc'].'func_comm.php');
	include_once($_path['inc'].'validate.php');
	include_once($_path['inc'].'class_db.php');
	include_once($_path['inc'].'php_browser_detection.php');

	$validate = new validate(); // 유효성검사

	// magic_quotes_gpc 가 설정된경우
	if(get_magic_quotes_gpc()) {
		ini_set('magic_quotes_sybase',0);
    rg_array_recursive_function($_GET, 'stripslashes');
    rg_array_recursive_function($_POST, 'stripslashes');
    rg_array_recursive_function($_COOKIE, 'stripslashes');
    rg_array_recursive_function($_REQUEST, 'stripslashes');
		include_once($_path['inc'].'register_globals.inc.php');
	} else if (!ini_get('register_globals')) {
	// register_globals 설정이 안되어 있을경우
		include_once($_path['inc'].'register_globals.inc.php');
	}
	
//	@session_set_cookie_params (0,'/',$main_domain);
	if(is_dir($_path['session']))
		@session_save_path($_path['session']);
  session_cache_limiter('nocache, must-revalidate');
  session_start();	

	$__dbconf=@file($_path['data'].'db_info.php');
	if(!$__dbconf) {
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		rg_href($_path['admin'].'main/install.php');
		exit;
	}
	if(count($__dbconf) < 9) {
		echo '데이타베이스 설정 파일에러.';
		exit;
	}
	
	for($i=0;$i<count($__dbconf);$i++) {
		$__dbconf[$i]=trim(str_replace("\n","",$__dbconf[$i]));
	}

	if($__dbconf[0] != '<'.'?' || $__dbconf[count($__dbconf)-1] != '?'.'>') {
		echo '데이타베이스 설정 파일에러..';
		exit;
	}
	
	for($i=2;$i<8;$i++) {
		$__dbconf[$i]=substr($__dbconf[$i],2);
	}
	
	switch($__dbconf[6]) // 디비종류
	{
		case 'CUBRID' :
			include_once($_path['inc'].'class_db_cubrid.php');
			define('DB_TYPE', 'cubrid');
		break;
		case 'ORACLE' :
			include_once($_path['inc'].'class_db_oracle.php');
			define('DB_TYPE', 'oracle');
		break;
		case 'MYSQL' :
			include_once($_path['inc'].'class_db_mysql.php');
			define('DB_TYPE', 'mysql');
		break;
	}
	
	$db_class=DB_TYPE.'_db_class';
	$rs_class=DB_TYPE.'_rs_class';
	
	$dbcon = new $db_class();
	$dbcon->set_debug(0);
	$dbcon->connect($__dbconf[2],$__dbconf[3],$__dbconf[4],$__dbconf[5],$__dbconf[7]);

	if(!is_object($dbcon) || !$dbcon->dbcon) {
		echo '데이타베이스 접속에러. 데이타베이스 정보를 확인해주세요.';
		exit;
	}
	
	@mysql_query('set names utf8');

	unset($__dbconf);
	$rs=new $rs_class($dbcon);
	$rs_list=new $rs_class($dbcon);

	$_site_info = rg_get_setup('site_info'); // 사이트 설정
	$_level_info = rg_get_setup('level_info'); 	// 레벨 정보

	// 로그인 되어 있는 상태라면 회원 정보를
	if(!empty($_SESSION['ss_login_ok'])	&& !empty($_SESSION['ss_mb_num']) &&
		 !empty($_SESSION['ss_mb_id']) 		&& !empty($_SESSION['ss_hash'])) {
	 	$_mb = rg_db_data_one($_table['member'],"mb_num={$_SESSION['ss_mb_num']} AND mb_id='{$_SESSION['ss_mb_id']}'");
		if(!$_mb) {
			// 로그인되어 있는 회원의 정보가 올바르지 않다면 로그아웃.
			// 비정상적인 접근
			$ss_mb_id='';
			$ss_mb_num='';
			$ss_login_ok='';
			$ss_hash='';
			$_SESSION['ss_mb_id']=$ss_mb_id;
			$_SESSION['ss_mb_num']=$ss_mb_num;
			$_SESSION['ss_login_ok']=$ss_login_ok;
			$_SESSION['ss_hash']=$ss_hash;
			unset($_SESSION['ss_mb_id']);
			unset($_SESSION['ss_mb_num']);
			unset($_SESSION['ss_login_ok']);
			unset($_SESSION['ss_hash']);
			$_mb=false;
		} else {
			if(rg_verify_login_hash($_mb)) {
				$_mb['mb_files']=unserialize($_mb['mb_files']);
				// 회원레벨이 $_const['admin_level'] 이상 이면 사이트관리자 
				$_auth['admin']=($_const['admin_level'] <= $_mb['mb_level']);
			} else {
				// 비정상적인 접근, 차후 관리자에게 메일등의 조취를 취할수 있다.
				$_mb=false;
				rg_href("$site_url","다른곳에서 로그인 하셨습니다.\n초기화면으로 이동합니다.");
			}
		}
	}

	if($_mb) $_mb['mb_level_name']=$_level_info[$_mb['mb_level']];
	
	if(!isset($ret_url)) 
	{
		if(isset($_R->ret_url))
		{
			$ret_url = $_R->ret_url;
		}/* else {
			$ret_url = $_SERVER['REQUEST_URI'];
		}*/
	}
	
/* ----------------------------------------------------------------------------------------------
 클래스, 함수 선언                                                                        
---------------------------------------------------------------------------------------------- */
	class variables_class // 변수 가져오는 클래스
	{ 
		var $data;
		var $xss_chk;
		public function __construct(&$vars,$xss_chk=true) 
		{ 
			$this->xss_chk=$xss_chk;
			$this->data=&$vars;
		}
		function variables_class(&$vars,$xss_chk=true)
		{
			$this->xss_chk=$xss_chk;
			$this->data=&$vars;
		}
		public function set_var(&$vars) 
		{
			$this->data=&$vars;
		}
		public function set_xss_chk($xss_chk) 
		{
			$this->xss_chk=$xss_chk;
		}
		public function __set($name,$value) 
		{ 
			$this->data[$name] = $value; 
		} 
		public function __get($name) 
		{
			return $this->xss_chk ? rg_xss_filter($this->data[$name]) : $this->data[$name]; 
		} 
		public function __isset($name) 
		{ 
			return isset($this->data[$name]); 
		}
    public function __unset($name)
    {
        unset($this->data[$name]);
    }
	}

	function rg_xss_filter($val) // xss 요소를 제거
	// 출처 : http://pastebin.com/6fpSGxx4
	{
		$val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
		$search = 'abcdefghijklmnopqrstuvwxyz';
		$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$search .= '1234567890!@#$%^&*()';
		$search .= '~`";:?+/={}[]-_|\'\\';
		for ($i = 0; $i < strlen($search); $i++)
		{
			$val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
			$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
		}
		$ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
		$ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
		$ra = array_merge($ra1, $ra2);
		$found = true; 
		while ($found == true)
		{
			$val_before = $val;
			for ($i = 0; $i < sizeof($ra); $i++)
			{
				$pattern = '/';
				for ($j = 0; $j < strlen($ra[$i]); $j++)
				{
					if ($j > 0)
					{
						$pattern .= '(';
						$pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
						$pattern .= '|(&#0{0,8}([9][10][13]);?)?';
						$pattern .= ')?';
					}
					$pattern .= $ra[$i][$j];
				}
				$pattern .= '/i';
				$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
				$val = preg_replace($pattern, $replacement, $val);
				if ($val_before == $val)
				{
					$found = false;
				}
			}
		}
		return $val;
	}
?>