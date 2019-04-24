<?php
require_once "session.php";
?>
<?php if(isset($data->AdminLoggedIn)): ?>
<?php
require_once "../classes/Connection.php";
require_once "classes/Order.php";
$order = Order::getInstance();
include_once "header.php";
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
                    <h3 class="m-auto text-success">Pending Order</h3>
                    <hr/>
                    <?php foreach($order->getPendingOrder() as $pendingOrder): ?>
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
                                        <p><?php echo $pendingOrder['user']['name']; ?></p><hr/>
                                            <?php $sum = 0; $cnt = 1; ?>
                                            <?php foreach($pendingOrder['services'] as $service): ?>
                                            <ul>
                                                <li><?php echo "Service: ".$cnt; ?></li>
                                                <li>Name: <?php echo $service['serviceName']; ?></li>
                                                <li>Quantity: <?php echo $service['quantity']; ?></li>
                                                <li>Unit Price: <?php echo $service['unitPrice']; ?></li>
                                                <li>Total Price: <?php echo $service['totalPrice']; ?></li>
                                                <?php $sum = $sum + $service['totalPrice']; $cnt++; ?>
                                            </ul>
                                            <?php endforeach ?>
                                            
                                        
                                        
                                        <p><?php echo $pendingOrder['day']; ?> , <?php echo $pendingOrder['time']; ?></p><hr/>
                                        <p>Total Price: <span class="tksymbol">&#2547;</span> <?php echo $sum; ?></p><hr/>
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
                    <?php endforeach ?>
                    
                </div>

            </div>
        </section>
    </div>

<?php endif ?>
<?php include "footer.php";?>
