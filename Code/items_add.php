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
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

   <link rel="stylesheet" type="text/css" href="css/style.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <title></title>
   <style>
      body {
        font-family: "Lato", sans-serif;
     }

     .main-head{
        height: 150px;
        background: #FFF;

     }

     .sidenav {
        height: 100%;
        background-color: #38668E;
        overflow-x: hidden;
        padding-top: 20px;
     }


     .main {
        padding: 0px 10px;
     }

     @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
     }

     @media screen and (max-width: 450px) {
        .items-add-form{
          margin-top: 10%;
       }

       .register-form{
          margin-top: 10%;
       }
    }

    @media screen and (min-width: 768px){
     .main{
       margin-left: 40%; 
    }

    .sidenav{
       width: 40%;
       position: fixed;
       z-index: 1;
       top: 0;
       left: 0;
    }

    .items-add-form{
       margin-top: 20%;
    }

    .register-form{
       margin-top: 20%;
    }
 }

 .login-main-text{
  margin-top: 20%;
  padding: 60px;
  color: #fff;
}

.login-main-text h2{
  font-weight: 300;
}

.btn-black{
  background-color: #000 !important;
  color: #fff;
}

.btn-custom{
   background-color: #38668E;
   color: #fff;
}

.btn-admin {
   background-color: #fff ;
   color: #38668E;
}
</style>
</head>
<body>
   <div class="main">
   <div class="row">

      <div class="col-md-6 col-sm-12">
         <div class="items-add-form">
            <h2>ADD ITEM</h2>
            <form action="items_add_submit.php" method="POST">
               <div class="form-group">
                  <label>Item title</label>
                  <input type="text" name = "item-title" class="form-control" placeholder="item name" required = "true">
               </div>
               <br>
               <div class="form-group">
                  <label>Description</label>
                  <textarea rows = "5" name = "description" class="form-control" placeholder="Enter details here..." required = "true"></textarea>
               </div>
               <br>
               <div class="form-group">
                <label>Starting bid price($)</label>
                <input type="text" class="form-control"  placeholder="eg. 1000" maxlength="10" size="10" name="Starting-bid-price" required = "true">
             </div>
             <br>
             <div class="form-group">
                <label>Bid starting date</label>
                <input  type="datetime-local" class="form-control"  name="Bid-starting-date" required = "true">
             </div>
             <br>
             <div class="form-group">
                <label>Bid ending date</label>
                <input  type="datetime-local" class="form-control"  name="Bid-ending-date" required = "true">
             </div>
             <div class="form-group"><br>
                <label>Category</label>
                <input  type="text" class="form-control"  placeholder="category" name="category" required = "true">
             </div>
             <br>
             <div class="form-group">

              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              <a href="welcome.php" class="btn btn-warning ml-3">Cancel</a>

           </form>
        </div>
     </div>
  </div>
</div>

</body>
</html>

