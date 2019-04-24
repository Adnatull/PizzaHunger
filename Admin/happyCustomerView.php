<?php 
require_once "session.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "../classes/Connection.php";
require_once "classes/CustomerReviews.php";
$reviews = CustomerReviews::getInstance();
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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> Happy Cutomer View  </h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach($reviews->errors as $error): ?>
                            <h3><?php echo $error; ?></h3>
                        
                        <?php endforeach ?>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th> Custmer Name </th>
                                    <th> Customer Comment </th>
                                    <th> Image  </th>
                                    <th> Url </th>
                                    <th> Action </th>
                                </tr>
                                <!-- <?php $cnt = 1; ?> -->
                                <?php foreach($reviews->getReviews() as $review): ?>
                                    <tr>
                                        <td> <?php echo $review['id']; ?> </td>
                                        <td><?php echo $review['name'];  ?></td>
                                        <td> <?php echo $review['comment'];  ?> </td>
                                        <td><img src="../images/<?php echo $review['image'];?>" width="100px"/></td>
                                        <td><?php echo $review['video_url']; ?></td>
                                        <td> <a href="happyCustomerEdit.php?getSingleReview=<?php echo $review['id'] ?>" class="btn btn-info"> Edit </a> <a href="happyCustomerView.php?deleteReview='<?php echo $review['id']; ?>'" class="btn btn-danger"> Delete</a> </td>
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