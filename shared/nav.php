
<style>

.cart-item-count {
    position: absolute;
    padding: 3px 6px;
    top: -15%;
    right: 2%;
    background: red; /* Background color for visibility */
    color: white; /* Text color */
    border-radius: 50%;
    font-size: 12px; /* Adjust font size */
    font-weight: bold;
}
.cart-icon{
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="img/logo.png" style="border-radius: 8px ;" alt="">
            <h1 class="sitename">Awabid Collection</h1><span></span>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./shop.php">Shop</a></li>
                <li class="dropdown"><a href="#"><span>Collection</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="shop.php?category_id=1">Summer Collection</a></li>
                        <li><a href="shop.php?category_id=2">Winter Collection</a></li>
                    </ul>
                </li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- Cart Icon -->

       <a class="cart-icon" href="shopping-cart.php">
            <span id="cart-item-count" class="cart-item-count">0</span>
            <i class="bi bi-cart"></i>
        </a>
        <?php if(!isset($_SESSION['users'])) : ?>
       <a class="btn-getstarted"  name="logout" href="login.php">login</a>
        <?php else : ?>
        <form action="" method="get">
            <button type="submit" name="logout"class="btn btn-danger" style="width:78px; height: 70px;">logout</button>
        </form>
        <?php endif ?>

      
    </div>
</header>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateCartItemCount() {
            // Retrieve cart items from localStorage
            let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            // Update the count in the span
            document.getElementById('cart-item-count').textContent = cartItems.length;
        }

        // Initial update
        updateCartItemCount();

        // Optionally, update the count whenever localStorage changes
        window.addEventListener('storage', updateCartItemCount);
    });
</script>

