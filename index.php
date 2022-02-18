<?php
   session_start();
   ?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./bootstrap.min.css" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" crossorigin="anonymous">
      <link rel="stylesheet" href="./main.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>IERG4210 Phase 2B</title>
   </head>
   <body>
      <nav class="fixed-top navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">IERG4210 Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Dropdown
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                           <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a tabindex="0" class="nav-link d-none d-lg-block" href="#" data-bs-toggle="popover" data-bs-trigger="hover" type="button" data-bs-placement="bottom" data-bs-html="true" data-content-id="shoppingcart">Shopping Cart <i class="bi bi-cart"></i></a>
                     <a tabindex="0" class="nav-link d-lg-none" href="#">Shopping Cart <i class="bi bi-cart"></i></a>
                  </li>
               </ul>
               <form class="form-inline d-lg-none">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
               </form>
            </div>
            <form class="form-inline d-none d-lg-block">
               <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
         </div>
      </nav>
      <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
         <div class="col-md-6 p-lg-6 mx-auto my-5">
            <h1 class="display-4">XXXStore CNY Sale!</h1>
            <p class="lead">Sed tempor libero vitae placerat interdum. Donec faucibus, est id tincidunt egestas, urna nisl semper dui, ut tincidunt risus enim sit amet dolor. Nullam accumsan a ex non convallis. Vestibulum tempus luctus lacus eget vestibulum. Proin dapibus sapien et semper varius. Donec tristique eleifend quam, in pulvinar diam mattis sed. Aenean porta iaculis augue, eu venenatis sem tincidunt eu.</p>
            <a class="btn btn-outline-secondary" href="#">Get one</a>
         </div>
         <div class="product-device box-shadow d-none d-md-block"></div>
         <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
      </div>
      <div class="container">
         <div class="row d-none d-sm-block">
            <nav class="navbar navbar-light navbar-expand-sm p-3">
               <span class="navbar-brand">You are now at:</span>
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="./index.php">Home</a>
                  </li>
               </ul>
            </nav>
         </div>
      </div>
      <!-- I did not use the standard bootstrap breadcrumb here as it does not look good.-->
      <div class="container">
         <div class="row">
            <div class="d-none d-lg-block col-lg-2">
               <ul class="nav flex-column">
                  <?php
                     require __DIR__.'/admin/lib/db.inc.php';
                                 $res = ierg4210_cat_fetchall();
                                 $res2 = ierg4210_prod_fetchall();
                     foreach ($res as $cat){
                     echo '<li class="nav-item">';
                     echo '<a class="nav-link" href="category.php?catid=' . $cat["CATID"] . '">' . $cat["NAME"] . '</a>';
                     echo '</li>';
                     
                     }
                     ?>
               </ul>
            </div>
            <div class="col-lg-10">
               <div class="album py-5 bg-light">
                  <div class="container">
                     <div class="row">
                        <?php
                           foreach ($res2 as $prod){
                                 echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                           	echo '<div class="card mb-4 box-shadow">';
                           	echo '<a href="product.php?pid='.$prod["PID"].' " >';
                           echo '<img class="card-img-top" src="../admin/lib/images/' . $prod["PID"] . '.jpg">';
                           echo '</a>';
                           echo '<div class="card-body">';
                           echo '<a class="card-text" href="product.php?pid='.$prod["PID"].' " >$' . $prod["PRICE"] .' '.$prod["NAME"] . '</a>';
                           echo '<div class="btn-group">';
                           echo '<a class="btn btn-sm btn-outline-secondary" href="product.php?pid='.$prod["PID"].' " >View</a>';
                           echo '<button type="button" class="btn btn-sm btn-outline-secondary">Add to cart</button>';
                           echo '</div>';
                           echo '</div></div></div>';
                           }
                           ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="d-none" id="shoppingcart">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Total</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <th scope="row">1</th>
                  <td>Product 1</td>
                  <td><input type="number" value="1"></td>
                  <td>$12.4</td>
               </tr>
               <tr>
                  <th scope="row">2</th>
                  <td>Product 2</td>
                  <td><input type="number" value="1"></td>
                  <td>$15.6</td>
               </tr>
               <tr>
                  <th scope="row">3</th>
                  <td>Product 3</td>
                  <td><input type="number" value="1"></td>
                  <td>$17.4</td>
               </tr>
            </tbody>
            <tfoot>
               <tr>
                  <th scope="row"></th>
                  <td><button type="button" class="btn btn-success btn-sm">Checkout</button></td>
                  <td></td>
                  <td>$45.4</td>
               </tr>
            </tfoot>
         </table>
      </div>
   </body>
   <script src="./popover.js"></script>  <!--- Bootstrap Popover Function, enabled with JQuery for the on-hover shopping cart window. --->
</html>