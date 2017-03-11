<?
include_once("../samil_include/lib.php");


header( "Content-type: application/vnd.ms-excel;charset=UTF-8");
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=child_baptism_".date('Ymd').".xls" );

$smb_id = $_SESSION['ss_mb_id'];
$smb_num = $_SESSION['ss_mb_num'];
$smb_name = $_SESSION['ss_mb_name'];
$smb_level = $_SESSION['ss_mb_level'];

if(!$smb_id) {
	rg_href("http://www.samilchurch.com");
}

$rs_list->clear();
$rs_list->set_table($_table['samilchildbapti']);
$rs_list->add_where("c_code='2016'");
$rs_list->add_order("c_num DESC");

$rs_list->select();
?>
<!doctype html>
<meta charset="utf-8">
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_list">
	<tr align="center" bgcolor="#F0F0F4">
		<td width="40" >번호</td>
		<td>아기이름(성별)</td>
		<td>아기이름뜻</td>
		<td>유아<br>생년월일</td>
		<td>아버지<br>이름</td>
		<td>아버지소속</td>
		<td>아버지 연락처</td>
		<td>아버지 이메일</td>
		<td>아버지<BR>세례여부</td>
		<td>아버지<BR>새가족<BR>등록여부</td>
		<td>어머니<br>이름</td>
		<td>어머니 소속</td>
		<td>어머니 연락처</td>
		<td>어머니 이메일</td>
		<td>어머니<BR>세례여부</td>
		<td>어머니<BR>새가족<BR>등록여부</td>
		<td>신청일</td>
	</tr>
<?
if($rs_list->num_rows()>0) {
	while($R=$rs_list->fetch()) {
		$c_num   = $R['c_num'];
		$c_name   = $R['c_name'];
		$c_sex    = $R['c_sex'];
		$c_name2  = $R['c_name2'];
		$c_birth  = $R['c_birth'];
		$c_fname  = $R['c_fname'];
		$c_fsosok = $R['c_fsosok'];
		$c_fphone = $R['c_fphone'];
		$c_femail = $R['c_femail'];
		$c_fbapti = $R['c_fbapti'];
		$c_fnewm  = $R['c_fnewm'];
		$c_mname  = $R['c_mname'];
		$c_msosok = $R['c_msosok'];
		$c_mphone = $R['c_mphone'];
		$c_memail = $R['c_memail'];
		$c_mbapti = $R['c_mbapti'];
		$c_mnewm  = $R['c_mnewm'];
		$c_etc    = $R['c_etc'];
		$c_date    = $R['c_date'];		
?>		

	<tr height="25">
			<td align="center"><?=$c_num?></td>
			<td align="center" title="<?=$c_etc?>"><?=$c_name?>(<?=$c_sex?>)</td>  
			<td align="center"><?=$c_name2?></td> 
			<td align="center"><?=$c_birth?></td> 
			<td align="center"><?=$c_fname?></td> 
			<td align="center"><?=$c_fsosok?></td>
			<td align="center"><?=$c_fphone?></td>
			<td align="center"><?=$c_femail?></td>
			<td align="center"><?=$c_fbapti?></td>
			<td align="center"><?=$c_fnewm?></td> 
			<td align="center"><?=$c_mname?></td> 
			<td align="center"><?=$c_msosok?></td>
			<td align="center"><?=$c_mphone?></td>
			<td align="center"><?=$c_memail?></td>
			<td align="center"><?=$c_mbapti?></td>
			<td align="center"><?=$c_mnewm?></td> 
			<td align="center"><?=$c_date?></td>
	</tr>

<?		
		
	}
}


?>	
	
	
	
	
</table>
</body></html>