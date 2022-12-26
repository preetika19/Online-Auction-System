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
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>

    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
      <a href="welcome.php" class="btn btn-danger ml-3">Home</a>
    </p>
     <p>
     <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
     </p>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Items List</h2>
                        <a href="items_add.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add a New Item</a>
                    </div>
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
                                        echo "<th>Bid</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['item_ID'] . "</td>";
                                        echo "<td>" . $row['itemTitle'] . "</td>";
                                        echo "<td>" . $row['category'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['startingBidPrice'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read_item.php?item_ID='. $row['item_ID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            if($row['seller_ID'] == $_SESSION["id"]){
                                              echo '<a href="update_item.php?item_ID='. $row['item_ID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                              echo '<a href="delete_item.php?item_ID='. $row['item_ID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        }
                                            echo "</td>";
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
            </div>
        </div>
    </div>
</body>
</html>
