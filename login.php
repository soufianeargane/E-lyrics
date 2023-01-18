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
    <title>login</title>
</head>

<body>
    <form style="width: 500px;" class="mx-auto mt-5" action="logincheck.php" method="post">
        <div>
            <input class="form-control" type="text" name="email" placeholder="email">
        </div>
        <div>
            <input class="form-control" type="password" name="password" placeholder="password">
        </div>
        <button class="btn btn-primary" type="submit" name="login">Login</button>
    </form>
    <?php if (isset($_SESSION['error'])) : ?>
        <div style="width: 500px;" class="alert alert-danger mx-auto mt-5" role="alert">
            <?php echo $_SESSION['error'] ?>
            <?php unset($_SESSION['error']) ?>
        </div>
    <?php endif ?>
</body>

</html>