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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        .login-form{
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

    .login-form{
       margin-top: 80%;
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
  <div class="sidenav">
     <div class="login-main-text">
        <h2>User<br> Log-in Page</h2>
        <p>Don't have an account?</p>
        <div class="form-group">
           <a href="signup.php" class="btn btn-primary">User Sign-up</a>
       </div>
       <br>
       <p>Sign into admin account</p>
       <div class="form-group">
          <a href="main.php" class="btn btn-primary">Admin Login</a>
      </div>
     </div>
   </div>
   <div class="main">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="signup-form">
               <h2>LOG IN</h2>
               <form action="login_submit.php" method="POST">
                  <div class="form-group">
                     <label>Email</label>
                     <input type="email" name = "email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email" required>
                  </div>
                  <br>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name = "password" class="form-control"   placeholder="Password" required = "true" required>
                  </div>
                  <br>
                  <div class="form-group">
                     <label>Buyer/Seller</label>
                     <select class="form-control" id="user" name="user" required>
                        <option value="">Select option</option>
                        <option value="buyer">Buyer</option>
                        <option value="seller">Seller</option>
                     </select>
                  </div>
                  <br>
                  <button type="submit" name="submit" class="btn btn-primary">Login</button>
               </form>
            </div>
         </div>
      </div>
   </div>

</body>
</html>
