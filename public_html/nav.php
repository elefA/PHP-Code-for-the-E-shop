<?php
if (isset($_GET['search'])){

}

?>


<nav class="top-bar">
    <div class="top-bar-left ">

        <ul class="dropdown menu align-middle small-1" data-dropdown-menu>
            <a href="index.php"><img src="images/Untitled22.png"></a>
            <li>
                <a href="categories.php">Product Categories</a>
                
            </li>
            

            <li>
                <?php
                if ($_SESSION["loggedin"] == "1"){
                    echo "<a href='adminpanel.php'>Admin Panel</a>";
                }
                ?>
            </li>
            <li class="welcome"><?php
                if(!empty($_SESSION["username"]))
                {echo("Welcome ". $_SESSION['username']."     ");}?>
            </li>
            <li>   <?php
                if(!empty($_SESSION["username"]))
                    echo "<a href='logout.php' class='button'> Log out</a>";


                else{
                    echo("<a href='loginform.php' class='button'>Log in</a> ");
                }
                ?>

            </li>
        </ul>


    </div>
    <div class="top-bar-right small-up-12" >

            <form  action="search.php"   method="get">
                <input type="text" name="keywords" class="inline" placeholder="Search for Products">

                <input type="submit" class="button inline" value="Search" >


            </form>


    </div>
</nav>

