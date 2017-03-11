<? 
header ("Expires: Mon, 26 Jul 2001 12:00:00 GMT");     
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("cache-control: no-cache,must-revalidate"); 
header("pragma: no-cache") ; 

include_once("../samil_include/lib.php");


$c_code     = $_POST['c_code'];

try {

$rs_list->clear();
$rs_list->set_table($_table['samilchildbapti']);
$rs_list->add_where("c_code='5050' AND c_ext1='$c_code' ");
$rs_list->select();

$mssg = "NON";
//$name = "0";

if($c_code == 1){  //베드로전후서와 설교
	if($rs_list->num_rows() > 40) {
		$mssg = "1NON";
	} else {
		$mssg = "1OK";
	}
} else if($c_code == 2){  //인문학적 해석과 설교
	if($rs_list->num_rows() > 29) {
		$mssg = "2NON";
	} else {
		$mssg = "2OK";
	}
}

	
} catch(Exception $e) {
	echo  $e->getMessage();
	echo "<br>";
}



$data[0]['name'] = "name11";
$data[1]['code'] = $mssg;

print (json_encode($data))


?>