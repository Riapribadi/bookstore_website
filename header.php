<header>
    <div id="leftHeader">
        <a href="index.php">
            <img src="images/logo/spoon_fork.jpg" alt="logo"/>
        </a>
    </div>
    <div id="midHeader">
        <div class="dropdown">
            <form id="searchBoxForm" method="post" action="search.php">
                <input id="searchBox" type="text" value="Search" ><input type="submit">
                <input id="searchIcon" type="image"
                       src="images/icon/search_icon.jpg" alt="search icon">
            </form>
            <div class="dropdown">
                <?php
                include('database_functions.php');

                ?>
                <p class="dropdownSelect">Select Category</p>
                <div class="dropdownContent">
                    <?php
                    initdb($password, $database);
                    $categories = getCategories($db);
                    foreach($categories as $category){
                        $categoryId = $category['categoryId'];
                        $categoryName = $category['categoryName'];
                        $categoryNameString = str_replace(' ', '_', strtolower($categoryName));
                        echo "<p><a href='category.php?categoryId=$categoryId'>". $categoryName ."</a></p>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="rightHeader">
        <div id="cartIcon"><a href="cart.php">
                <img src="images/icon/shopping_cart_icon.jpg" alt="shopping cart icon"></a>
        </div>
        <div id="cartCount">
            <?php
            if (isset($_SESSION['cartQuantity'])) {
                $cartQuantity = $_SESSION['cartQuantity'];
            } else {
                $cartQuantity=0;
            }
            echo $cartQuantity;

            ?> items</div>
        <div id="loginButton"><a href="login.php">Login</a></div>
    </div>
</header>
