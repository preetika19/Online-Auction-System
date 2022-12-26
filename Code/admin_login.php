<?php

require("config.php");
session_start();
if (isset($_POST['admin_email']))
{
  $admin_email = $_POST['admin_email'];
  $admin_email = mysqli_real_escape_string($mysqli, $admin_email);
}
if (isset($_POST['admin_password']))
{
  $admin_password = $_POST['admin_password'];
  $admin_password = mysqli_real_escape_string($mysqli, $admin_password);
}

if ($admin_email && $admin_password) {
  $query = "SELECT * FROM administrator as a, member as m WHERE a.member_ID = m.member_ID and m.email = '$admin_email' and m.password = '$admin_password'";

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
     $_SESSION["user"] = 'admin';                      

    // Redirect user to welcome page
    header("location: welcome_admin.php");
  }
  else {
   // header("location: main.php");
   echo '<script>
      alert("Error: Incorrect Login information");
      window.location = "main.php";
      </script>';
 }

}
else {
 // header("location: main.php");
 echo '<script>
      alert("Error: Incorrect Login information");
      window.location = "main.php";
      </script>';
}


?>