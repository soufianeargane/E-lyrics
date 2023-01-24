<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/login.css">
    <title>login</title>
</head>

<body>
    <div class="father__app ">
        <div class="img__app">
            <img src="./img/songPhone.jpg" alt="">
        </div>
        <div class="form__app">
            <form onsubmit="return validateForm()" id="login-form" class="" action="logincheck.php" method="post">
                <div>
                    <input class="" id="email" type="text" name="email" placeholder="email">
                    <div id="email-error"></div>
                </div>
                <div>
                    <input class="" id="password" type="password" name="password" placeholder="password">
                    <div id="password-error"></div>
                </div>
                <button class="" type="submit" name="login">Login</button>
            </form>
            <?php if (isset($_SESSION['error'])) : ?>
                <div style="width: 500px;" class="alert alert-danger mx-auto mt-2 w-100" role="alert">
                    <?php echo $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif ?>
        </div>
    </div>

    <!-- js -->
    <script src="./login.js"></script>
</body>


</html>