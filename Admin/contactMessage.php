<?php 
require_once "session.php";
require_once "../classes/Connection.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "classes/contact.php";
$contact = ContactUs::getInstance();
include "header.php";
include "navbar.php";
include "navigration.php";
?>
<?php foreach($contact->errors as $error): ?>
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
                        <h3 class="box-title"> View Messages </h3>

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
                                <th> Name</th>
                                <th> Email</th>
                                <th> Subject </th>
                                <th>Messages</th>

                                <th> Action </th>
                            </tr>
                            <?php foreach($contact->getMessages() as $single): ?>
                                <tr>
                                <td><?php echo $single['id']; ?></td>
                                <td><?php echo $single['name']; ?></td>
                                <td><?php echo $single['email']; ?></td>
                                <td><?php echo $single['subject']; ?></td>
                                <td><?php echo $single['message']; ?></td>
                                
                                <td><a href="" class="btn btn-success"> Edit </a> <a href="contactMessage.php?deleteMessage=<?php echo $single['id']; ?>" class="btn btn-danger"> Delete </a> </td>
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