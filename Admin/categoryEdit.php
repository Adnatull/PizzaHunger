<?php
require_once "session.php";
include "header.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
    <?php
    require_once "../classes/Connection.php";
    require_once "classes/category.php";
    $cat = Category::getInstance();


    include_once "navbar.php";
// End of the Navbar top Side ------------------->


    include_once "navigration.php";
// End of the Navigration Bar in left Side Design -------------->


// echo '<script type="text/javascript">alert("Hello")</script>';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <!-- right column -->
                <div class="col-md-10">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php if(count($cat->errors)>0): ?>
                            <?php foreach($cat->errors as $error): ?>
                                <h3 class="box-title"> <?php echo $error; ?> </h3>
                            <?php endforeach ?>
                        <?php endif ?>
                        
                        
                        <form method="POST" action="categoryEdit.php?getSingleCategory=<?php echo $cat->singleCategory['cat_id']; ?>"  enctype="multipart/form-data" class="form-horizontal">
                            <div class="box-body">
                                <!-- <p style="color:green; font-weight: bold;">
                            <?php //echo $_SESSION['message'];?>
                            </p> -->
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Cateogry Name </label>

                                    <div class="col-sm-10">
                                        <input type="text" name="category" class="form-control"  id="inputEmail3" value="<?php echo $cat->singleCategory['cat_name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile" class="col-sm-2 control-label">File input</label>

                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="exampleInputFile" >

                                        <img src="../images/<?php echo $cat->singleCategory['cat_image'] ?>" alt="" style="height: 100px; width: 130px;margin-top: 10px">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <input type="hidden" id="cat_id" name="cat_id" value="<?php echo $cat->singleCategory['cat_id']; ?>">
                                <input type="hidden" id="prev_img" name="prev_img" value="<?php echo $cat->singleCategory['cat_image']; ?>">


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-default" href="category_view.php">Cancel</a>
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <button type="submit" name="update_category" class="btn btn-info pull-right">Update Category</button>
                                <!-- <input type="submit" name="update_category" class="btn btn-info pull-right" value="Update Category"/> -->
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