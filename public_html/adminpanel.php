<?php
session_start();
include "header.php";
include "nav.php";

if (!$_SESSION['username']=="Admin") {
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
?>
<div class="row login  products">
    <a href="addproduct.php" class="button ekatowidth">Add a Product</a><br><br>
    <a href="addcategory.php" class="button ekatowidth">Add a Category</a><br><br>
    <a href="updateproduct.php" class="button ekatowidth">Update a Product</a><br><br>
    <a href="deleteProduct.php" class="button ekatowidth">Delete a Product or a Category</a>
    <a href="adddeal.php" class="button ekatowidth">Add a deal</a>
    <a href="deletedeal.php" class="button ekatowidth">Delete a deal</a>

</div>

<?php
include "footer.php";
?>






