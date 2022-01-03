<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spoon+Fork Bookstore</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php
session_start();
include('header.php');

function getAllBooks($db)
{
    $query = "SELECT bookId, categoryId, title, author, price, stockQuantity FROM book";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $allBooks = $result->fetch_all(MYSQLI_ASSOC);
    return $allBooks;
}

?>
<div>
    <h1>Admin Page </h1>
</div>

<div class="content">
    <h1>Here are all the books we have in stock:</h1>
    <div id="booksGrid">
        <div class="gridHeader">BookId</div>
        <div class="gridHeader">CategoryId</div>
        <div class="gridHeader">Title</div>
        <div class="gridHeader">Author</div>
        <div class="gridHeader">Price</div>
        <div class="gridHeader">Stock Quantity</div>

        <?php
        $allBooks = getAllBooks($db);
        foreach ($allBooks as $book) {
            $bookId = $book['bookId'];
            $categoryId = $book['categoryId'];
            $title = $book['title'];
            $author = $book['author'];
            $price = $book['price'];
            $stockQuantity = $book['stockQuantity'];
            echo "<div class='gridText'>$bookId</div>
                    <div class='gridText'>$categoryId</div>
                    <div class='gridText'>$title</div>
                    <div class='gridText'>$author</div>
                    <div class='gridText'>$price</div>
                    <div class='gridText'>$stockQuantity</div>";
        }

        ?>

    </div>
</body>

<div id="outButton"><a href="logout.php">Log Out</a></div>


<?php
include('footer.php');
?>
</html>
