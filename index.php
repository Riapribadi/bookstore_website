<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spoon+Fork</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php
session_start();

include('header.php');
?>

<main>
    <div class="welcomeDisplay">
        <img src="images/otherImages/kitchen5.jpg" alt="photo">
        <div class="centerLeft">ONE RECIPE, A GOOD BOOK, AND YOU.</div>
    </div>
    <div>
        <h1>Shop by:</h1>
        <h1 id="cuisineCategory">Cuisine Categories</h1>
    </div>
    <section id="mainTop">
        <?php
        if (isset($db) == false){
            initdb($password, $database);
        }

        $categories = getCategories($db);
        foreach($categories as $category){
            $categoryId = $category['categoryId'];
            $categoryName = $category['categoryName'];
            $categoryNameString = str_replace(' ', '_', strtolower($categoryName));
            echo "<h2><a href='category.php?categoryId=$categoryId'><img src='images/category/$categoryNameString.jpg' alt='$categoryNameString'><br>" . $categoryName . "</a></h2>";
        }

        ?>
    </section>

    <section id="mainBottom">
        <div id="welcomeMessage">Welcome to Spoon+Fork Bookstore</div>
        <div id="firstLine">Here you can find lots of recipe and other culinary books you are looking for, to expand your culinary horizons, one recipe at a time!</div>
    </section>
</main>

<?php
include('footer.php');
?>

</body>
</html>