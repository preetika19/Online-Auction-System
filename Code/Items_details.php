<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: main.php");
  exit;
}
?>
<?php
// Include config file
require_once "config.php";
$link = $mysqli;
// Define variables and initialize with empty values
$bid = "";
$bid_err = "";

// Processing form data when form is submitted
if(isset($_POST["seller_id"]) && !empty($_POST["seller_id"]) && isset($_POST["item_id"]) && !empty($_POST["item_id"])){
    // Get hidden input value
  $seller_id = $_POST["seller_id"];
  $item_id = $_POST["item_id"];
  $buyer_id = $_SESSION['id'];
    // Validate bid
  $input_bid = trim($_POST["bid"]);
  if(empty($input_bid)){
    $bid_err = "Please enter a bid.";
  } else{
    $bid = $input_bid;
  }


    // Check input errors before inserting in database
  if(empty($bid_err)){
        //
        // Prepare an insert statement
    $sql = "SELECT * from bids where buyer_ID = ? and seller_ID = ? and item_ID = ?";
    if($stmt = mysqli_prepare($link, $sql)){

          // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "iii", $param_buyer, $param_seller, $param_item);

          // Set parameters
      $param_seller = $seller_id;
      $param_item = $item_id;
      $param_buyer = $_SESSION['id'];

          // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) >= 1){
          $sql = "UPDATE bids SET  bidStatus=?, bidPrice=?, bidIncrement=? where buyer_ID = ? and seller_ID = ? and item_ID = ?";

          if($stmt = mysqli_prepare($link, $sql)){
                  // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iiiiii",  $param_status, $param_bid, $param_increment, $param_buyer, $param_seller, $param_item);

                  // Set parameters
            $param_buyer = $buyer_id;
            $param_seller = $seller_id;
            $param_item = $item_id;
                  // $param_time = '2021-11-27 11:06:39';
            $param_status=1;
            $param_bid = $input_bid;//$bid
            $param_increment = 0;
            $val = mysqli_stmt_execute($stmt);
                  // Attempt to execute the prepared statement
            if($val){
                // Records updated successfully. Redirect to landing page
              if (isset($_POST['rate']))
              {
                $rate = $_POST['rate'];
                $rate = mysqli_real_escape_string($mysqli, $rate);
              }
              if (isset($_POST['comment']))
              {
                $comment = $_POST['comment'];
                $comment = mysqli_real_escape_string($mysqli, $comment);
              }
              
              // //UPDATE feedback SET rating="10",message="this is cool" where reviewer_ID=5 and reviewee_ID=10
              echo $rate . $comment. $buyer_id. $seller_id;
              $sql = "UPDATE feedback SET rating=?, message=? WHERE reviewer_ID=? and reviewee_ID=?";
              $stmt= $mysqli->prepare($sql);
              $stmt->bind_param("ssss", $rate, $comment, $buyer_id, $seller_id);
              $stmt->execute();
            header("location: welcome.php?");
            exit();
          } else{
              //  echo $input_bid;
            echo "Oops! Something went wrong. Please try again later.";
          }
        }
        mysqli_stmt_close($stmt);


      }

      else if(mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO bids(buyer_ID, seller_ID, item_ID, bidStatus, bidPrice, bidIncrement) VALUES(?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "iiiiii", $param_buyer, $param_seller, $param_item, $param_status, $param_bid, $param_increment);

            // Set parameters
          $param_buyer = $buyer_id;
          $param_seller = $seller_id;
          $param_item = $item_id;
            // $param_time = date("Y-m-d h:ia");
          $param_status=1;
            $param_bid = (int)$input_bid;//$bid
            $param_increment = 0;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
              if (isset($_POST['rate']))
              {
                $rate = $_POST['rate'];
                $rate = mysqli_real_escape_string($mysqli, $rate);
              }
              if (isset($_POST['comment']))
              {
                $comment = $_POST['comment'];
                $comment = mysqli_real_escape_string($mysqli, $comment);
              }
              $query = "INSERT INTO feedback( reviewer_ID, reviewee_ID, rating, message)VALUES('" . $buyer_id. "','" . $seller_id . "','" . $rate . "','" . $comment . "');";

                $result = mysqli_query($mysqli, $query);
                header("location: welcome.php");
                exit();
              } else{
              //  echo $input_bid;
                echo "Oops! Something went wrong. Please try again later.";
              }
            }
            mysqli_stmt_close($stmt);
          } 
          else{
            // URL doesn't contain valid id. Redirect to error page
            header("location: error.php");
            exit();
          }
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }
      }

      // Close statement

    }
    mysqli_stmt_close($stmt);


    // Close connection
    mysqli_close($link);

  } else{
  // Check existence of id parameter before processing further
    if(isset($_GET["item_ID"], $_GET["seller_ID"]) && !empty(trim($_GET["item_ID"], $_GET["seller_ID"])) ){
    // Get URL parameter

     $seller_id =  trim($_GET["seller_ID"]);
     $item_id =  trim($_GET["item_ID"]);
       // Prepare a select statement
     $sql = "SELECT * FROM items WHERE seller_ID = ? AND item_ID = ?";
     if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ii", $param_seller, $param_item);

            // Set parameters
      $param_seller = $seller_id;
      $param_item = $item_id;

            // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) >= 1){
        /* Fetch result row as an associative array. Since the result set
        contains only one row, we don't need to use while loop */
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        // Retrieve individual field value
        $item_id = $row["item_ID"];
        $seller_id = $row["seller_ID"];
        $bid = $row["startingBidPrice"];
        $description = $row["description"];
        $startDate = $row["startDate"];
        $endDate = $row["endDate"];
        $category = $row["category"];
        $itemTitle = $row["itemTitle"];
        $query = "SELECT MAX(bidPrice) as currentBidPrice from bids where item_ID = " . $item_id . " and seller_ID = ".$seller_id ;
        $execQuery = mysqli_query($link,$query);
        if(mysqli_num_rows($execQuery) == 0){
          $currentBid = 0;
        }
        else{
          $row2 = mysqli_fetch_array($execQuery);
          $currentBid = $row2['currentBidPrice'];
        }
      } else{
        // URL doesn't contain valid id. Redirect to error page
        header("location: error.php");
        exit();
      }

    } else{
      echo "Oops! Something went wrong. Please try again later.";
    }
  }

