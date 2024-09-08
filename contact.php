<?php
include "app/config.php";
include "shared/head.php";
include "shared/navComponent.php";
include "app/function.php";

//$username = $email = $message = "";
$errors = [];

if (isset($_POST['send'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']); // security SQL Injection.
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // validation
    if (!required($name)) {
        $errors[] = "Username is required";
    } else if (!required($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else if (!required($message)) {
        $errors[] = "Message is required";
    }

    if (count($errors) == 0) {
        $insert = "INSERT INTO contact_us (name, Email, message) VALUES ('$name', '$email', '$message')";
        $i = mysqli_query($conn, $insert);

        if ($i) {
            $success_message = "Message sent successfully!";
        } else {
            $errors[] = "Failed to send message.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <section class="breadcrumb-option" >

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111551.9926412813!2d-90.27317134641879!3d38.606612219170856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1597926938024!5m2!1sen!2sbd" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger text-danger">
                    <?php foreach ($errors as $error): ?>
                        <span><?=htmlspecialchars($error)?></span><br>
                    <?php endforeach;?>
                </div>
            <?php elseif (isset($success_message)): ?>
                <div class="alert alert-success text-success">
                    <span><?=htmlspecialchars($success_message)?></span><br>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>America</h4>
                                <p>195 E Parker Square Dr, Parker, CO 801 <br />+43 982-314-0958</p>
                            </li>
                            <li>
                                <h4>France</h4>
                                <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Name" value="<?=htmlspecialchars($name ?? '')?>">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email" value="<?=htmlspecialchars($email ?? '')?>">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Message"><?=htmlspecialchars($message ?? '')?></textarea>
                                    <button type="submit" name="send" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>

    <!-- Contact Section End -->

    <?php
include "shared/footer.php";
include "shared/script.php";
?>
</body>
</html>