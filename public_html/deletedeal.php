<?php
session_start();
include "header.php";
include "nav.php";
include "dbFunctions.php";


if (!$_SESSION['username']=="Admin")
{
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
else{
    if (isset($_POST['deletedeal'])) {
        $product_code = $_POST['productcode'];
        $product_id = getProductID($product_code);
        $deal = getDeal($product_code);
        print_r($deal);
        if (count($deal)){
            deleteDeal($product_id[0]['product_id']);
            echo "<p class= \"success login\">Deal was deleted successfully </p>";
        }
        else{
            echo "<p class= \"error login\">There was no deal associated with this product code </p>";
        }
    }
}
?>

<form class="log-in-form login" method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <h2 id="par" class="text-center">Delete Deal</h2>


    <label>Product Code<br>
        <input id="productcode" type="text" name="productcode" required >
    </label>
    <br>

    <p><input id="deleteprod" type="submit" name="deletedeal" class="button expanded" value="Delete Deal"></p>






</form>

<?php
include "footer.php";
?>
