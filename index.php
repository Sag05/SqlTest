<?php
// session_start();
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: loginPage.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prov</title>
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        $link = mysqli_connect("localhost", "root", "", "sql_test_te");
        
        require __DIR__ . "/task.php";

        One($link);
        Two($link);
        Three($link);
        Four($link);
        Five($link);
        Six($link);
        Seven($link);
        Eight($link);
        Nine($link);
        Ten($link);
    ?>
</body>
</html>