<?php
// connection database
include "app/config.php";
include "app/function.php";
include "shared log&reg/head.php";

// Initialize errors array
$username = $email = $password = $confirm_password = $phone = "";
$errors = [];

if (isset($_POST['send'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $confirmPass = $_POST['confirm'];

    // validation
    if (!required($username)) {
        $errors[] = "Username is required";
    } else if (!required($email)) {
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    else if (!required($phone)) {   
        $errors[] = "Phone is required";
    }
   // else if (!preg_match('/^[0-9]{10}$/', $phone)) {
   //     $errors[] = "Invalid phone number";}
     else if (!required($password)) {
        $errors[] = "Password is required";
    } else if (!required($confirmPass)) {
        $errors[] = "Confirm Password is required";
    } else if ($password !== $confirmPass) {
        $errors[] = "Password and Confirm Password do not match";
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {
        // Check for duplicate username or email
        $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $errors[] = "Username or Email already exists.";
        } else {
            $insert = "INSERT INTO users (UserName, email, password,confirmpass,phone, created_at, updated_at) VALUES ('$username', '$email', '$password','$confirmPass', '$phone', NOW(), NOW())";
            $i = mysqli_query($conn, $insert);
            if ($i) {
                header('location:login.php');
                exit();
            } else {
                $errors[] = "Failed to insert data: " . mysqli_error($conn);
            }
        }
    }
}
?>

<title>register</title>
</head>

<body>
    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="assets/img/loaders/heart-loading2.gif" alt="">
    </div>
    <!-- END LOADER -->

    <div class="d-lg-flex half">
        <div class="bg order-2 order-md-2  mobile-hidden"><img src="assets/img/Sign up-bro.png" class="img register-img mt-5" alt="login"></div>

        <!-- form reg here -->
        <div class="contents order-1 order-md-1 register-login">
            <div class="container">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger text-danger">
                        <?php foreach ($errors as $error): ?>
                            <span> <?= $error ?> </span><br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="row mobile-row register-row align-items-center justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="text-center mb-3">
                            <img src="assets/img/logo-removebg-preview.png" style="width: 100px;" alt="">
                        </div>
                        <h3 class="login-text"> <strong><span id="element"></span></strong></h3>
                        <form action="#" method="post" class="mt-4">
                            <div class="form-group first">
                                <label for="username">Username :</label>
                                <input type="text" name="name" value="<?php if (isset($_POST['name'])) { echo $_POST['name']; } ?>" class="form-control input" placeholder="example:Youssef" id="username">
                            </div>

                            <div class="form-group first">
                                <label for="username">Email :</label>
                                <input type="text" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" class="form-control input" placeholder="info@gmail.com" id="username">
                            </div>
                            <div class="form-group first">
                                <label for="username">Phone :</label>
                                <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) { echo $_POST['phone']; } ?>" class="form-control input" placeholder="0123456789" id="username">
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password :</label>
                                <input type="password" name="password" class="form-control input" placeholder="password" id="password">
                            </div>

                            <div class="form-group last mb-3">
                                <label for="password">Confirm Password :</label>
                                <input type="password" name="confirm" class="form-control input" placeholder="password" id="password">
                            </div>

                            <div class="d-flex mb-2 align-items-center">
                                <span class="me-auto"><a href="#" class="forgot-pass">Forgot Password ?</a></span>
                            </div>
                            <div class="group-btn mb-5">
                                <button class="link btn-block btn-success sign-in" name="send">Sign Up</button>
                                <div class="text-center my-3 or"> <span>OR</span> </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <a href="login.php" class="link link-sign-up btn-block btn-primary">Sign In</a>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end form -->

        <div class="bg order-1 order-md-2 main-hidden"><img src="assets/img/Sign up-bro.png" alt=""></div>
    </div>

<?php 
// links js
include "shared log&reg/script.php";
?>
</body>
</html>