// Close statement
  mysqli_stmt_close($stmt);

// Close connection
  mysqli_close($link);

}  else{
// URL doesn't contain id parameter. Redirect to error page
 header("location: error.php");
 exit();
}
}
?>

<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <style>
      .col-md-3 {
        padding-bottom: 25px;
      }

      .btn-custom {
        background-color: red;
      }
    </style>

    <title>Online Auction Website</title>

  </head>
  <body>
    <!-- Gallery -->
    <div class="container">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <h3 class="card-title"><?php echo $itemTitle; ?></h3>
                <p class="card-text" style="font-size: 20px;"><?php echo $row["description"]; ?></p>
                <div class="row">
                  <label for="" class="col-md-5 col-form-label">Current Bid</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" id="" value="<?php echo $currentBid; ?>" readonly>
                    <p class="card-text"><small class="text-muted">Last updated 2 mins ago</small></p>
                  </div>
                </div>
                <br>
                <div class="row">
                  <label for="" class="col-md-5 col-form-label">Place Your Bid</label>
                  <div class="col-md-7">
                    <input type="text" name="bid" class="form-control <?php echo (!empty($bid_err)) ? 'is-invalid' : ''; ?>" id="" value="">
                    <span class="invalid-feedback"><?php echo $bid_err;?></span>
                  </div>
                </div>
                <br>
                <div class="row">
                  <label for="" class="col-md-5 col-form-label">Rating</label>
                  <div class="col-md-7">
                    <input type="text" name="rate" class="form-control" id="" value="">
                  </div>
                </div>
                <div class="row">
                  <label for="" class="col-md-5 col-form-label">Comments</label>
                  <div class="col-md-7">
                    <textarea class="form-control" name="comment"></textarea>
                  </div>
                </div>
                <br>
                <div class="row">
                  <input type="hidden" name="buyer_id" value="<?php echo $_SESSION['id']; ?>"/>
                  <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>"/>
                  <input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
                  <input type="hidden" name="bidPlacedTime" value="<?php $endDate; ?>"/>
                  <input type="hidden" name="bidStatus" value="1"/>
                  <!-- <input type="hidden" name="bidIncrement" value=""/> -->
                  <input type="submit" class="btn btn-primary mb-3" value="Submit">
                  <br>
                  <a href="welcome.php" class="btn btn-secondary ml-2">Cancel</a>
                </div>
              </form>
              <h1 style="text-align: center;">GOOD LUCK!</h1>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </body>
  </html>









