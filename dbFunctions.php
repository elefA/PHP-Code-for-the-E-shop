<?php
function getCategory($category_id){
include "db.php";
    $results = $db->query("select * from categories where category_id='".$category_id."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray[0]['category_id'];
}
function getCategory1($category_id){
    include "db.php";
    $results = $db->query("select * from categories where category_id='".$category_id."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getCategoryId($category_name){
    include "db.php";
    $results = $db->query("select category_id from categories where category_name='".$category_name."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray[0]['category_id'];
}

function deleteProduct($product_code){
    include "db.php";
    $results=$db->query("select * from products where product_code = '".$product_code."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    $base_dir='images/';
    if (!empty($resultsArray)){
        unlink($base_dir.$resultsArray[0]['img_src']);
        try{
        $sql = "delete from products where product_code='".$product_code."'";
        $result = $db->prepare($sql);
        $result->execute();
        echo "<p class= \"success login\">Product was deleted successfully </p>";
        }
        catch(PDOException $e){
            echo "<p class= \"error login\">Product code was not found </p>";
        }
    }
    else{
        echo "<p class= \"error wrap\">Product code was not found </p>";
    }
    
    
}
function search($keywords){
    include "db.php";
    $results=$db->query("select * from products where product_code LIKE '%".$keywords."%' OR name LIKE '%{$keywords}%'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}


function deleteDeal ($product_id){
    include "db.php";
    $sql = "delete from deals where product_id = '" . $product_id . "'";
    $result = $db->prepare($sql);
    $result->execute();
    echo "<p class= \"success login\">Deal was deleted successfully </p>";
}


function deleteCategory($category_id){
    include "db.php";
    if ($category_id==""){
        echo "<p class= \"error login\">There are no categories. You deleted them all</p>";
    }
    else{
        $results=$db->query("select * from products where category_id = '".$category_id."'");
        $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
        $base_dir='images/';
        for ($i=0;$i<count($resultsArray);$i++){
                unlink($base_dir.$resultsArray[$i]['img_src']);
            }
        try{
            
            
            $sql = "delete  from deals where deals.product_id in 
            (select product_id from (select products.product_id as product_id from products, deals 
            where deals.product_id=products.product_id and
            products.category_id='".$category_id."') as C)"
            ;
            

            $result = $db->prepare($sql);
            $result ->execute();
            
            
            $sql = "delete from products where category_id = '" . $category_id . "'";
            $result = $db->prepare($sql);
            $result->execute();
            echo "<p class= \"error login\">Products were deleted successfully </p>";
    
            $sql1 = "delete from categories where category_id ='" . $category_id."'";
            $result1 = $db->prepare($sql1);
            $result1->execute();
            echo "<p class= \"error login\">Category was deleted successfully </p>";
            
            return true;
            
        }
        catch (PDOException $e){
            echo "<p class= error login>".$e->getMessage()." </p>";
            return false;
        }

    }
    
}
function addDeal($product_id,$newPrice){
    include "db.php";
    try{
        $sql = "insert into deals (product_id,new_price) values(?,?)";
        $result = $db->prepare($sql);
        $result->bindValue(1,$product_id);
        $result->bindValue(2,$newPrice);

        $result->execute();


        return true;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        echo "<p class='error login'>Error. Could not add Deal</p>";
        return false;
    }

}


function getProductID($product_code){
    include "db.php";

    $results = $db->query("select product_id from products where product_code='".$product_code."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}

function getProductID12($product_code){
    include "db.php";

    $results = $db->query("select product_id from products where product_code='".$product_code."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}

function getProduct($product_code){
    include "db.php";

    $results = $db->query("select * from products where product_code='".$product_code."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}

function getDeal($product_code){
    include "db.php";
    $product_id=getProductID($product_code);

    $check =  $db->query("Select * from deals where product_id='".$product_id[0]['product_id']."'");
    $resultsArray = $check->fetchAll();

    return $resultsArray;
}

function updateProduct($product_code,$price){
    include "db.php";
    $sql = "select * from products where product_code= '".$product_code."'";
    $check =  $db->query($sql);
    $result = $check->fetchAll(PDO::FETCH_ASSOC);
    $resultsArray=getDeal($product_code);

    if (count($resultsArray)){
        if($resultsArray[0]['new_price']>=$price){
            echo "<p class='login error'>Product is included in a deal and the price you inserted is less than the price of the deal. </p><br>";
            return true;
        }
    }
    if (count($result)==0){
        echo "<p class='login error'>Error. Please give a valid product code.</p><br>";
        return true;
    }
    else{
        try{
            $sql = "update products set price = ? where product_code = ?";
            $result = $db ->prepare($sql);
            $result->bindValue(1,$price);
            $result->bindValue(2,$product_code);

            $result->execute();
            echo "<p class='login success'>Product price was changed successfully.</p><br>";
            return true;
        }
        catch(PDOException $e){
            return false;
        }
    }

}







function logIn ($username,$password)
{
    session_start();
    include "db.php";
    $check =  $db->query("SELECT * FROM customers WHERE username='" . $username . "' AND password= '" . $password . "'");
    $resultsArray = $check->fetchAll();

    if (!empty($resultsArray)) {

        $_SESSION["username"] = $resultsArray[0]['username'];

        if ($_SESSION["username"] == "Admin"){
            $_SESSION["loggedin"] = "1";
        }
        else{
            $_SESSION["loggedin"] = "2";
        }

       echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }
    else{
        echo "<p class='error login'>Username and/or password were not correct.</p>";
    }
}

function addCategory($categoryname,$description,$img_path)
{

    include "db.php";
    try{
        $sql = "insert into categories (category_name,description,category_img) values(?,?,?)";
        $result = $db->prepare($sql);
        $result->bindValue(1,$categoryname);
        $result->bindValue(2,$description);
        $result->bindValue(3,$img_path);

        $result->execute();


        return true;
    }
    catch (PDOException $e){
        echo "Error " . $e->getMessage();
        return false;
    }

}




function getCategoryName($category_id){
    include "db.php";

    $results = $db->query("select category_name from categories where category_id=".$category_id);
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}


function getCategories()
{
    include "db.php";
    $results = $db->query("select * from categories");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getProducts($category_id){
    include "db.php";
    $results = $db->query("select * from products where category_id='".$category_id."'");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getProductsWithoutDeals($category_id){
    include "db.php";

    $results = $db->query("select * from products 
where product_id NOT IN (select deals.product_id from products,deals where deals.product_id=products.product_id) and category_id='".$category_id."'");


    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}



function getProductsWithDeals($category_id){
    include "db.php";
    $results = $db->query("select * from products,deals where category_id='".$category_id."' and deals.product_id=products.product_id" );
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}

function joinOffers(){
    include "db.php";
    $check =  $db->query("Select * from products,deals where products.product_id=deals.product_id");
    $resultsArray = $check->fetchAll();
    return $resultsArray;
}



function addCustomer($username,$password,$name,$phone)
{
    include "db.php";
    try{
        $sql = "insert into customers (customer_name,password,phone,username) values(?,?,?,?)";
        $result = $db->prepare($sql);
        $result->bindValue(1,$name);
        $result->bindValue(2,$password);
        $result->bindValue(3,(int)$phone);
        $result->bindValue(4,$username);
        $result->execute();

        return true;
    }
    catch (PDOException $e){
        echo "<p class='login error'> Username already taken</p>";
        return false;
    }
    
}

function findCategory($category){
    include "db.php";
    $sql = "select * from categories where category_name= '".$category."'";
    $check =  $db->query($sql);
    $result = $check->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}



function addProduct($name, $price, $stock, $category_id, $img_source, $productcode) {
      include "db.php";
      try{ 
      $sql = "insert into products (name,price,stock,category_id,img_src, product_code) values (?,?,?,?,?,?)";
      $result = $db->prepare($sql);
      $result->bindValue(1,$name);
      $result->bindValue(2,$price);
      $result->bindValue(3,$stock);
      $result->bindValue(4,$category_id);
      $result->bindValue(5,$img_source);
      $result->bindValue(6,$productcode);


      $result->execute();
      return true;
      } catch (PDOException $e) {
          echo "<p class='login error'>Error. Please give a unique product code.</p><br>";
          return false;
      }
}

