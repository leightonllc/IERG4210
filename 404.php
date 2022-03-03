<?php
   session_start();
   ?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-dark.min.css" media="(prefers-color-scheme: dark)" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" crossorigin="anonymous">
      <link rel="stylesheet" href="./main.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>IERG4210 Phase 2B</title>
   </head>
   <body class="vh-100">
      <nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-primary">
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
                  <li class="nav-item dropdown">
                     <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Categories
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <?php
                         require __DIR__.'/admin/lib/db.inc.php';
                           $res = ierg4210_cat_fetchall();
                           $res2 = ierg4210_prod_fetchall();
                           foreach ($res as $cat){
                           echo '<li>';
                           echo '<a class="dropdown-item" href="category.php?catid=' . $cat["CATID"] . '">' . $cat["NAME"] . '</a>';
                           echo '</li>';
                     
                       }
                       ?>
                     </ul>
                  </li>
                  
                  
                  
                  <li class="nav-item">
                     <a tabindex="0" class="nav-link active d-none d-lg-block" href="#" data-bs-toggle="popover" data-bs-trigger="hover" type="button" data-bs-placement="bottom" data-bs-html="true" data-content-id="shoppingcart">Shopping Cart <i class="bi bi-cart"></i></a>
                     <a tabindex="0" class="nav-link d-lg-none" href="#">Shopping Cart <i class="bi bi-cart"></i></a>
                  </li>
               </ul>
               <form class="d-flex">
                  <input class="form-control me-sm-2 d-none d-lg-block" type="text" placeholder="Search">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
         </div>
      </nav>
      
      
      
      
      
      
      
      <div class="d-flex h-100 row align-items-center justify-content-center">
    <div class="container">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="./index.php" class="btn btn-secondary">Take Me Home</a>
            </div>
    </div>
</div>
      
      
      <div class="d-none" id="shoppingcart">
         <table class="table table-borderless">
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
                  <td>Product 1 Lengthy Tex</td>
                  <td><input type="number" value="1" min="0" max="99"></td>
                  <td>$12.4</td>
               </tr>
               <tr>
                  <th scope="row">2</th>
                  <td>Product 2</td>
                  <td><input type="number" value="1" min="0" max="99"></td>
                  <td>$15.6</td>
               </tr>
               <tr>
                  <th scope="row">3</th>
                  <td>Product 3</td>
                  <td><input type="number" value="1" min="0" max="99"></td>
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
   <footer class="fixed-bottom text-muted bg-light container-fluid">
      <div class="container py-3 d-flex align-items-start">
        <div><p>SID: 1155127347 Name: Lau Long Ching</p></div>
        <div class="ms-auto">
          <a href="#">Back to top</a>
        </div>
        
      </div>
    </footer>
   <script src="./popover.js"></script>  <!--- Bootstrap Popover Function, enabled with JQuery for the on-hover shopping cart window. --->
</html>