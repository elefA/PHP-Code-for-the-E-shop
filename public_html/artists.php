<html>
<head> <title> Manage Artists</title>
</head>
<body>
    <h2> Artists</h2>
<?php

include 'dbFunctions.php';

if (isset($_POST['add'])) { 
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	
	if (!empty($name) && !empty($username) && !empty($password))

	    addCustomer($username,$password,$name,$phone);
} 

if(isset($_POST['delete'])) { 
	$name = $_POST['name']; 
	deleteArtist($name);
} 

if (isset($_POST['update'])) { 
	$name = $_POST['newName']; 
	$id = $_POST['id']; 
	if (!empty($name) && !empty($id))
	    updateArtist($id, $name);
}



echo "Hello";?>
 <table border="1"> 
 
 <?php
 foreach ($artists as $row) {
     echo '<tr>';
	echo '<td>' . $row['id'] . '</td> <td>'. $row['name'] . '</td>';
	 echo '</tr>';
 }

?> 
</table>
<h2> Add a new Customer</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

  <input type="text" name="name"><br>
  <input type="text" name="username"><br>
  <input type="text" name="password"><br>
  <input type="number" name="phone"><br>
  
  <input type="submit" name="add" value="Add Artist">
  <input type="submit" name="delete" value="Delete Artist"><br> 
</form>

<h2> Change an artist Name</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="text" name="id"> 
  <input type="text" name="newName"> 
  <input type="submit" name="update" value="Update Artist name">
  
</form>

</body>
</html>