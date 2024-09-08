<?php
include "app/config.php";
include "shared/head.php";
include "shared/navComponent.php";
include "app/function.php";

// Initialize total
$total = 0;

// Handle incoming cart data (from JavaScript)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the incoming JSON data from the request
    $cartData = file_get_contents('php://input');
    $cartItems = json_decode($cartData, true);

    // Store cart items in session
    $_SESSION['cart'] = $cartItems;
}

// Retrieve cart items from session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>
<body>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($cartItems); $i++) {

                                    $id = $cartItems[$i]['productId'];
                                    $select = "SELECT * FROM products where id = $id";
                                    $s = mysqli_query($conn, $select);

                                        ?>

                                                                        <?php foreach ($s as $item) {

                                            $product_name = htmlspecialchars($item['name']);
                                            $product_image = htmlspecialchars($item['image']);
                                            $quantity = (int) $cartItems[$i]['quantity'];
                                            $price = (float) $item['price'];
                                            $subtotal = $quantity * $price;
                                            $total += $subtotal; // Calculate total

                                            ?>
                                   <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="img/product/<?=$product_image?>" width="80px" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6><?=$product_name?></h6>
                                            <h5><?=$price?> SAR</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="<?=$quantity?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price"><?=$subtotal?> SAR</td>
                                    <td class="cart__close"><a href="" onclick="removeFromCart(<?=$id?>)" ><i class="fa fa-close"></i></a></td>
                                </tr>
                                <?php
}
}?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span><?=$total?> SAR</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function sendCartDataToServer() {
            // Retrieve cart items from localStorage
            let cartItems = JSON.parse(localStorage.getItem('cart')) || [];

            // Send cart data to the server via an AJAX request
            fetch('shopping-cart.php', { // This is the same page
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(cartItems),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Cart data sent successfully:', data);
                // Update the cart item count display
                document.getElementById('cart-item-count').textContent = cartItems.length;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        sendCartDataToServer();
    });

    function removeFromCart(id) {
        let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
        let index = cartItems.findIndex(item => item.productId === id);
        if (index !== -1) {
            cartItems.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cartItems));
        }

    }
    </script>

    <?php
include "shared/footer.php";
include "shared/script.php";
?>
</body>
</html>
