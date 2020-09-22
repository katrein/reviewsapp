<?php
    include 'database/database.php';

    $database = new Database;
    $database->query('SELECT * FROM products');
    $products = $database->resultset();

    // Sanitize  review
    $newReview = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if(isset($newReview['submit'])){
        $product   = filter_var($newReview['product'], FILTER_SANITIZE_STRING);
        $rating    = filter_var($newReview['rating'], FILTER_VALIDATE_INT);
        $review    = filter_var(trim($newReview['review']), FILTER_SANITIZE_STRING);
        $date      = date("Y-m-d");
        $name      = filter_var(trim($newReview['user_name']), FILTER_SANITIZE_STRING);
        $email     = filter_var(trim($newReview['user_email']), FILTER_SANITIZE_EMAIL);

      	$database->query('INSERT INTO reviews (id, product_id, rating, review, date, user_name, user_email) VALUES(null, :product, :rating, :review, :date, :name, :email)');
      	$database->bind(':product', $product);
      	$database->bind(':rating', $rating);
        $database->bind(':review', $review);
        $database->bind(':date', $date);
        $database->bind(':name', $name);
        $database->bind(':email', $email);
      	$database->execute();
      	// if($database->lastInsertId()){
      	// 	  echo '<p>Review Added!</p>';
      	// }
    }
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
    <link rel="stylesheet" href="css/main.css">

    <title>Product Reviews</title>
</head>

<nav>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Submit a Review</a></li>
            <li><a href="admin/reviews-listing.php">View All Reviews</a></li>
            <li><a href="admin/reviews-sentiment.php">Manage Sentiment</a></li>
            <li><a href="admin/reviews-reporting.php">Reporting</a></li>
        </ul>
    </div>
</nav>

<body>
    <div style="padding: 50px;">
        <div>
            <img src="img/cupcake.png" width=350px>
        </dv>
        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset style="font-family: Open Sans">
                <legend align="center">Review Product</legend>
                <p>
                    <label for="product">Please select Product to Review:</label>
                    <select id="product" name="product" style="font-family: Open Sans" required>
                        <option value=""></option>
                        <?php
                            foreach ($products as $product ){
                                echo '<option value="'.$product['id'].'">'.$product['item_name'].'</option>';
                            }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="rating">Select Star Rating:</label>
                    <input type="hidden" name="rating" id="rating">
                    <i class="fa fa-star" data-index="0"></i>
                    <i class="fa fa-star" data-index="1"></i>
                    <i class="fa fa-star" data-index="2"></i>
                    <i class="fa fa-star" data-index="3"></i>
                    <i class="fa fa-star" data-index="4"></i>
                </p>
                <p>
                    <label for="review">Write Review:</label>
                    <textarea name="review" rows="8" cols="40" required></textarea>
                </p>
                <p>
                    <label for="user_name">Your Name:</label>
                    <input type="text" name="user_name" required>
                </p>
                <p>
                    <label for="user_email">Your Email Address:</label>
                    <input type="email" name="user_email" required>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit" style="font-family: Open Sans">
                </p>

            </fieldset>
        </form>
    </div>

    <script>
        var ratedIndex = -1;

        $(document).ready(function(){
            resetStarColours();

            $('.fa-star').on('click', function(){
                ratedIndex = parseInt($(this).data('index'));
                $('#rating').val(ratedIndex+1);
            });

            $('.fa-star').mouseover(function(){
                resetStarColours();
                var currentIndex = parseInt($(this).data('index'));
                for (var i=0; i <= currentIndex; i++){
                    $('.fa-star:eq('+i+')').css('color','black')
                }
            });

            $('.fa-star').mouseleave(function(){
                resetStarColours();
                if (ratedIndex != -1){
                    for (var i=0; i <= ratedIndex; i++){
                        $('.fa-star:eq('+i+')').css('color','black')
                    }
                }
            });

            function resetStarColours(){
                $('.fa-star').css('color','#D6D6D6')
            }
        })
    </script>
</body>
</html>
