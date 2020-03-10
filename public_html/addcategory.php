<?php
session_start();
include "dbFunctions.php";
include "header.php";
include "nav.php";


if ($_SESSION['username']=="Admin") {

    if (isset($_POST['addcategory'])) {

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

        // Form Data
        $categoryName = $_POST['categoryname'];
        $description = $_POST['categorydescription'];
        if (!empty($_POST['categoryname']) && !empty($fileName)) {

            if (in_array($fileActualExt, $allowed)) {
                if ($error === 0) {
                    if ($size < 1000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'images/' . $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination))
                            echo "<p class='login success'>Success.</p><br>";
                    } else {
                        echo "<p class='login error'>Error. Image size is too big.</p><br>";
                    }
                } else {
                    echo "<p class='login error'>Error. Please provide an image file.</p><br>";
                }
            } else {
                echo "<p class='login error'>Error. Please provide an image file.</p><br>";
            }
            if (!empty($fileNameNew))

                addCategory($categoryName,"", $fileNameNew);
        }
        else{
            echo "<p class='login error'>Error. Please select an image and provide a category name.</p><br>";
        }
    }


}
else{
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}



?>


<div class="row  login small-1 medium-6 large-4 ">
    <form class="log-in-form" method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <h2  class="text-center">Add a Category</h2>

        <label>Category Name<br>
            <input id="categoryname" type="text" name="categoryname" >
        </label>
        <br>
        <label>Description<br>
            <input id="categorydescription" type="text"  name="categorydescription" >
        </label>
        <br>




            <label>Select image to upload:<br>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </label><br><br>

            <p><input id="addbutton" type="submit" name="addcategory" class="button expanded" value="Add"></p>


    </form>

</div>



<?php
include "footer.php";
?>
