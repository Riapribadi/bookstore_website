<!doctype html>
<html lang="en">
<head>
    <title>Spoon+Fork - Category</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/category.css">
</head>
<body>
<main>
    <?php
    session_start();

    include('header.php');
    ?>
    <main>
        <?php
        if (isset($db) == false){
            initdb($password, $database);
        }

        $categories = getCategories($db);
        ?>

        <section class="mainPage">
            <?php
            $cart = 'Add to cart';
            if (isset($_GET['categoryId'])) {
                $categoryId = $_GET['categoryId'];
            } else {
                $categoryId = 1;
            }

            $_SESSION['categoryId'] = $categoryId;  // store selected category as session variable

            $books = getBooks($db, $categoryId);
            $imageFolders = array('asian', 'european', 'latinAmerican', 'middleEastern');
            foreach ($books as $book) {
                $bookId = $book['bookId'];
                $title = $book['title'];
                $author = $book['author'];
                $price = $book['price'];
                $image = '/images/'.$imageFolders[$categoryId - 1].'/'.$book['image'].'.jpg';
                if (isset($book['readNow'])) {
                    if ($book['readNow'] == 0){
                        $readNow = "";
                        $readNowClass = 'hide';
                    } else{
                        $readNow = "Read now";
                        $readNowClass = 'button';
                    }
                } else {
                    $readNow = "";
                    $readNowClass = 'hide';
                }

                echo "<div class='books'>
                      <img src=$image alt=$title>
                        <div>
                            <ul>
                            <li><h3>$title</h3></li>
                            <li><h5>$author</h5></li>
                            <li><h4>$price</h4></li>     
                            <li class='button'><a href='cart.php?bookId=$bookId'><p>".$cart."</p></a></li>
                            <li class=$readNowClass><a href='#'><p>$readNow</p></a></li>
                            </ul>
                        </div>
                      </div>";
            }
            ?>
        </section>

    </main>
    <?php
    include('footer.php');
    ?>
</main>
</body>
</html>