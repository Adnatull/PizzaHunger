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
require_once "classes/category.php";
$cats = Category::getInstance();
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> Categories View  </h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach($cats->errors as $error): ?>
                            <h3><?php echo $error; ?></h3>                        
                        <?php endforeach ?>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th> Category Name </th>                                    
                                    <th> Image  </th>                                    
                                    <th> Action </th>
                                </tr>
                                <!-- <?php $cnt = 1; ?> -->
                                <?php foreach($cats->getCategories() as $cat): ?>
                                    <tr>
                                        <td> <?php echo $cat['cat_id']; ?> </td>
                                        <td><?php echo $cat['name'];  ?></td>
                                        <td><img src="../images/<?php echo $cat['image'];?>" width="100px"/></td>
                                        <td> <a href="categoryEdit.php?getSingleCategory=<?php echo $cat['cat_id']; ?>" class="btn btn-info"> Edit </a>
                                        <a href="category_view.php?deleteCategory=<?php echo $cat['cat_id']; ?>&ImageName=<?php echo $cat['image'];  ?>" class="btn btn-danger"> Delete</a> </td>
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