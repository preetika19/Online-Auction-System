<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: main.php");
    exit;
}

// if($_SESSION["user"] == "seller"){

//     echo '<script>
//     $(function() {
//         $("#seller_marketplace").show()
//      });
//      </script>';
//  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Welcome</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <style>
     body{ font: 14px sans-serif; text-align: center; }
 </style>
</head>
<body>
 <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
 <p>
     <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
 </p>
 <a href="search.php" class="btn btn-danger ml-3">Search</a>
 <?php
 if($_SESSION['user'] == "buyer") {
    
    ?>
    <a href="purchase_history.php" class="btn btn-danger ml-3">Purchase History</a>
 <?php
}
?>
<?php
 if($_SESSION['user'] == "seller") {
    ?>
    <a href="seller_marketplace.php" class="btn btn-danger ml-3" id="seller_marketplace">Seller Marketplace</a>
    <?php
}
?>
</body>
</html>

<script>

</script>
