<?php
    include '../database/database.php';

    $database = new Database;

    // Admin listing
    $database->query('SELECT * FROM reviews LEFT JOIN products ON reviews.product_id = products.id ORDER BY reviews.rating ASC');
    $allReviews = $database->resultset();
?>
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
    <nav>
        <div class="navbar">
            <ul>
                <li><a href="../index.php">Submit a Review</a></li>
                <li><a href="reviews-listing.php">View All Reviews</a></li>
                <li><a href="reviews-sentiment.php">Customer Sentiment</a></li>
                <li><a href="reviews-reporting.php">Reporting</a></li>
            </ul>
        </div>
    </nav>
    <h1>CRM - Customer Sentiment</h1>
    <body>
        <div style="margin:50px">
            <table style="text-align:left">
                <tr>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Customer</th>
                    <th>Contact</th>
                </tr>
                <?php
                    foreach ($allReviews as $review) {
                        echo '<tr>
                                  <th style="white-space: nowrap">'.$review['date'].'</th>
                                  <th style="text-align:center">'.$review['rating'].'</th>
                                  <th>'.$review['review'].'</th>
                                  <th>'.$review['user_name'].'</th>
                                  <th><a href = "mailto: '.$review['user_email'].'">Send Email</a></th>
                             </tr>';
                    }
                ?>
            </table>
        </div>
    </body>

</html>
