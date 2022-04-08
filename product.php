<?php
   session_start();
   include_once('./lib/csrf.php');
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
    <div class="container">
         <div class="row">
         <span class="navbar-brand"> Hey there, 
             <?php
               
               if ($_SESSION['username']) {echo htmlspecialchars($_SESSION['username']);} else {echo "Guest";}; 
               
               ?>!
            <nav class="navbar navbar-light p-3 d-flex justify-content-start">
               <div><span class="navbar-brand">You are now at:</span></div>
                     <div><a class="nav-link" href="./index.php">Home</a></div>
                  <div><span class="navbar-text">></span></div>

                  <?php
                  $product = ierg4210_prod_fetchOne($_GET["pid"]);
                  if ($product == null) {
                    header("Location: ./404.php");
                    exit();
                  };
$catname = ierg4210_cat_fetchOne($product[0]["CATID"]);
                   echo                '<div><a class="nav-link active" href="#">'. htmlspecialchars($catname[0]["NAME"]) .'</a></div>';
                   ?>
                  <div><span class="navbar-text">></span></div>

                  <?php
                   echo                '<div><a class="nav-link" href="#">'. htmlspecialchars($product[0]["NAME"]) .'</a></div>';
                   ?>

            </nav>
         </div>
      </div>
		
   
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-5 bg-light p-3 rounded">
<?php
			echo		'<p class="display-3">'. htmlspecialchars($product[0]["NAME"]) .'</p>';
			echo		'<p class="display-6">$'.$product[0]["PRICE"].'</p>';
			echo		'<p class="lead">'. htmlspecialchars($product[0]["DESCRIPTION"]) .'</p>';
			echo		'<button type="button" onclick="addtocart(' . $_GET["pid"] . ');" class="btn btn-sm btn-success">Add to cart</button>';
			echo		'<span class="small p-2">'.$product[0]["INVENTORY"].' item(s) left</span>';
			echo	'</div>
				<div class="col-sm-12 col-lg-7">
					<img class="img-fluid rounded" src="./admin/lib/images/'. htmlspecialchars($product[0]["FILENAME"]) .'" alt="Card image cap">
				</div>';
?>
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
   <script src="./popover.js"></script>  <!--- Bootstrap Popover Function, enabled with JQuery for the on-hover shopping cart window. --->
</html>