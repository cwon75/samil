<? 
header ("Expires: Mon, 26 Jul 2001 12:00:00 GMT");     
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("cache-control: no-cache,must-revalidate"); 
header("pragma: no-cache") ; 
?>
<? 
include_once("../samil_include/lib.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
<title>:::: 삼일교회 ::::</title>
<link rel="stylesheet" type="text/css" href="../samil_css/style_b.css">
<script src="../samil_js/common.js"></script>
<script src="../samil_js/lib.validate.js"></script>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<?
/*
echo $_SESSION['captcha_keystring'];
echo "<BR>";
echo $spam_chk;


print_r($_POST);


while (list($key, $value) = each($HTTP_POST_VARS)){
	echo 'key=' . $key . ' value=' . $value . '<br>';
}

echo '<BR>';

key=c_fsosok value=청장년
key=c_fcamp value=9
key=c_fteam value=1
key=c_name value=태명
key=c_birth value=20160101
key=c_fname value=김아빠
key=c_fphone value=010-111-11111
key=c_mname value=김엄마
key=c_mphone value=010-222-2222
key=c_memail value=alksd@email.com
key=c_juso value=집주소
key=c_pass value=1234
*/


$c_name   = rg_script_conv($_POST['c_name'],$c_name);
$c_sex	  = rg_script_conv($_POST['c_sex'],$c_sex);
$c_birth  = rg_script_conv($_POST['c_birth'],$c_birth);
$c_fbapti = rg_script_conv($_POST['c_mname'],$c_mname);
$c_fsosok = rg_script_conv($_POST['c_fsosok'],$c_fsosok);
$c_femail = rg_script_conv($_POST['c_femail'],$c_femail);
$c_fcamp  = rg_script_conv($_POST['c_fcamp'],$c_fcamp);
$c_fteam  = rg_script_conv($_POST['c_fteam'],$c_fteam);

$c_fphone  = $_POST['c_fphone'];
$c_fphone2 = $_POST['c_fphone2'];
$c_fphone3 = $_POST['c_fphone3'];

$c_ext1  = rg_script_conv($_POST['c_ext1'],$c_ext1);
$c_ext2  = rg_script_conv($_POST['c_ext2'],$c_ext2);
$c_ext3  = rg_script_conv($_POST['c_ext3'],$c_ext3);
$c_ext4  = rg_script_conv($_POST['c_ext4'],$c_ext4);
$c_ext5  = rg_script_conv($_POST['c_ext5'],$c_ext5);
$c_ext6  = rg_script_conv($_POST['c_ext6'],$c_ext6);
$c_ext7  = rg_script_conv($_POST['c_ext7'],$c_ext7);
//$c_etc = rg_script_conv($_POST['c_etc'],$c_etc);

$c_pass   = rg_script_conv($_POST['c_pass'],$c_pass);
$c_mobile = rg_script_conv($_POST['mobile'],$c_mobile);

$now = date("Y-m-d H:i:s");


if(!empty($c_fcamp)) $c_fcamp = $c_fcamp."진";
if(!empty($c_fteam)) $c_fteam = $c_fteam."팀";




$rs_list->clear();
$rs_list->set_table($_table['samilchildbapti']);
$rs_list->add_where("c_code='5050' AND c_ext1='$c_ext1' ");
$rs_list->select();


if($c_ext1 == 1){  //베드로전후서와 설교
	if($rs_list->num_rows() > 40) {
		echo "<script> alert('베드로전후서와 설교는 마감되었습니다.!'); history.back(); </script>";
		exit;
	}
} else if($c_ext1 == 2){  //인문학적 해석과 설교
	if($rs_list->num_rows() > 29) {
		echo "<script> alert('인문학적 해석과 설교는 마감되었습니다.!'); history.back(); </script>";
		exit;
	}
}



if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $spam_chk) { // 스팸문자 맞지 않음
	echo "<script> alert('스팸방지 문자를 정확히 입력해주세요...!!'); history.back(); </script>";
	exit;
}
unset($_SESSION['captcha_keystring']);

try {
	$rs->clear();
	$rs->set_table($_table['samilchildbapti']);
	$rs->add_field("c_num","");
	$rs->add_field("c_code","5050"); //오르도 토메오
	$rs->add_field("c_name",  $c_name  );
	$rs->add_field("c_sex", $c_sex );
	$rs->add_field("c_pass", $c_pass );
	$rs->add_field("c_birth", $c_birth );
	$rs->add_field("c_mname", $c_mname );
	$rs->add_field("c_fsosok",$c_fsosok );
	$rs->add_field("c_fphone",$c_fphone."-".$c_fphone2."-".$c_fphone3);
	$rs->add_field("c_femail",$c_femail);
	$rs->add_field("c_ext1",  $c_ext1);
	$rs->add_field("c_ext2",  $c_ext2);
	$rs->add_field("c_ext3",  $c_ext3);
	$rs->add_field("c_ext4",  $c_ext4);
	$rs->add_field("c_ext5",  $c_ext5);
	$rs->add_field("c_ext6",  $c_ext6);
	$rs->add_field("c_ext7",  $c_ext7);
	$rs->add_field("c_etc",$c_etc);
	$rs->add_field("c_date",$now);
	$rs->add_field("c_ip",$_SERVER['REMOTE_ADDR']);
	$rs->insert();
	
	
	echo "<script> alert('오르도토메오 아카데미에 신청해 주셔서 감사합니다.'); </script>";
	rg_href("orthoIden.php");
	
}
catch(Exception $e) {
	echo  $e->getMessage();
	echo "<br>";
}



?>
</body></html>
