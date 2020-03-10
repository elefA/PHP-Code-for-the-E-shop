<?php
session_start();
include "header.php";
include "nav.php";
include "dbFunctions.php";
if (!$_SESSION['username']=="Admin"){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
else{
    if (isset($_POST['add']))
    {
        $product_code=$_POST['productcode'];
        $product_price= $_POST['price'];
        updateProduct($product_code,$product_price);
    }
}

?>

<div class="row  login small-1 medium-6 large-4 ">
    <form class="log-in-form" method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <h2 id="par" class="text-center">Update a Product</h2>

        <label>Product Code<br>
            <input id="productcode" type="text" name="productcode" required >
        </label>
        <br>

        <label>New Price<br>
            <input id="productprice" type="number" name="price"   min="0" step=".01" required >
        </label>
        <br>





            <p><input id="addbtn" type="submit" name="add" class="button expanded" value="Add"></p>


    </form>

</div>




<?php
include "footer.php";
?>
