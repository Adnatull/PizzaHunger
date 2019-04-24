<?Php
//console.log("HELLO");
require_once "sub_category.php";
require_once "../../classes/Connection.php";
//echo '<script type="text/javascript">alert("HELLO")</script>';
$cat_id=$_GET['checkID'];

//$cat_id=2;
/// Preventing injection attack //// 
if(!is_numeric($cat_id)){
echo "Data Error";
exit;
 }
 $sub_cat = Sub_Category::getInstance();
 $main =array('data'=>$sub_cat->getDynamicSubCategory($cat_id));
 echo json_encode($main);

 ?>