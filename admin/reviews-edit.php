<!doctype html>
<html lang="en">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Product Reviews Page">
        <meta name="author" content="Cate Faull">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/2c41f62134.js" crossorigin="anonymous"></script>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css">
        <title>Reviews Edit</title>
    </head>
<?php
    include '../database/database.php';
    $database = new Database;

    // Review to Edit
    if(isset($_GET["id"])){
        $reviewID = htmlspecialchars($_GET["id"]);
    }
    else {
        header('Location: ../admin/reviews-listing.php');
    }

    // Sanitize Admin Edit
    $saveReview = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if($saveReview['save']){
        $review    = trim($saveReview['review']);
        $name      = trim($saveReview['user_name']);
        $email     = trim($saveReview['user_email']);

        $database->query('UPDATE reviews SET review = :review, user_name = :name, user_email = :email WHERE reviews.id = :id');
        $database->bind(':review', $review);
        $database->bind(':name', $name);
        $database->bind(':email', $email);
        $database->bind(':id', $reviewID);
        $database->execute();

        sleep(5);
        if($database->lastInsertId()){
            // Alert that says saved
            ?><script> alert('This review edit has been saved'); </script><?php;
            // Refresh page
            header($_SERVER['PHP_SELF']);
        }
    }

    $database->query('SELECT * FROM reviews LEFT JOIN products ON reviews.product_id = products.id WHERE reviews.id ='.$reviewID);
    $editReview = $database->resultset();
?>
<nav>
    <div class="navbar">
        <ul>
            <li><a href="../index.php">Submit a Review</a></li>
            <li><a href="reviews-listing.php">View All Reviews</a></li>
            <li><a href="reviews-sentiment.php">Manage Sentiment</a></li>
            <li><a href="reviews-reporting.php">Reporting</a></li>
        </ul>
    </div>
</nav>
<body>
    <div style="padding: 50px;">
        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset style="font-family: Open Sans">
                <legend>Edit Review</legend>
                <p>
                    <label for="date"><?php echo 'Date: '.$editReview[0]['date']; ?></label>
                </p>
                <p>
                    <label for="review">Review:</label>
                    <input type="text" name="review" value="<?php echo $editReview[0]['review'] ?>" style="font-family: Open Sans">
                </p>
                <p>
                    <label for="user_name">Name:</label>
                    <input type="text" name="user_name" value="<?php echo $editReview[0]['user_name'] ?>" style="font-family: Open Sans">
                </p>
                <p>
                    <label for="user_email">Email Address:</label>
                    <input type="email" name="user_email" value="<?php echo $editReview[0]['user_email'] ?>" style="font-family: Open Sans">
                </p>
                <p>
                    <input type="submit" name="save" value="Save" style="font-family: Open Sans">
                </p>
            </fieldset>
        </form>
    </div>
</body>

</html>
