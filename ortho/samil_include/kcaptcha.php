<?
/* =====================================================
  프로그램명 : 삼일교회 V4
  화일명 : kcaptcha.php 자동등록 방지
  작성일 : 
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com

  최종수정일 :
 ===================================================== */
	include_once("lib.php");
	include_once('kcaptcha/kcaptcha.php');
	$captcha = new KCAPTCHA();
	
//	if($_REQUEST[session_name()]){
		$_SESSION['captcha_keystring'] = $captcha->getKeyString();
//	}
?>