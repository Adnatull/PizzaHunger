<?php
require_once "session.php";
require_once("../classes/Connection.php");
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "classes/sub_category.php";
$sub_cat = Sub_Category::getInstance();
include "header.php";
    include_once "navbar.php";
// End of the Navbar top Side ------------------->


    include_once "navigration.php";
// End of the Navigration Bar in left Side Design -------------->


    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <!-- right column -->
                <div class="col-md-10">
                
                    <?php foreach($sub_cat->errors as $error): ?>
                        <h3><?php echo $error; ?></h3>
                    <?php endforeach ?>
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Sub Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="sub_category_edit.php" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <?php $cats = $sub_cat->getCategories(); ?>
                                    <label for="inputCategory" class="col-sm-2 control-label">Cateogry Name </label>

                                    <div class="col-sm-10">
                                        <select class="form-control" name="cat_id" id="inputCategory">

                                            <?php foreach($cats as $category): ?>
                                                <option value="<?php echo $category['cat_id'].""; ?>" <?php if($category['cat_id'] == $sub_cat->singleSubCategory['cat_id']) {echo "selected";} ?>><?php echo $category['name'].""; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input_sub_category" class="col-sm-2 control-label"> Sub Cateogry Name </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sub_name" id="input_sub_category" value="<?php echo $sub_cat->singleSubCategory['sub_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage" class="col-sm-2 control-label">File input</label>

                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="inputImage">

                                        <img src="../images/<?php echo $sub_cat->singleSubCategory['sub_image']; ?>" alt="" style="height: 100px; width: 130px;margin-top: 10px">

                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $sub_cat->singleSubCategory['sub_id']; ?>">
                                <!-- <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <input type="submit" name="update_sub_category" class="btn btn-info pull-right" value="Update Sub Category"/>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
        </section>
    </div>




    <?php include "footer.php";?>
<?php else: ?>

    <h1>You are not authorized in this page</h1>

<?php endif ?>