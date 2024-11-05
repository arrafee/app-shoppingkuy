<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-seo-dream.css">
  <link rel="stylesheet" href="assets/css/animated.css">
  <link rel="stylesheet" href="assets/css/owl.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  
  <title>Rate</title>
<style>
  .card{
    margin: 250px auto;
        width: 400px;
        padding: 10px;
        border: 1px solid #ccc;
    background-color: transparent;
  }
  .card-open {
  overflow: hidden;
}
h3{
  text-align:center;
  
}
</style>
</head>

<body>
<div class="card" style="width: 20rem;">
  <div class="card-body">
    <form action="" method="post">
    <div>
    <h3>Rating Produk</h3>
    </div>
    <div>
    <label>Review barang</label>
    <input type="text" name="name" class="form-control" required>
    </div>
    <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
    </div>
    <span class='result'>0</span>
    <input type="hidden" name="rating">
    <div><input type="submit" name="add"> 
    
  </div>
    </form>
  </div>
</div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <script>
    $(function() {
      $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
        var rating = data.rating;
        $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
        $(this).parent().find('.result').text('rating :' + rating);
        $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
      });
    });
  </script>
</body>
</html>
<?php
require 'db.php';

if (isset($_POST['add'])) {
  $name = $_POST["name"];
  $rating = $_POST["rating"];

  $sql = "INSERT INTO data (name,rate) VALUES ('$name','$rating')";

  if (mysqli_query($conn, $sql)) {
  } else {
  }

  mysqli_close($conn);
}
?>