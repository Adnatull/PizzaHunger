<?php
require_once "session.php";

require_once("../classes/Connection.php");
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "classes/CustomerReviews.php";
$review = CustomerReviews::getInstance();
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
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Happy Customer </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php foreach($review->errors as $error): ?>
                                <h5><?php echo $error.""; ?></h5>
                        <?php endforeach ?>
                        
                        <form class="form-horizontal" action="happyCustomer.php" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    
                                    <label for="inputCustomerName" class="col-sm-2 control-label"> Happy Customer Name </label>

                                    <div class="col-sm-10">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="customerName" id="inputCustomerName" placeholder="Customer Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCustomerComment" class="col-sm-2 control-label"> Customer Comment </label>

                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" name="customerComment" id="inputCustomerComment" placeholder="Customer Comment"> -->
                                        <textarea name="customerComment" id="inputCustomerComment" cols="80" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage" class="col-sm-2 control-label">File input</label>

                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="inputImage" required>

                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputVideoUrl" class="col-sm-2 control-label"> Video Url </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="url" id="inputVideoUrl" placeholder="Video Link">
                                        
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
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <input type="submit" name="insertCustomerReview" class="btn btn-info pull-right" value="Add Customer Review"/>
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