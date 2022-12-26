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

if (isset($_POST['name']))
{
  $name = $_POST['name'];
  $name = mysqli_real_escape_string($mysqli, $name);
}
if (isset($_POST['number']))
{
  $number = $_POST['number'];
  $number = mysqli_real_escape_string($mysqli, $number);
}
if (isset($_POST['address']))
{
  $address = $_POST['address'];
  $address = mysqli_real_escape_string($mysqli, $address);
}

if (isset($_POST['user']))
{
  $user = $_POST['user'];
  // $user = mysqli_real_escape_string($mysqli, $user);
}


$sql = "SELECT max(member_ID) FROM member";
$memberid = mysqli_query($mysqli, $sql) or die($mysqli_error($mysqli));
$row = mysqli_fetch_array($memberid, MYSQLI_NUM);
$memberid = $row[0] + 1;


$query = "INSERT INTO member( member_ID, password, email, name, phoneNumber, homeAddress)VALUES('" . $memberid. "','" . $password . "','" . $email . "','" . $name . "','" . $number . "','" . $address . "');";

  $result = mysqli_query($mysqli, $query);

if($user == "buyer") {
  if (isset($_POST['ship_address']))
  {
    $ship_address = $_POST['ship_address'];
    $ship_address = mysqli_real_escape_string($mysqli, $ship_address);
  }

  if (isset($_POST['ccn']))
  {
    $ccn = $_POST['ccn'];
    $ccn = mysqli_real_escape_string($mysqli, $ccn);
  }
  $buyer = "INSERT INTO buyer( member_ID, shippingAddress, creditCardNum)VALUES('$memberid','$ship_address','$ccn');";
  $result1 = mysqli_query($mysqli, $buyer);
  $_SESSION["user"] = 'buyer';       
}

if($user == "seller") {
  if (isset($_POST['account_number']))
  {
    $account_number = $_POST['account_number'];
    $account_number = mysqli_real_escape_string($mysqli, $account_number);
  }

  if (isset($_POST['routing_number']))
  {
    $routing_number = $_POST['routing_number'];
    $routing_number = mysqli_real_escape_string($mysqli, $routing_number);
  }
  $seller = "INSERT INTO seller( member_ID, bankAccountNum, routingNum)VALUES('" . $memberid. "','" . $account_number . "','" . $routing_number . "');";
     $result2 = mysqli_query($mysqli, $seller);

     $_SESSION["user"] = 'seller';
}


   // Store data in session variables
  $_SESSION["loggedin"] = true;
  $_SESSION["id"] = $memberid;
  $_SESSION['email'] = $email;
  $_SESSION["username"] = $name;                      

    // Redirect user to welcome page
  header("location: welcome.php");

?>