<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

</head>

<style>
    main { display: grid; grid-template-columns: 1fr 3fr; height: 5vh; }
    #right { display: grid; grid-template-rows: 9fr 1fr; }
    #left { background-color: #00a5e2; height: 95vh; }
    #right { background-color: #8FA5CE; height: 95vh; }
    #content { background-color: #99FFFF; }
    #input { background-color: aliceblue; }
    /*main { display : none; }*/

</style>

<body>
<?php
if ($_SESSION["validated"] !== true){
    echo '<script type="text/javascript"> window.location = "./login.php" </script>';
}
if ($_GET['sess'] === 'out'){
    session_destroy();
    echo '<script type="text/javascript"> window.location = "./login.php" </script>';
}

if ($_SESSION["validated"] === true){
    $filename = "./users/" . $_SESSION["user"];
    $userinfo = json_decode(file_get_contents($filename));
}
?>
<main>
    <div id="left">
        <a href="./index.php?sess=out">log out</a>
        <?php echo "<p>Name: $userinfo->ln, $userinfo->fn</p>"?>
        <?php echo "<p>Email: $userinfo->em</p>"?>
    </div>
    <div id="right">
        <div id="content"></div>
        <div id="input"></div>
    </div>

</main>

<script type="text/javascript">let session = '<?php echo session_id()?>';</script>
<script src="./js/user.js"></script>

</body>
</html>