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
    <ul class="nav justify-content-end top-bar py-2 px-5">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="logout.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
          </svg>Logout
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
          </svg>Profile
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
          </svg>Favourites
        </a>
      </li>
    </ul>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom p-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Items for sale!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Contact</a>
            </li>
          </ul>
          <form class="row row-cols-md-auto">
            <div class="form-group mb-2 col-12">
              <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-custom mb-2">Search</button>
            </div>
          </form>
        </div>
      </div>
    </nav>

    <!-- Gallery -->
    <div class="container p-4">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col">
          <div class="row" id="photo_gallery">
            <div class="col-md-3">
              <div class="card">
                <img src="images/item1.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Pokemon Stickers</h5>
                  <p class="card-text">2Pcs Vinyl Pokemon Stickers</p>
                  <a href="Items_details.php" class="btn btn-primary ">Place bid</a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <img src="images/item2.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Nintendo Switch Console</h5>
                  <p class="card-text">NEW:Unused, unopened, and undamaged Animal Crossing Edition Nintendo Switch console</p>
                  <a href="Items_details.php" class="btn btn-primary">Place bid</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <img src="images/item3.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">WIDE ANGLE + MACRO LENS</h5>
                  <p class="card-text">OPTICAL DL GLASS</p>
                  <a href="Items_details.php" class="btn btn-primary">Place bid</a>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <img src="images/item4.png" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">2pcs Elevated Cat Bowls</h5>
                  <p class="card-text">2" elevated white pet food and water bowls.</p>
                  <a href="Items_details.php" class="btn btn-primary">Place bid</a>
                </div>
              </div>
            </div>


          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="card">
                <img src="images/item5.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">T.Rex Dinosaur Tooth</h5>
                  <p class="card-text">2" t-rex dinosaur tooth from Late Cretaceous 66 Million Years Ago, Hell Creek Formation, Montana</p>
                  <a href="Items_details.php" class="btn btn-primary">Place bid</a>
                </div>
              </div>
            </div>

             <div class="col-md-3">
              <div class="card">
                <img src="images/item6.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">T.Rex Dinosaur Tooth</h5>
                  <p class="card-text">2" t-rex dinosaur tooth from Late Cretaceous 66 Million Years Ago, Hell Creek Formation, Montana</p>
                  <a href="Items_details.php" class="btn btn-primary">Place bid</a>
                </div>
              </div>
            </div>

             <div class="col-md-3">
              <div class="card">
                <img src="images/item7.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Set of Vintage Wine Glasses</h5>
                  <p class="card-text">Set of 4, Cambridge, circa 1945, Vintage Etched Starburst Water Goblets, Summer Cocktail glasses</p>
                  <a href="Items_details.php" class="btn btn-primary">Place bid</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
  </html>

