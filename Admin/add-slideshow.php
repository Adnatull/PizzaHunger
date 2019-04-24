<?php
require_once "session.php";
require_once "header.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once("../classes/Connection.php");
require_once "classes/slideshow.php";
$slide = SlideShow::getInstance();
// require_once "classes/sub_category.php";
// $sub_cat = Sub_Category::getInstance();
include "navbar.php";
include "navigration.php";
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
                        <h3 class="box-title"> SlideShow </h3>
                    </div>
                    <!-- /.box-header -->
                    <?php foreach($slide->errors as $error): ?>
                        <h3><?php echo $error; ?></h3>
                    <?php endforeach ?>
                    <?php if(isset($_GET['msg'])): ?>
                        <h3>Insertion Successful</h3>
                    <?php endif ?>
                    <!-- form start -->
                    <form class="form-horizontal" action="add-slideshow.php" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="inputSlidePosition" class="col-sm-2 control-label"> Slide Position </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="position" id="inputSlidePosition" placeholder="Can be only 1,2 or 3. Because there are 3 slides in total">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSlideName" class="col-sm-2 control-label"> Slide Name </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="inputSlideName" placeholder="Slide Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSlideHeading" class="col-sm-2 control-label"> Short Heading </label>

                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" name="short-heading" id="inputSlideHeading">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription"  class="col-sm-2 control-label"> Description  </label>

                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="description" id="inputDescription" >
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputImage" class="col-sm-2 control-label"> Image </label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" id="inputImage">
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
                            </div>-->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                            <input type="submit" name="insertSlideShow" class="btn btn-info pull-right" value="Add Pizza"/>
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


<!-- forala rich text area part from here -->
<!-- Include external JS libs. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
 
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="js/froala_editor.pkgd.min.js"></script>
 
   