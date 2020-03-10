<?php
session_start();
include "dbFunctions.php";
include "header.php";
include "nav.php";


if ($_SESSION['username']=="Admin") {


    if (isset($_POST['add'])) {
            $productcode = $_POST['productcode'];
            $newprice = $_POST['price'];
        if (isset($productcode) && isset($newprice)) {
            
            $product = getProduct($productcode);

            $deal = getDeal($productcode);
            
            if (count($product)) {
                if (count($deal)){
                    echo "<p class='error login'>There is already a deal for this product. Please delete the deal first</p>";
                }
                else {
                    if ($newprice > $product[0]['price']) {
                        echo "<p class='error login'>The price you gave for this deal was more expensive than the current price</p>";
                    } else {


                        $id = $product[0]['product_id'];
                        addDeal($id, $newprice);
                        echo "<p class='success login'>Deal was added successfully</p>";
                    }
                }
            }

            else {
                echo "<p class='error login'>There was no product associated with this product code</p>";
            }

        }
    }
}
else
{
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}


?>


<div class="row  login small-1 medium-6 large-4 ">
    <form class="log-in-form" method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <h3 id="par" class="text-center">Add a Deal based on product code</h3>



        <label>Product Code<br>
            <input id="productcode" type="text" name="productcode" required >
        </label>
        <br>

        <label>New Price<br>
            <input id="productprice" type="number" name="price"   min="0" step=".01" required>
        </label>
        <br>





            <p><input id="addbtn" type="submit" name="add" class="button expanded" value="Add"></p>


    </form>

</div>

<?php
include "footer.php";
?>