<?php 
require_once "../classes/Connection.php";
require_once "classes/services.php";
$ser = Services::getInstance();
require_once "classes/sub_category.php";
$sub_cats = Sub_Category::getInstance();
?>
<?php 
//echo $sub_cats->singleSubCategory['sub_name'];
?>

<?php foreach($sub_cats->errors as $error): ?>
                        <h3><?php echo $error; ?></h3>
                    <?php endforeach ?>