<?php
include "shared/head.php";
include "shared/navComponent.php";
include "app/function.php";
include "app/config.php";

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    path('login.php');
}

$select1 = "SELECT * FROM Categories";
$s1 = mysqli_query($conn, $select1);
$row1 = mysqli_fetch_assoc($s1);

$select = "SELECT * FROM products";
$s = mysqli_query($conn, $select);

$selectSizes = "SELECT * FROM sizes";
$sSizes = mysqli_query($conn, $selectSizes);

$selectColors = "SELECT * FROM colors_products";
$sColors = mysqli_query($conn, $selectColors);

if (isset($_GET['color'])) {
    $color = $_GET['color'];
    $select = "SELECT * FROM products WHERE color_id = $color";
    $s = mysqli_query($conn, $select);
}

if (isset($_GET['size'])) {
    $size = $_GET['size'];
    $select = "SELECT * FROM products WHERE sizeId = $size";
    $s = mysqli_query($conn, $select);
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $select = "SELECT * FROM products WHERE cat_id = $category_id";
    $s = mysqli_query($conn, $select);
}

// Initialize filtering
if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
    $min_price = isset($_GET['min_price']) ? (int) $_GET['min_price'] : 0;
    $max_price = isset($_GET['max_price']) ? (int) $_GET['max_price'] : PHP_INT_MAX;

    // Fetch products based on price range
    $select = "SELECT * FROM products WHERE price >= $min_price";
    if ($max_price !== PHP_INT_MAX) {
        $select .= " AND price <= $max_price";
    }
    $s = mysqli_query($conn, $select);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <li><a href="shop.php">All Categories</a></li>
                                                <?php foreach ($s1 as $item) {?>
                                                    <li><a href="shop.php?category_id=<?=$item['id']?>"><?=$item['name']?></a></li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="shop.php">All Products</a></li>
                                                <li><a href="shop.php?min_price=500&max_price=1000">500 SAR - 1000 SAR</a></li>
                                                <li><a href="shop.php?min_price=1000&max_price=1500">1000 SAR - 1500 SAR</a></li>
                                                <li><a href="shop.php?min_price=1500&max_price=2000">1500 SAR - 2000 SAR</a></li>
                                                <li><a href="shop.php?min_price=2000&max_price=2500">2000 SAR - 2500 SAR</a></li>
                                                <li><a href="shop.php?min_price=2500&max_price=3500">2500 SAR - 3500 SAR</a></li>
                                                <li><a href="shop.php?min_price=3500&max_price=5000">3500 SAR - 5000 SAR</a></li>
                                                <li><a href="shop.php?min_price=5000">5000 SAR +</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <?php foreach ($sSizes as $item) {?>
                                                <a href="shop.php?size=<?=$item['id']?>"><label><?=$item['size']?>
                                                </label></a>
                                                <?php }?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
                                            <?php foreach ($sColors as $item) {?>
                                                <a href="shop.php?color=<?=$item['id']?>">
                                                <label style="background-color: <?=$item['color']?>;">
                                                </label>
                                            </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php foreach ($s as $item) {?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/product/<?=$item['image']?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        </li>
                                        <li><a href="./shop-details.php?id=<?=$item['id']?>&color=<?=$item['color_id']?>&size=<?=$item['sizeId']?>&category_id=<?=$item['cat_id']?>"><img src="img/icon/search.png" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?=$item['name']?></h6>
                                    <a style="cursor: pointer ;" onclick="addToCart(<?=$item['id']?>)" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="">
                                        <h5>Price : <?=$item['price']?> SAR</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<script>
    function addToCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let existingProduct = cart.find(item => item.productId === productId);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ productId, quantity: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cart));

}
  
</script>

<?php

include "shared/footer.php";
include "shared/script.php";

?>