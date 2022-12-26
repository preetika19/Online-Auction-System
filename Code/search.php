<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: main.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
      <a href="welcome.php" class="btn btn-danger ml-3">Home</a>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <h2 style="text-align:left">Search Items</h2>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <?php
        // Include config file
        require "config.php";
        $link = $mysqli;

        // Attempt select query execution
        $sql = "SELECT * FROM items";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo '<table class="table table-bordered table-striped">';
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Item Name</th>";
                            echo "<th>Category</th>";
                            echo "<th>Description</th>";
                            echo "<th>StartingBid</th>";
                            echo "<th>CurrentBid</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        $query = "SELECT MAX(bidPrice) as currentBidPrice from bids where item_ID = " . $row['item_ID'] . " and seller_ID = ".$row['seller_ID'] ;
                         $execQuery = mysqli_query($link,$query);
                            echo "<td>" . $row['item_ID'] . "</td>";
                            echo "<td>" . $row['itemTitle'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['startingBidPrice'] . "</td>";
                            // echo $query;
                            if(mysqli_num_rows($execQuery) == 0){
                                    $currentBid = 0;
                            }
                            else{
                                $row2 = mysqli_fetch_array($execQuery);
                                $currentBid = $row2['currentBidPrice'];
                            }
                           
                             echo "<td>" . $currentBid  . "</td>";
                           if( $_SESSION["user"] == "buyer"){
                            echo "<td>";
                              echo '<a href="items_details.php?item_ID=' . $row['item_ID'] . '&seller_ID=' . $row['seller_ID'] .'" class="btn btn-danger ml-3">Place Bid</a>';
                            echo "</td>";
                           }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close connection
        mysqli_close($link);
        ?>
      </div>
      <div class="col-md-3">
      </div>
    </div>
</body>
</html>
