<?php
require_once "session.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "../classes/Connection.php";
require_once "classes/CustomerReviews.php";
$review = CustomerReviews::getInstance();
require_once "header.php";
require_once "navbar.php";
require_once "navigration.php";

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

                        <form class="form-horizontal" action="happyCustomerEdit.php?getSingleReview=<?php echo $review->singleReview['id']; ?>" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">

                                    <label for="inputCustomerName" class="col-sm-2 control-label"> Happy Customer Name </label>

                                    <div class="col-sm-10">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="review_name" id="inputCustomerName" value="<?php echo $review->singleReview['name']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCustomerComment" class="col-sm-2 control-label"> Customer Comment </label>

                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" name="customerComment" id="inputCustomerComment" placeholder="Customer Comment"> -->
                                        <textarea name="review_comment" id="inputCustomerComment" cols="80" rows="3" ><?php echo $review->singleReview['comment']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage" class="col-sm-2 control-label">File input</label>

                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="inputImage" >

                                        <img src="../images/<?php echo $review->singleReview['image']; ?>" alt="" style="height: 100px; width: 130px;margin-top: 10px">

                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputVideoUrl" class="col-sm-2 control-label"> Video Url </label>

                                    <div class="col-sm-10">
                                        <input type="text"  name="video_url" class="form-control" id="inputVideoUrl" value="<?php echo $review->singleReview['video_url']; ?>">

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
                            <input type="hidden" id="review_id" name="review_id" value="<?php echo $review->singleReview['id']; ?>">
                            <input type="hidden" id="prev_img" name="prev_img" value="<?php echo $review->singleReview['image']; ?>">
                            <div class="box-footer">
                                <a href="HappyCustomerView.php" class="btn btn-default">Cancel</a>
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <input type="submit" name="updateReview" class="btn btn-info pull-right" value="Update Customer Review"/>
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