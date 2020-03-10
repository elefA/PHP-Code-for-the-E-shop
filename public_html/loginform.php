<?php
session_start();
include 'dbFunctions.php';
include 'db.php';
include 'header.php';
include 'nav.php';





$_SESSION["loggedin"] = "0";
$_SESSION["username"] = "";


if (isset($_POST['add']) ){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (!empty($password) || !empty($username)){

            logIn($username,$password);

        }
        else{
            echo "<p class='error login'>Please provide a username and a password.</p>";
            echo '<script type="text/javascript">loginError();</script>';
        }

    }


?>
<html>
<head> <title> Log-in Form </title>
</head>
<body>

<div class="row  login small-1 medium-6 large-4 ">
    <form class="log-in-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <h2 class="text-center">Log in with your username</h2>
        <label>Username<br>
            <input type="text" name="username" >
        </label>
        <br>
        <label>Password<br>
            <input id="password" type="password" name="password" placeholder="Password">
        </label><br><br>
        <input id="show-password" onclick="myFunction()" type="checkbox"><label>Show password</label>
        <p><input type="submit" name="add" class="button expanded" value="Log in"></p>
        <a href="register.php" class="button ekatowidth">Register</a>

    </form>

</div>
<?php
include 'footer.php';
?>
<script src="foundation/js/login.js"></script>


