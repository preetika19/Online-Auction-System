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
        <h2 style="text-align:left">Purchase History</h2>
        <?php
        $con = mysqli_connect('localhost','root','root','db');
          if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
          }
          $id = $_SESSION['id'];
          $sql="SELECT * FROM bids,items where bids.buyer_ID =" . $_SESSION['id'] . " and items.item_ID = bids.item_ID";
          $result = mysqli_query($con, $sql);
          echo "<table>
                  <tr>
                    <th>item_ID</th>
                    <th>Buyer_ID</th>
                    <th>description</th>
                    <th>startDate</th>
                    <th>endDate</th>
                    <th>category</th>
                    <th>itemTitle</th>
                  </tr>";
          while($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row['item_ID'] . "</td>";
          echo "<td>" . $row['buyer_ID'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          echo "<td>" . $row['startDate'] . "</td>";
          echo "<td>" . $row['endDate'] . "</td>";
          echo "<td>" . $row['category'] . "</td>";
          echo "<td>" . $row['itemTitle'] . "</td>";
          echo "</tr>";
          }
          echo "</table>";
        ?>
      </div>
      <div class="col-md-3">
      </div>
    </div>
</body>
</html>
