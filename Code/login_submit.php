<?php

require("config.php");
session_start();
if (isset($_POST['email']))
{
  $email = $_POST['email'];
  $email = mysqli_real_escape_string($mysqli, $email);
}
if (isset($_POST['password']))
{
  $password = $_POST['password'];
  $password = mysqli_real_escape_string($mysqli, $password);
}
if (isset($_POST['user']))
{
  $user = $_POST['user'];
  // $user = mysqli_real_escape_string($mysqli, $user);
}

if ($email && $password && ($user == "buyer")) {
  $query = "SELECT * FROM buyer as b, member as m WHERE b.member_ID = m.member_ID and m.email = '$email' and m.password = '$password'";

  $result = mysqli_query($mysqli, $query);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];

  $count = mysqli_num_rows($result);
  // If result matched $myusername and $mypassword, table row must be 1 row

  if($count == 1) {
   // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $row['member_ID'];
    $_SESSION["username"] = $row['name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION["user"] = 'buyer';

    // Redirect user to welcome page
    header("location: welcome.php");
  }

  if ($count == 0) {
    // header("location: login.php");
    echo '<script>
      alert("Error: Incorrect Login information");
      window.location = "login.php";
      </script>';
  }

}

if ($email && $password && ($user == "seller")) {
  $query = "SELECT * FROM seller as s, member as m WHERE s.member_ID = m.member_ID and m.email = '$email' and m.password = '$password'";

  $result = mysqli_query($mysqli, $query);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];

  $count = mysqli_num_rows($result);
  // If result matched $myusername and $mypassword, table row must be 1 row

  if ($count == 0) {
    echo '<script>
      alert("Error: Incorrect Login information");
      window.location = "login.php";
      </script>';
    //header("location: login.php");
  }

  if($count == 1) {
   // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $row['member_ID'];
    $_SESSION["username"] = $row['name'];
    $_SESSION["email"] = $row['email'];
    $_SESSION["user"] = 'seller';

    // Redirect user to welcome page
    header("location: welcome.php");
  }

}


?>
