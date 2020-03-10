<?php
session_start();
include "dbFunctions.php";
include "header.php";
include "nav.php";
if (!$_SESSION['username']="Admin"){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
else{
    $categories = getCategories();
    if (!empty($_POST['deletecat'])){
        $category= $_POST['categories'];
        $categoryId = getCategoryId($category);


        deleteCategory($categoryId);
    }
    if (isset($_POST['deleteprod'])){
        if (!empty($_POST['productcode'])){
            $product_code = $_POST['productcode'];

            deleteProduct($product_code);
        }
        else{
            echo "<p class= 'error login'>Please fill the product code </p>";}
    }
}


?>
<div class="row  login small-1 medium-6 large-4 ">
    <form class="log-in-form" method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <h2 id="par" class="text-center">Delete Product</h2>


        <label>Product Code<br>
            <input id="productcode" type="text" name="productcode" >
        </label>
        <br>

        <p><input id="deleteprod" type="submit" name="deleteprod" class="button expanded" value="Delete Product"></p>




        <h2 id="par" class="text-center">Delete a Category and all its Products</h2>
        <label>Select Category </label><br>
            <select name="categories">
                <?php
                for($i=0; $i<count($categories);$i++ ){
                    echo "<option value='".$categories[$i]['category_name']."'>".$categories[$i]['category_name']."</option>";
                }
                ?>

            </select>


            <p><input id="deletecat"  type="submit" name="deletecat" class="button expanded" value="Delete Category"></p>


    </form>

</div>

<?php
include "footer.php";
?>
<script src="foundation/js/deleteProd.js"></script>

