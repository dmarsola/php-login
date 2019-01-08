<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum - log in</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

</head>

<style>
    form { display: grid; grid-template-columns: 1fr 3fr; grid-gap: 0.5em; width: 50%; margin: auto; }
    #submit { width: 10em; }
    label { text-align: right; }
</style>

<body>
<?php
$error = false;
if (isset($_POST['submit'])){
    $error = true;
    $filename = "./users/" . md5($_POST['em']);
    if ($_POST['em'] && $_POST['pwd']){
        if (file_exists($filename)){
            $temp = array(
                'em' => $_POST['em']
                ,'pwd' => md5($_POST['pwd'])
            );
            $userinfo = json_decode(file_get_contents($filename));
            if ($temp["em"] == $userinfo->em && $temp["pwd"] == $userinfo->pwd){
                $_SESSION["validated"] = true;
                $_SESSION["user"] = md5($temp["em"]);
            }
            $error = !$_SESSION["validated"];
        }
    }
} // post

if ($_SESSION["validated"]){
    echo '<script type="text/javascript"> window.location = "./index.php" </script>';

} else if ($error){
    echo '<div id="error"><h2>Cannot validate credentials. Please try again.</h2></div>';
}
?>

<form method="post" action="./login.php">
    <label for="em">Email: </label>
    <input type="text" name="em" id="em" />
    <label for="pwd">Password: </label>
    <input type="password" name="pwd" id="pwd" />
    <div></div><input type="submit" name="submit" id="submit"/>
    <div></div><a href="newuser.php">create account</a>
</form>

</body>
</html>