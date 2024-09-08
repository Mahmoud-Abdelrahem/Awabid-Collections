<?php
include "app/config.php";
include "shared/head.php";
include "shared/navComponent.php";

$select="SELECT * FROM about" ;
$s=mysqli_query($conn,$select);

?>


<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>About Us</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
            <?php foreach($s as $about) { ?>
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="<?= $about['main_image']?>" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Are ?</h4>
                        <p>Designer Laila Al-Dosari from the Kingdom of Saudi Arabia actually started working on the
                            first design in 2012 and expanded to work on different designs after the encouragement and
                            demand for her designs under the name Awabid Collection, distinguished by its elegant
                            designs, high-quality fabrics and attention to the smallest details of the abayas from A to
                            Z, and added another dimension to the designs by designing a women's bisht for use in
                            occasions and evening parties.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>What We Do ?</h4>
                        <p>In this digital generation where information can be easily obtained within seconds, business
                            cards still have retained their importance.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Why Choose Us</h4>
                        <p>A two or three storey house is the ideal way to maximise the piece of earth on which our home
                            sits, but for older or infirm people.</p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
            <?php foreach($s as $about) { ?>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p><?= $about['c_comment']?>
                        </p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="<?= $about['c_Thumbnail']?>" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5><?= $about['c_name']?></h5>
                                <p>Fashion Design</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="<?= $about['c_image']?>"></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- Testimonial Section End -->
    <?php 
    include "shared/footer.php";
    include "shared/script.php";
    ?>
</body>
</html>