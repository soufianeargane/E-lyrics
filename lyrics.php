<?php
include_once './classes/songClass.php';

$song = new Song();
$result = $song->getSingleData($_GET['id']);
$lyrics = $result = $result->fetchAll(PDO::FETCH_ASSOC);

$lyrics = $lyrics[0]['lyrics'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,400&display=swap');

        .letter-by-letter {
            display: none;
        }

        .text {

            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 400;
            width: 500px;
            margin: auto;
            padding: 20px;
            text-align: justify;
            margin-top: 30px;
            text-align-last: center;
            background-color: #eee;
            border-radius: 10px;
        }

        @media (max-width: 676px) {
            body {
                padding: 5px;
            }

            .text {
                margin-top: 5px;
                width: 100%;
                padding: 10px 15px;
                font-size: 15px;
            }
        }

        @media (max-width: 991px) {
            body {
                padding: 10px;
            }

            .text {
                margin-top: 15px;
                width: 100%;
                padding: 15px 20px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body style="background-color: black;">

    <p class="letter-by-letter">
        <?php echo $lyrics ?>
    </p>
    <p class="text" id="my-text"></p>


    <script>
        const text = document.querySelector(".letter-by-letter").innerText;
        // console.log(text);
        let i = 0;

        function revealText() {
            if (i < text.length) {
                document.getElementById("my-text").innerHTML += text.charAt(i);
                i++;
                setTimeout(revealText, 50);
            }
        }
        window.onload = revealText;
    </script>
</body>

</html>