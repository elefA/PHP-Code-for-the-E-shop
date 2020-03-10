<?php
include "header.php";
include "nav.php";
include 'dbFunctions.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $rpassword= md5($_POST['rpassword']);
    $phone = $_POST['phone'];

    if (!empty($name) && !empty($username) && !empty($password) && !empty($rpassword) && $password===$rpassword)

    {
        addCustomer($username,$password,$name,$phone);
        echo "<script type='text/javascript'> document.location = 'loginform.php'; </script>";
    }
    else{
        echo "<p class='error login'>Please fill all the fields </p>";
    }
}

?>

<form class="login log-in-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

    <label>Name</label>
    <input type="text" name="name"><br>
    <label>Username</label>
    <input type="text" name="username"><br>
    <label>Password</label>
    <input type="password" name="password"><br>
    <label>Repeat Password</label>
    <input type="password" name="rpassword"><br>
    <label>Phone</label>
    <input type="text" placeholder="Not required" name="phone"><br>

    <input type="submit" class="ekatowidth button" name="add" value="Register">

</form>

<?php
include "footer.php";
?>
