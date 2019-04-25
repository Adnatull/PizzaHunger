<?php $slide = SlideShow::getInstance();
$slide1 = $slide->firstSlide();
$slide2 = $slide->secondSlide();
$slide3 = $slide->thirdSlide();

?>
<section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
      <div class="slider-item">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">

            <div class="col-md-6 col-sm-12 ftco-animate">
            	<span class="subheading"><?php echo $slide1[0]['short-heading']; ?></span>
              <h1 class="mb-4"><?php echo $slide1[0]['name']; ?></h1>
              <p class="mb-4 mb-md-5"><?php echo $slide1[0]['description']; ?></p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>
            <div class="col-md-6 ftco-animate">
            	<img src="images/slideshow/<?php echo $slide1[0]['image']; ?>" class="img-fluid" alt="">
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">

            <div class="col-md-6 col-sm-12 order-md-last ftco-animate">
            	<span class="subheading"><?php echo $slide2[0]['short-heading']; ?></span>
              <h1 class="mb-4"><?php echo $slide2[0]['name']; ?></h1>
              <p class="mb-4 mb-md-5"><?php echo $slide2[0]['description']; ?></p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>
            <div class="col-md-6 ftco-animate">
            	<img src="images/slideshow/<?php echo $slide2[0]['image']; ?>" class="img-fluid" alt="">
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url(images/slideshow/<?php echo $slide3[0]['image']; ?>);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<span class="subheading"><?php echo $slide3[0]['short-heading']; ?></span>
              <h1 class="mb-4"><?php echo $slide3[0]['name']; ?></h1>
              <p class="mb-4 mb-md-5"><?php echo $slide3[0]['description']; ?></p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>

          </div>
        </div>
      </div>
    </section>