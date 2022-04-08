<?php
   session_start();
   ob_start();
   include_once('./lib/csrf.php');
   ?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta property="og:title" content="IERG4210 Assignment" />
      <meta property="og:image" content="http://3.13.126.10/metaimage.png" />
      <meta property="og:image:type" content="image/png" />
      <meta property="og:url" content="http://3.13.126.10" />
​     <meta property="og:image:width" content="1024"/>
      <meta property="og:image:height" content="512" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-dark.min.css" media="(prefers-color-scheme: dark)" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" crossorigin="anonymous">
      <link rel="stylesheet" href="./main.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="icon" type="image/x-icon" href="favicon.ico">
      <title>IERG4210 Phase 5</title>
   </head>
   <body>
   <nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
         <a class="navbar-brand" href="./index.php">IERG4210 Store</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                     data-bs-toggle="dropdown" aria-expanded="false">
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
                  <a tabindex="0" class="nav-link active d-none d-lg-block" href="#" data-bs-toggle="popover"
                     data-bs-trigger="hover" type="button" data-bs-placement="bottom" data-bs-html="true"
                     data-content-id="shoppingcart">Shopping Cart <i class="bi bi-cart"></i></a>
                  <a tabindex="0" class="nav-link d-lg-none" href="#">Shopping Cart <i class="bi bi-cart"></i></a>
               </li>
               <?php
                  
                  if ($_SESSION['admin_token']||$_SESSION['user_token'])
                  echo '<li class="nav-item">
                     <form action = "../auth-process.php?action=logout" id="logout" method="post">
                        <a type="submit" class = "nav-link active" onclick="document.getElementById(\'logout\').submit()" >Logout</a>
                        <input type="hidden" name="nonce" value="' . csrf_getNonce("logout"). '"/>
                    </form>
                  </li>';
                  else
                  echo '<li class="nav-item">
                     <a href="../login.php" class = "nav-link active">Login</a>
                  </li><li class="nav-item"><a href="../changepw.php" class = "nav-link active">Change Password</a></li>';
                  
                  
                  ?>
                  <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./recentorders.php">Recent Orders</a>
            </li>
            </ul>
            
         </div>
      </div>
   </nav>
      <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
         <div class="col-md-6 p-lg-6 mx-auto my-5">
            <p class="display-4">IERG4210 Store Sale</p>
            <p class="lead">Welcome to IERG4210 Store! You can find all sorts of newest gadgets, including phones and tablets here. Feel free to navigate!</p>
         </div>
         <div class="product-device box-shadow d-none d-md-block"></div>
         <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
      </div>
      <div class="container">
         <div class="row">
             <span class="navbar-brand"> Hey there, 
             <?php
               
               if ($_SESSION['username']) {echo htmlspecialchars($_SESSION['username']);} else {echo "Guest";}; 
               
               ?>!
             </span>
            <nav class="navbar navbar-light p-3 d-flex justify-content-start">
               <div><span class="navbar-brand">You are now at:</span></div>
                     <div><a class="nav-link" href="./index.php">Home</a></div>
            </nav>
         </div>
      </div>
      <!-- I did not use the standard bootstrap breadcrumb here as it does not look good.-->
      <div class="container mb-5">
         <div class="row">
            <div class="d-none d-md-block col-md-2 navbar navbar-light">
               <ul class="navbar-nav flex-column">
                 <li class="nav-item mb-2">
                   <a class="navbar-brand">Categories:</a>
                 </li>
                  <?php
                     foreach ($res as $cat){
                     echo '<li class="nav-item">';
                     echo '<a class="nav-link active" href="category.php?catid=' . $cat["CATID"] . '">' . htmlspecialchars($cat["NAME"]) . '</a>';
                     echo '</li>';
                     
                     }
                     ?>
               </ul>
            </div>
            <div class="col-md-10">
               <div class="album py-3">
                  <div class="container">
                     <div class="row">
                        <?php
                           if ($_GET["page"] == null) {$page = 1;} else {$page = $_GET["page"];};
                           if ((int)$page > sizeof(array_chunk($res2, 12))) {
                            header("Location: ./404.php");
                            exit();               
                           };
                           foreach (array_chunk($res2, 12)[$page - 1] as $prod){
                                 echo '<div class="col-md-6 col-lg-4 col-xl-3 row-eq-height">';
                           	echo '<div class="card mb-4 box-shadow">';
                           	echo '<a href="product.php?pid='.$prod["PID"].' " >';
                           echo '<div class="image"><img id="thumbnail" class="card-img-top" src="../admin/lib/images/' . htmlspecialchars($prod["FILENAME"]) . '"></div>';
                           echo '</a>';
                           echo '<div class="card-body d-flex align-items-end flex-column">';
                           echo '<a class="card-text me-auto" href="product.php?pid='.$prod["PID"].' " >$' . $prod["PRICE"] .' '. htmlspecialchars($prod["NAME"]) . '</a>';
                           echo '<div class="btn-group mt-auto me-auto py-2">';
                           echo '<a class="btn btn-sm btn-secondary" href="product.php?pid='.$prod["PID"].' " >View</a>';
                           echo '<button type="button" onclick="addtocart(' . $prod["PID"] . ');" class="btn btn-sm btn-secondary">Add to cart</button>';
                           echo '</div>';
                           echo '</div></div></div>';
                           }
                           ?>
                     </div>
                     
                     <nav class="mt-3 d-flex justify-content-center" aria-label="Page navigation example">
  <ul class="pagination">
                     <?php
    echo '<li class="page-item"><a class="page-link" href="index.php?page=';
    if ($page > 1) {echo $page - 1;} else {echo $page;};
    echo '">Previous</a></li>';
                                    
                  for ($x = 1; $x <= sizeof(array_chunk($res2, 12)); $x++) {
                  
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $x . '">' . $x . '</a></li>';
                  
                  }
                  
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=';
    if ($page < sizeof(array_chunk($res2, 12))) {echo $page + 1;} else {echo $page;};
    echo '">Next</a></li>';
                  
    

?>

  </ul>
</nav>



                  </div>
                  
               </div>
            </div>
         </div>
      </div>
      
      <div class="d-none" id="shoppingcart">
      <?php include 'shoppinglist.php';?>
      </div>
   </body>
   <footer class="static-bottom mt-5 text-muted bg-light container-fluid">
      <div class="container py-3 d-flex align-items-start">
        <div><p>SID: 1155127347 Name: Lau Long Ching</p></div>
        <div class="ms-auto">
          <a href="#">Back to top</a>
        </div>
        
      </div>
    </footer>
   <script src="./popover.js" defer></script>  <!--- Bootstrap Popover Function, enabled with JQuery for the on-hover shopping cart window. --->
</html>