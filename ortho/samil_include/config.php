<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
  프로그램명 : 삼일교회 V4.2
  화일명 : 
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 : 
 ===================================================== */

	if(isset($_REQUEST['site_path']) || isset($_REQUEST['site_url'])) exit;
	if(!isset($site_path)) $site_path='../';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../';	
	
	$_table									= array(); // 테이블명 배열
	$_table['prefix']				= 'rg4_';	// 테이블명 접두어
	$_table['member']				= $_table['prefix'].'member';	// 회원
	$_table['group']				= $_table['prefix'].'group';	//	그룹
	$_table['gmember']			= $_table['prefix'].'gmember';	//	그룹회원
	$_table['calendar']			= $_table['prefix'].'calendar';	//	달력	
	$_table['getoffice']			= $_table['prefix'].'getoffice';	//	그룹회원
	$_table['scheduleDay']			= $_table['prefix'].'scheduleDay';	//	일정관리	
	$_table['samilmojip']			= $_table['prefix'].'samilmojip';	//	모집페이지
	$_table['vacation']			= $_table['prefix'].'vacation';	//	모집페이지	
	$_table['samilchildbapti']			= $_table['prefix'].'samilchildbapti';	//	유아세례
	$_table['bbs_cfg']			= $_table['prefix'].'bbs_cfg';	//	게시판설정
	$_table['bbs_body']			= $_table['prefix'].'bbs_body';	//	게시판 본문
	$_table['bbs_comment']	= $_table['prefix'].'bbs_comment';	//	게시판 코멘트
	$_table['bbs_category']	= $_table['prefix'].'bbs_category';	//	게시판 카테고리
	$_table['bbs_file']			= $_table['prefix'].'bbs_file';	//	게시판 첩부파일 2014-03-19 추가
	$_table['setup']				= $_table['prefix'].'setup';	//	사이트설정
	$_table['point']				= $_table['prefix'].'point';	//	포인트내역
	$_table['note']					= $_table['prefix'].'note';	//	쪽지
	$_table['zip']					= $_table['prefix'].'zip';	//	우편번호
	
	$_table['popup']					= $_table['prefix'].'popup';	//	팝업 2010.02추가
	$_table['comm_code']			= $_table['prefix'].'comm_code';	//	공통코드 2010.02추가
	
	$_table['member_sns']			= $_table['prefix'].'member_sns';	//	SNS로그인연동 2014.01 추가

	
	$_path							= array(); // 서버상의 경로
	$_path['site']			= $site_path;	// 기본경로
	// 사이트 PATH
	$_path['bbs']				= $_path['site'].'samil_board/';	// 게시판
	$_path['css']				= $_path['site'].'samil_css/';	// 스타일시트
	$_path['member']		= $_path['site'].'samil_member/';	// 회원
	$_path['getoffice']		= $_path['site'].'samil_getoffice/';	// 출근부
	$_path['calendar']		= $_path['site'].'samil_calendar/';	// 달력
	$_path['scheduleDay']		= $_path['site'].'samil_scheduleDay/';	// 일정표
	$_path['samilmojip']		= $_path['site'].'samil_samilmojip/';	// 모집
	$_path['vacation']		= $_path['site'].'samil_vacation/';	// 모집
	$_path['samilchildbapti']		= $_path['site'].'samil_samilchildbapti/';	// 유아세례
	$_path['js']				= $_path['site'].'samil_js/';	// 스크립트
	$_path['admin']			= $_path['site'].'samil_admin/';	// 관리자
	$_path['counter']		= $_path['site'].'samil_counter/';	// 카운터
	$_path['inc']				= $_path['site'].'samil_include/';	// 라이브러리등
	$_path['mail_form']	= $_path['site'].'samil_mail/';	// 이메일주소경로
	$_path['skin']			= $_path['site'].'samil_skin/';	// 스킨경로
	// 스킨 PATH
	$_path['bbs_skin']	= $_path['skin'].'board/';	// 게시판 스킨
	$_path['login_skin']= $_path['skin'].'login/';	// 로그인 스킨
	$_path['last_skin']	= $_path['skin'].'last/';	// 최근글 스킨
	// 데이타 PATH
	$_path['data']			= $_path['site'].'samil_data/';	// 데이타파일
	$_path['session']		= $_path['data'].'session/';	// 세션
	$_path['member_data']	= $_path['data'].'member/';	// 회원 데이타파일
	$_path['bbs_data']		= $_path['data'].'board/';	// 게시판 첨부파일
	$_path['bbs_thumb']	= $_path['data'].'board_thumb/';	// 섬네일 경로

	$_path['popup']			= $_path['data'].'popup/';	// 팝업이미지 2010.02추가

	$_url								= array(); // URL 웹경로
	$_url['site']				= $site_url;	// 기본경로
	// 사이트 URL
	$_url['bbs']				= $_url['site'].'samil_board/';	// 게시판
	$_url['css']				= $_url['site'].'samil_css/';	// 스타일시트
	$_url['member']			= $_url['site'].'samil_member/';	// 회원
	$_url['getoffice']		= $_url['site'].'samil_getoffice/';	// 출근부
	$_url['calendar']		= $_url['site'].'samil_calendar/';	// 달력
	$_url['samilmojip']		= $_url['site'].'samil_samilmojip/';	// 모집페이지
	$_url['vacation']		= $_url['site'].'samil_vacation/';	// 모집페이지
	$_url['scheduleDay']		= $_url['site'].'samil_scheduleDay/';	// 일정표
	$_url['samilchildbapti']		= $_url['site'].'samil_samilchildbapti/';	// 유아세례	
	$_url['js']					= $_url['site'].'samil_js/';	// 스크립트
	$_url['admin']			= $_url['site'].'samil_admin/';	// 관리자
	$_url['counter']		= $_url['site'].'samil_counter/';	// 카운터
	$_url['mail_form']	= $_url['site'].'samil_mail/';	// 이메일주소경로
	$_url['skin']				= $_url['site'].'samil_skin/';	// 스킨경로
	// 스킨 URL
	$_url['bbs_skin']		= $_url['skin'].'board/';	// 게시판 스킨
	$_url['login_skin']	= $_url['skin'].'login/';	// 로그인 스킨
	$_url['last_skin']	= $_url['skin'].'last/';	// 최근글 스킨
	// 데이타 URL
	$_url['data']				= $_url['site'].'samil_data/';	// 데이타파일

	// 상수정의
	$_const = array();
	$_const['charset'] = "utf-8";
	
	$_const['member_states']		= array(0=>'대기',1=>'승인',2=>'미승인',3=>'탈퇴'); // 회원상태
	$_const['group_states']			= array(0=>'대기',1=>'승인',2=>'미승인',3=>'폐쇄');	// 그룹상태
	$_const['group_level_type']	= array(0=>'회원레벨',1=>'그룹레벨');	// 그룹레벨 적용방식

	$_const['admin_level']			= 90;	// 최고 관리자 레벨
	$_const['group_admin_level']= 50;	// 그룹 관리자 레벨
	$_const['sex']							= array('M'=>'남자','F'=>'여자'); // 성별

	$_const['member_form_state'] = array(0=>'사용안함',1=>'선택',2=>'필수');
	$_const['member_forms'] = array(
		'mb_name' => '이름',
		'mb_nick' => '닉네임',
		'mb_email' => '이메일',
		'mb_jumin' => '주민등록번호',
		'mb_tel1' => '전화번호',
		'mb_tel2' => '핸드폰번호',
		'mb_address' => '주소',
		'mb_signature' => '서명',
		'mb_introduce' => '자기소개',
		'photo1' => '사진',
		'icon1' => '회원아이콘'
	);
	
	// 디비 형태
	$_const['db_type']					= array();
	$_const['db_type']['MYSQL']	= array('code'=>'MYSQL','name'=>'Mysql','hname'=>'Mysql','default_port'=>'3306');
	$_const['db_type']['CUBRID']= array('code'=>'CUBRID','name'=>'Cubrid','hname'=>'큐브리드','default_port'=>'33000');
	$_const['db_type']['ORACLE']= array('code'=>'ORACLE','name'=>'Oracle','hname'=>'오라클','default_port'=>'1521');

	// 포인트형태
	$_po_type_code		= array('etc'=>'0','bbs'=>'1','shop'=>'2','admin'=>'10');
	$_po_type_name		= array('0'=>'기타','1'=>'게시판','2'=>'쇼핑몰','10'=>'관리자');
	
	$_auth=false;			// 권한 초기화
	$_bbs_auth=false;	// 게시판 권한 초기화
	$_mb=false;				// 회원정보초기화
	$_group_info=false;	// 그룹정보 초기화
	$_bbs_info=false;	// 게시판정보 초기화
	
	$_br_info=array();
	// 모바일 브라우저체크
	if(preg_match('/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/',
			$_SERVER['HTTP_USER_AGENT'])) {
		$_br_info['gubun'] = 'mobile';
	} else {
		$_br_info['gubun'] = 'pc';
	}
?>