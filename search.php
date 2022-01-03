<?php
session_start();
include('header.php');

initdb($password, $database);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Spoon+Fork - Search</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<main>
    <?php
    if (isset($search)) {
        $searchBook = searchBook($search);
        print_r($searchBook);
    }
    ?>


</main>
<?php
include('footer.php')
?>
</body>
</html>
