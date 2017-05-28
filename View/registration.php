<?php
include('header.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nebraska Tennis League-Registration</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/Tennis/View/main.css"/>
        <link rel="stylesheet" href="http://localhost/Tennis/View/nav.css">
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper2">
            <h1>New User Registration</h1>
            <p class="error">
                <?php
                if (isset($bValidate)) {

                    foreach ($errors as &$value) {
                        echo $value . "<br>";
                    }
                }
                ?>
            </p>


            <form action="index.php?action=registration" method="post">
                <label>First Name: </label>
                <input type="text" name="first_name" class="textboxes" value="<?php if (isset($first_name)) {
                    echo $first_name;
                } ?>"><br>
                <br>
                <label>Last Name: </label>
                <input type="text" name="last_name" class="textboxes" value="<?php if (isset($last_name)) {
                    echo $last_name;
                } ?>"><br>
                <br>
                <label>Email Address: </label>
                <input type="text" name="email_address" class="textboxes" value="<?php if (isset($email_address)) {
                    echo $email_address;
                } ?>"><br>
                <br>
                <label>Phone: </label>
                <input type="text" name="phone" class="textboxes" value="<?php if (isset($phone)) {
                    echo $phone;
                } ?>"><br>
                <br>
                <label>User Name: </label>
                <input type="text" name="user_name" class="textboxes" value="<?php if (isset($user_name)) {
                    echo $user_name;
                } ?>"><br>
                <br>
                <label>Password: </label>
                <input type="password" name="password" class="textboxes" value="<?php if (isset($password)) {
                    echo $password;
                } ?>"><br>
                <br>
                <input type="hidden" name= "action" value="confirmation">
                <input type="submit" value="Create Account">

            </form><br>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
