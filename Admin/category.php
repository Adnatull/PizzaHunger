<?php
require_once "session.php";

?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "../classes/Connection.php";
require_once "classes/category.php";
$cat = Category::getInstance();
include "header.php";
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
                    <form class="form-horizontal" method="POST" action="category.php"  enctype="multipart/form-data">
                        <div class="box-body">
                            <!-- <p style="color:green; font-weight: bold;"> 
                            <?php //echo $_SESSION['message'];?>
                            </p> -->
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Cateogry Name </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="category" id="inputEmail3" placeholder="Category Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-sm-2 control-label">File input</label>

                                <div class="col-sm-10">
                                    <input type="file" name="image" id="exampleInputFile" required>

                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="category_view.php" class="btn btn-default">Cancel</a>
                            <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                            <input type="submit" name="category_insert" class="btn btn-info pull-right" value="Add Category"/>
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