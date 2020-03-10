<?php
session_start();
include "dbFunctions.php";
include "header.php";
include "nav.php";
$categories=getCategories();

?>

<?php
if ($_SESSION['username']=="Admin") {
    if (isset($_POST['add'])) {
//    Image variables to upload it correctly.
        $file = $_FILES['fileToUpload'];

        $fileName = $_FILES['fileToUpload']['name'];
        $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
        $size = $_FILES['fileToUpload']['size'];
        $error = $_FILES['fileToUpload']['error'];
        $type = $_FILES['fileToUpload']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');


        //  add product in database. variables and function.

        $productName = $_POST['productname'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category = $_POST['categories'];
        $productcode = $_POST['productcode'];
        $row = findCategory($category);
        $categoryID = $row[0]['category_id'];


        if (!empty($_POST['productname']) && !empty($_POST['price']) && !empty($_POST['stock']) && !empty($_POST['productcode']) && !empty($fileName)) {

            if (in_array($fileActualExt, $allowed)) {
                if ($error === 0) {
                    if ($size < 1000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'images/' . $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            echo "<p class='success login'>Success.</p>";
                        }
                    } else {

                        echo "<p class='error login'>Image size is too big.</p>";
                    }
                } else {
                    echo "<p class='error login'>There was an error uploading the image.</p>";
                }
            } else {
                echo "<p class='error login'>Please upload a valid image file.</p>";
            }
            if (!empty($fileNameNew)) {
                addProduct($productName, $price, $stock, $categoryID, $fileNameNew, $productcode);
            } else {
                echo "<p class='error login'>Could not register that product file.</p>";
            }


        }
        else {
            echo "<p class='error login'>Please provide an image and fill all the other fields.</p>";
        }
    }
}
else{
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}







?>

    <div class="row  login small-1 medium-6 large-4 ">
        <form class="log-in-form" method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <h2 id="par" class="text-center">Add Product</h2>

            <label>Product Name<br>
                <input id="productname" type="text" name="productname" >
            </label>
            <br>

            <label>Product Code<br>
                <input id="productcode" type="text" name="productcode" >
            </label>
            <br>

            <label>Price<br>
                <input id="productprice" type="number" name="price"   min="0" step=".01" >
            </label>
            <br>

            <label>Stock<br>
                <input id="stock" type="number" min="0" name="stock" >
            </label>
            <br>

            <label>Select Category<br>
                <select name="categories">
                    <?php
                    for($i=0; $i<count($categories);$i++ ){
                        echo "<option value='".$categories[$i]['category_name']."'>".$categories[$i]['category_name']."</option>";
                    }
                    ?>

                </select>
                <label>Select image to upload:<br>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </label><br><br>

            <p><input id="addbtn" type="submit" name="add" class="button expanded" value="Add"></p>


        </form>

    </div>
    <?php
    include 'footer.php';
    ?>

