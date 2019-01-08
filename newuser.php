<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New User</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

</head>

<style>
    form { display: grid; grid-template-columns: 1fr 3fr; grid-gap: 0.5em; width: 50%; margin: auto; }
    #submit { width: 10em; }
    label { text-align: right; }
</style>

<body>
<?php
require "./user.php";
$error = false;
$saved = false;
if (isset($_POST['submit'])){
//    $user = new user(null);
    $filename = "./users/" . md5($_POST['em']);
    if ($_POST['fn'] && $_POST['ln'] && $_POST['pwd'] && $_POST['pwd'] === $_POST['pwd2']){
        if (!file_exists($filename)){
            $temp = array(
                'fn' => $_POST['fn']
            ,'ln' => $_POST['ln']
            ,'em' => $_POST['em']
            ,'pwd' => md5($_POST['pwd'])
            );
            $user = new user($temp);
            var_dump($temp);
            var_dump($user);
            $_SESSION['user'] = md5($temp['em']);
            $saved = true;
        } else
            $exists = true;
    } else
        $error = true;
} // post

if ($error){
?>
    <div id="error"> <h2>Try again. All fields are mandatory and passwords have to match.</h2></div>
<?php
} else if ($exists) {
?>
    <div id="error"> <h2>User already exists. <a href="./login.php">Log in</a> instead.</h2></div>
    <?php
}

if ($saved) {
    ?>
    <h1>Account Created. Now have some fun!</h1>
    <p><a href="./login.php">log in</a> now!</p>
    <?php
} else {
    ?>
    <form method="post" action="./newuser.php">
        <label for="fn">First Name: </label>
        <input type="text" name="fn" id="fn" />
        <label for="ln">Last Name: </label>
        <input type="text" name="ln" id="ln" />
        <label for="em">Email: </label>
        <input type="text" name="em" id="em" />
        <label for="pwd">Password: </label>
        <input type="password" name="pwd" id="pwd" />
        <label for="pwd2">Confirm Password: </label>
        <input type="password" name="pwd2" id="pwd2" />
        <div></div><input type="submit" name="submit" id="submit"/>
        <div></div><p><a href="./login.php">log in</a> instead.</p>
    </form>

    <?php
}
?>

</body>
</html>