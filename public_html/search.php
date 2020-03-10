<?php
session_start();
include "header.php";
include "nav.php";
include "dbFunctions.php";

if (isset($_GET['category_id'])){

    $_SESSION['category_id']=$_GET['category_id'];
    echo "<script type='text/javascript'> document.location = 'products.php'; </script>";
}

if(isset($_GET['keywords'])){
    $keywords = ($_GET['keywords']);
    $results = search($keywords);

}
else{
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
?>
<h2  class="text-center">Search Results</h2>
<div class=" row wrap products">
<?php

if (count($results)){
    $category_id = $results[0]['category_id'];
    for ($i = 0; $i < count($results); $i++){
        echo(


            "<div class=\"column inline \">".
                "<div class=\"product-card\">".
                    "<div class=\"product-card-thumbnail\">".
                        "<a href=\"#\"><img src=\"images/".$results[$i]['img_src']."\"/></a>".
                    "</div>".
                    "<h2 class=\"product-card-title\"><a href=\"#\">".$results[$i]['name']."</a></h2>".
                    "<span class=\"product-card-price\">Product Code: ".$results[$i]['product_code']."&emsp;&emsp;$".$results[$i]['price']."</span>".
                "<br><br><br>".
                "</div>".
            "</div>"
        );
    }
echo"</div>".
"<br><br><br>".
"<h2 class='text-center'> Other results that might interest you </h2>
<div class=\"row wrap products \">";
    $categories=getCategory1($category_id);
    echo(

        "<div class=\"column  inline \">".
        "<div class=\"product-card\">".
        "<div class=\"product-card-thumbnail\">".
        "<a href=\"?category_id=".$categories[0]['category_id']."\">".
        "<img class='image1' src=\"images/".$categories[0]['category_img']."\"/></a>".
        "</div>".
        "<h2 class=\"product-card-title\"><a href=\"#\">".$categories[0]['category_name']."</a></h2>".
        "</div>".
        "</div>".
        "</div>");




}
else{
    echo "<p class='login error'>No results were found matching your search.</p><br>";
}

?>

<?php
include "footer.php";
?>
