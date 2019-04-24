<?php 
require_once "session.php";
require_once "../classes/Connection.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "classes/services.php";
$services = Services::getInstance();
include "header.php";
include "navbar.php";
include "navigration.php";
?>
<?php foreach($services->errors as $error): ?>
    <h3><?php echo $error; ?></h3>
<?php endforeach ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> View Active Services </h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th> Service Name</th>
                                <th> Price </th>
                                <th> Image </th>
                                <th> Category Name </th>
                                <th> Sub Category Name </th>
                                <th>FAQ</th>
                                <th>Answer</th>
                                <th> Service Detail Title</th>
                                <th> Service Detail Image</th>
                                <th> Service Description</th>
                           
                                <th> Action </th>
                            </tr>
                            <?php foreach($services->getServices() as $service): ?>
                                <tr>
                                <td><?php echo $service['id']; ?></td>
                                <td><?php echo $service['name']; ?></td>
                                <td><?php echo $service['price']; ?></td>
                                <td><img src="../images/<?php echo $service['image']; ?>" alt="Service Image" width="128" height="128"></td>
                                
                                <td><?php echo $service['cat_name']; ?></td>
                                <td><?php echo $service['sub_name']; ?></td>
                                <td><?php echo $service['faq_question']; ?></td>
                                <td><?php echo $service['faq_answer']; ?></td>
                                <td><?php echo $service['service_detail_title']; ?></td>
                                <td><img src="../images/<?php echo $service['service_detail_image']; ?>" alt="Service Detail Image" width="128" height="128"></td>
                                
                                <td><?php echo $service['service_description']; ?></td>
                                <td><a href="" class="btn btn-success"> Edit </a> <a href="service_view.php?deleteService=<?php echo $service['id']; ?>" class="btn btn-danger"> Delete </a> </td>
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
<h3>You are not authorized here!</h3>
<?php endif ?>