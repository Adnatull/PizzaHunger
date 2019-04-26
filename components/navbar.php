
  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
		      <a class="navbar-brand" href="index.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Delicous</small></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
	          <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	          <li class="nav-item">
							<?php if(isset($data->userLoggedIn)): ?>
								<div class="dropdown1">
									<button class="dropbtn nav-link"><?php echo $data->user['email'];  ?> 
										<i class="fa fa-caret-down"></i>
									</button>
									<div class="dropdown-content1">
									<a class="nav-link text-danger" href="index.php?logout='1'">Log Out</a>
									</div>
								</div>
									<?php else: ?>
										<a class="nav-link" href='login.php'>Login</a>
							<?php endif ?>
							

								
						</li>
	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->