<?php
session_start();
?>
<form action="" method="post">
<p>Enter text shown below:</p>
<p><img src="./" onClick="this.src=this.src + '?nocache=' + Math.random()*999999999"></p>
<p><input type="text" name="keystring"></p>
<p><input type="submit" value="Check"></p>
</form>
<?php
if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']){
		echo "Correct";
	}else{
		echo "Wrong";
	}
}
unset($_SESSION['captcha_keystring']);
?>