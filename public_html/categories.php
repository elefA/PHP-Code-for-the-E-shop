<?php
session_start();
include "header.php";
include "nav.php";
include "dbFunctions.php";

if (isset($_GET['category_id'])){

    $_SESSION['category_id']=$_GET['category_id'];
    echo "<script type='text/javascript'> document.location = 'products.php'; </script>";
}
?>

    <h2  class="text-center title wrap">Categories</h2>
    <div class="row wrap products ">
        <?php
        $categories = getCategories();
        for ($i = 0; $i < count($categories); $i++) {
            echo(

            "<div class=\"column inline \">".
                "<div class=\"product-card\">".
                    "<div class=\"product-card-thumbnail\">".
                        "<a href=\"?category_id=".$categories[$i]['category_id']."\">".
                        "<img class='image1' src=\"images/".$categories[$i]['category_img']."\"/></a>".
                    "</div>".
                    "<h2 class=\"product-card-title\"><a href=\"#\">".$categories[$i]['category_name']."</a></h2>".
                "</div>".
            "</div>");
        }
        ?>

    </div>


<?php
include "footer.php";
?>