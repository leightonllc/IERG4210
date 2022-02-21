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
      <link rel="stylesheet" href="./product.css">
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
		<div class="container">
			<div class="row d-none d-sm-block">
				<nav class="navbar navbar-light navbar-expand-sm p-3">
					<span class="navbar-brand">You are now at:</span>
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="./index.php">Home</a>
						</li>
						<span class="navbar-text">></span>
						<li class="nav-item">
<?php
require __DIR__.'/admin/lib/db.inc.php';
$product = ierg4210_prod_fetchOne($_GET["pid"]);
$catname = ierg4210_cat_fetchOne($product[0]["CATID"]);
echo	'<a class="nav-link" href="./category.php?catid=' . $product[0]["CATID"] . '">'. $catname[0]["NAME"] .'</a>';
?>
						</li>
						<span class="navbar-text">></span>
						<li class="nav-item">
<?php
						echo	'<a class="nav-link" href="#">'.$product[0]["NAME"].'</a>';
?>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-4 bg-light p-3 rounded">
<?php
			echo		'<h1 class="display-3">'.$product[0]["NAME"].'</h1>';
			echo		'<h1 class="display-6">$'.$product[0]["PRICE"].'</h1>';
			echo		'<p class="lead">'.$product[0]["DESCRIPTION"].'</p>';
			echo		'<button type="button" class="btn btn-sm btn-success">Add to cart</button>';
			echo		'<span class="small p-2">'.$product[0]["INVENTORY"].' item(s) left</span>';
			echo	'</div>
				<div class="col-8">
					<img class="image img-fluid rounded" src="./admin/lib/images/'.$product[0]["FILENAME"].'" alt="Card image cap">
				</div>';
?>
			</div>
		</div>
		<div class="container mt-3">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">More info</button>
				</li>
			</ul>
			<div class="tab-content mt-3" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="description-tab">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="info-tab">
					Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
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