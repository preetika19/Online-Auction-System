<?php
require("config.php");
session_start();
if (isset($_POST['item-title']))
{
  $item_title = $_POST['item-title'];
  $item_title = mysqli_real_escape_string($mysqli, $item_title);
}
if (isset($_POST['description']))
{
  $description = $_POST['description'];
  $description = mysqli_real_escape_string($mysqli, $description);
}
if (isset($_POST['Starting-bid-price']))
{
  $Starting_bid_price = $_POST['Starting-bid-price'];
  $Starting_bid_price = mysqli_real_escape_string($mysqli, $Starting_bid_price);
}
if (isset($_POST['Bid-starting-date']))
{
  $Bid_starting_date = $_POST['Bid-starting-date'];
  $Bid_starting_date = mysqli_real_escape_string($mysqli, $Bid_starting_date);
}
if (isset($_POST['Bid-ending-date']))
{
  $Bid_ending_date = $_POST['Bid-ending-date'];
  $Bid_ending_date = mysqli_real_escape_string($mysqli, $Bid_ending_date);
}
if (isset($_POST['category']))
{
  $category = $_POST['category'];
  $category = mysqli_real_escape_string($mysqli, $category);
}

$query = "SELECT max(item_ID) FROM Items";
$itemid = mysqli_query($mysqli, $query)or die($mysqli_error($mysqli));
$row = mysqli_fetch_array($itemid, MYSQLI_NUM);
$itemid = $row[0] + 1;
$query = "INSERT INTO items( item_ID, seller_ID, startingBidPrice, description, startDate, endDate, category, itemTitle)VALUES('" . $itemid. "','" . $_SESSION['id'] . "','" . $Starting_bid_price . "','" . $description . "','" . $Bid_starting_date . "','" . $Bid_ending_date . "','". $category . "','" . $item_title . "');";
  mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

  header('location: welcome.php');
?>