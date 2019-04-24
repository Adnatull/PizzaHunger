<?php
require_once "session.php";
require_once "header.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once("../classes/Connection.php");
require_once "classes/services.php";
$service = Services::getInstance();
require_once "classes/sub_category.php";
$sub_cat = Sub_Category::getInstance();
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
                        <h3 class="box-title"> Service </h3>
                    </div>
                    <!-- /.box-header -->
                    <?php foreach($service->errors as $error): ?>
                        <h3><?php echo $error; ?></h3>
                    <?php endforeach ?>
                    <!-- form start -->
                    <form class="form-horizontal" action="service.php" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="inputServiceName" class="col-sm-2 control-label"> Service Name </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="service_name" id="inputServiceName" placeholder="Service Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPrice"  class="col-sm-2 control-label"> Price  </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="price" id="inputPrice" placeholder="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputImage" class="col-sm-2 control-label"> Image </label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" id="inputImage">
                                </div>
                            </div>

                            
                            <div class="form-group">
                            <?php $cats = $sub_cat->getCategories(); ?>
                                <label for="inputCategory" class="col-sm-2 control-label">Cateogry Name </label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="cat_id" id="inputCategory" onChange="DynamicSubCategory()">
                                        <option value='' selected>Select</option>
                                        <?php foreach($cats as $category): ?>
                                        <option value="<?php echo $category['cat_id'].""; ?>"><?php echo $category['name'].""; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSubCategory" class="col-sm-2 control-label"> Sub Category </label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="sub_id" id="inputSubCategory">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFaqID" class="col-sm-2 control-label">Faq </label>
                                <div class="col-sm-10">
                                    <input type="text" name="faq_ques" class="form-control" id="inputFaqID" placeholder="Question?">
                                </div>
                                <label for="inputFaqAnswer" class="col-sm-2 control-label"> </label>
                                <div class="col-sm-10">
                                <textarea type="text" name="faq_ans" class="form-control" id="inputFaqAnswer" placeholder="Answer"></textarea>
                                </div>
                            </div>

                                            
                            <div class="form-group">
                                <label for="inputServiceDetailTitle" class="col-sm-2 control-label">Service Details </label>
                                <div class="col-sm-10">
                                    <input type="text" name="serviceTtile" class="form-control" id="inputServiceDetailTitle" placeholder="Title">
                                </div>

                                <label for="inputServiceDetailImage" class="col-sm-2 control-label"> Image </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="serviceImage" id="inputServiceDetailImage">
                                </div>
                                <label for="inputServiceDetail" class="col-sm-2 control-label"> </label>
                                <div class="col-sm-10">
                                <div class="fr-view">
                                <textarea type="text" name="serviceDetail" class="form-control" id="inputServiceDetail" placeholder="Description"></textarea>
                                </div>
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
                            <input type="submit" name="insertService" class="btn btn-info pull-right" value="Add Service"/>
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
 
    <!-- Initialize the editor. -->
    <script> $(function() { $('textarea#inputServiceDetail').froalaEditor({
         quickInsertTags: [],
         imagePaste: false,
         toolbarButtons: ['bold','italic', 'fontFamily', 'fontSize','formatUL','formatOL','|','insertLink','|','emoticons'],
        
    }) }); </script>