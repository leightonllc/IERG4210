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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-dark.min.css"
      media="(prefers-color-scheme: dark)" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
      crossorigin="anonymous">
   <link rel="stylesheet" href="./main.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script
      src="https://www.paypal.com/sdk/js?client-id=AVZzKWqqyRVS4XvSGl0rhymSc0JK6Yf5GCB1w5Mw3otffDxntYa1PhHFO2LBDMmUHqqDXyRjdBGb11U9&currency=HKD">
   </script>
   <script src="https://cdn.jsdelivr.net/gh/jitbit/HtmlSanitizer@master/HtmlSanitizer.js"></script>
   <link rel="icon" type="image/x-icon" href="favicon.ico">
   <title>IERG4210 Phase 5</title>
</head>


<body>
<?php
if ($_SESSION['username']) {echo '<script>var username="' . $_SESSION['username'] . '"</script>';} else {echo '<script>var username="guest"</script>';};
?>

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
      <table class="table table-borderless">
         <thead>
            <tr>
               <th scope="col">Product</th>
               <th scope="col">Amount</th>
               <th scope="col">Total</th>
            </tr>
         </thead>
         <tbody id="checkouttable"></tbody>
         <tfoot id="checkouttablefoot"></tfoot>
      </table>

      <script>
         function productinfo(pid) {
            var xhttp;
            var rtn = "";
            xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
               if (this.readyState == 4 && this.status == 200) {
                  parseJSON(xhttp);
               }
            }
            xhttp.open("GET", "../lib/cartinfo.php?pid=" + pid, false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
         }

         var total = 0;
         var paypaltable = [];

         function parseJSON(xhttp) {
            var txt = xhttp.responseText;
            var info = JSON.parse(txt.slice(1, txt.length - 1));
            var tablehtml = document.getElementById('checkouttable').innerHTML;
            total += info.PRICE * localStorage.getItem(info.PID);
            tablehtml += '<tr><td>' + HtmlSanitizer.SanitizeHtml(info.NAME) +
               '</td><td>' + localStorage.getItem(info.PID) + '</td><td>$' +
               info.PRICE * localStorage.getItem(info.PID) + '</td></tr>';
            document.getElementById('checkouttable').innerHTML = tablehtml;
            paypaltable.push({
               name: info.NAME,
               description: info.DESCRIPTION.substring(0, 126),
               unit_amount: {
                  currency_code: "HKD",
                  value: info.PRICE
               },
               quantity: localStorage.getItem(info.PID)
            });

         }

         function refreshtable() {
            document.getElementById('checkouttable').innerHTML = "";
            var key = "";
            var i = 0;
            total = 0;
            for (i = 0; i <= localStorage.length - 1; i++) {
               key = localStorage.key(i);
               if (localStorage.getItem(key) > 0) {
                  productinfo(key);
               }
            }
            document.getElementById('checkouttablefoot').innerHTML = "Total: " + total;
         }

         refreshtable();
      </script>





      <div id="paypal-button-container"></div>
      <script>
         var digest = JSON.stringify({
            currency: "HKD",
            receiver: "sb-n0zww15617805@business.example.com",
            items: paypaltable,
            total: total,
         });
         console.log(digest);
         paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {

               jQuery.ajax({
                  type: "POST",
                  url: 'processorder.php',
                  dataType: 'text',
                  data: {
                     digest: digest,
                     username: username,
                  },

                  success: function (response) {
                     console.log(response);
                  }
               });
               
               localStorage.clear();


               return actions.order.create({
                  purchase_units: [{
                     amount: {
                        currency_code: "HKD",
                        value: total,
                        breakdown: {
                           item_total: {
                              /* Required when including the `items` array */
                              currency_code: "HKD",
                              value: total,
                           }
                        }
                     },
                     items: paypaltable,
                  }]
               });
            },

            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
               return actions.order.capture().then(function (orderData) {
                  // Successful capture! For dev/demo purposes:
                  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                  ordergehdata = orderData;
                  const transaction = orderData.purchase_units[0].payments.captures[0];
                  actions.redirect('https://secure.s31.ierg4210.ie.cuhk.edu.hk/recentorders.php');
               });
            }
         }).render('#paypal-button-container');
      </script>







   </div>

   <div class="d-none" id="shoppingcart">
      <?php include 'shoppinglist.php';?>
   </div>
</body>
<footer class="fixed-bottom text-muted bg-light container-fluid">
   <div class="container py-3 d-flex align-items-start">
      <div>
         <p>SID: 1155127347 Name: Lau Long Ching</p>
      </div>
      <div class="ms-auto">
         <a href="#">Back to top</a>
      </div>

   </div>
</footer>
<script src="./popover.js"></script>
<!--- Bootstrap Popover Function, enabled with JQuery for the on-hover shopping cart window. --->



</html>