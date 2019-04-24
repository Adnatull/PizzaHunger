<?php 
require_once "session.php";
include "header.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "../classes/Connection.php";

include_once "navbar.php";
// End of the Navbar top Side ------------------->


include_once "navigration.php";
// End of the Navigration Bar in left Side Design -------------->

require_once "classes/sub_category.php";
$sub_cats = Sub_Category::getInstance();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Sub Category </h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach($sub_cats->errors as $error): ?>
                        <h3><?php echo $error; ?></h3>
                    <?php endforeach ?>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th> Sub Category Name</th>
                                <th> Image </th>
                                <th> Category </th>
                                <th> Action </th>
                            </tr>
                            <?php foreach($sub_cats->getSubCategories() as $sub_category): ?>
                                <tr>
                                    <td><?php echo $sub_category['sub_id'];?></td>
                                    <td><?php echo $sub_category['sub_name']; ?></td>
                                    <td><img src="../images/<?php echo $sub_category['sub_image'];?>" width="100px"></td>
                                    <td><?php echo $sub_category['name']; ?></td>
                                    <td><a href="sub_category_edit.php?editSubCategory=<?php echo $sub_category['sub_id']?>" class="btn btn-success"> Edit </a> <a href="sub_category_view.php?deleteSubCategory=<?php echo $sub_category['sub_id']?>&ImageName=<?php echo $sub_category['sub_image'];  ?>" class="btn btn-danger"> Delete </a> </td>

                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include "footer.php";?>
<?php else: ?>

<h1>You are not authorized in this page</h1>

<?php endif ?>