<?php
session_start();
include "dbFunctions.php";
include "header.php";
include "nav.php";

if (isset($_SESSION['category_id'])) {
    {
        $category_id = $_SESSION['category_id'];
    }


    $products = getProductsWithoutDeals($category_id);
    $results = getProductsWithDeals($category_id);
?>
    <h2  class="text-center title wrap"><?php $category_name = getCategoryName($category_id); echo $category_name[0]['category_name'];?></h2>


    <div class=" row wrap products">
<?php
for($i=0;$i<count($results);$i++){
    echo("
    <div class=\"column inline \">
        <div class=\"product-card\">
            <div class=\"product-card-thumbnail\">
                <a href=\"#\"><img src=\"images/".$results[$i]['img_src']."\"/></a>
            </div>
            <h2 class=\"product-card-title\"><a href=\"#\">".$results[$i]['name']."</a></h2>
            <span class=\"product-card-price\">New Price:".$results[$i]['new_price']."$ &nbsp;Product Code:".$results[$i]['product_code']."</span><br>
            <span class='product-card-price'>Old Price:</span><span class=\"product-card-sale\">:".$results[$i]['price']."</span>
            
        </div>
    </div>");
}
    for ($i = 0; $i < count($products); $i++){
        echo(


            "<div class=\"column inline \">".
                "<div class=\"product-card\">".
                    "<div class=\"product-card-thumbnail\">".
                        "<a href=\"#\"><img src=\"images/".$products[$i]['img_src']."\"/></a>".
                    "</div>".
                    "<h2 class=\"product-card-title\"><a href=\"#\">".$products[$i]['name']."</a></h2>".
                  "<span class=\"product-card-price\">Product Code: ".$products[$i]['product_code']."&emsp;&emsp;$".$products[$i]['price']."</span>".
                "<br><br><br></div>".
            "</div>"
         );
    }
    ?>
    </div>
<?php
}
include "footer.php";
?>