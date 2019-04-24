<?php
require_once "session.php";
include "header.php";?>
<?php if(isset($data->AdminLoggedIn)): ?>

    <?php
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
                <div class="col-md-12">

                    <h3 class="m-auto text-success">Order History</h3>
                    <hr/>

                    <div class="card mt-5" style="box-shadow: 2px 2px 1px 1px #2c3c43">

                        <div class="col-md-12">
                            <div class="col-md-6 mt-3 mb-3">
                                <div class="col-md-6 col-sm-6 float-left">
                                    <h5>Customer Name </h5>
                                    <hr/>
                                    <h5>Service</h5>
                                    <hr/>
                                    <h5>Date , Time</h5>
                                    <hr/>
                                    <h5>Price</h5>
                                    <hr/>
                                </div>
                                <div class="col-md-6 col-sm-6 float-left">
                                    <p>Name</p><hr/>
                                    <p>Mobile Repair</p><hr/>
                                    <p>12/01/2019 , 12:00 AM</p><hr/>
                                    <p><span class="tksymbol">&#2547;</span> 400</p><hr/>
                                </div>
                            </div>

                            <div class="col-md-6 float-left">
                                <div class="col-md-6 float-left">
                                    <div class="form-group">
                                        <div style="margin-left: 120px">
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 float-left">
                                    <div class="form-group">
                                        <div style="margin-left: 120px">
                                            <button type="submit" class="btn btn-success">Success</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

<?php endif ?>
<?php include "footer.php";?>
