<?php
session_start();
include "dbFunctions.php";
include "header.php";
include 'nav.php';
?>
<!--CAROUSEL-->
<div id="myCarousel" class="carousel margin-bottom" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="login item active">
            <img src="images/1.png" alt="Los Angeles">
        </div>

        <div class="login item">
            <img src="images/2.png" alt="Chicago">
        </div>

        <div class="login item">
            <img src="images/3.png" alt="New York">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!--   Deals  -->
<div class=" login log-in-form title">
    <h4>Deals for You</h4>
</div>

<div class="row wrap products  ">
    <?php
    $results = joinOffers();
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
    ?>

</div>

<?php
include "footer.php";
?>


</body>
</html>