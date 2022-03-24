<?php
session_start();
include_once('./lib/auth.php');
include_once('./lib/csrf.php');

if (!auth_admin()){
    header('Location: ./login.php');
    exit();
}



 if( !defined( DIR ) ) define( DIR, dirname(FILE) );
require __DIR__.'/admin/lib/db.inc.php';
$res = ierg4210_cat_fetchall();
$res2 = ierg4210_prod_fetchall();
$options = '';
$prodoptions = '';

foreach ($res as $value){
    $options .= '<option value="'. $value["CATID"] .'">' . $value["NAME"] . '</option>';
}
foreach ($res2 as $value){
    $prodoptions .= '<option value="'.$value["PID"].'"> '.$value["NAME"].' </option>';
}
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
  <link rel="icon" type="image/x-icon" href="https://img.icons8.com/material-outlined/24/000000/pixel-cat.png">
  <script src="../client-validation.js"></script>
  <title>IERG4210 Store Admin Panel</title>
</head>

<body>

  <nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">IERG4210 Store Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Back to Store</a>
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
                  </li>';
                  
                  
                  ?>
        </ul>
        <form class="d-flex">
          <input class="form-control me-sm-2 d-none d-lg-block" type="text" placeholder="Search">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
  </nav>

  <div class="album container-fluid row justify-content-center mt-2 py-5">
    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend>New Category</legend>
          <form class="needs-validation" id="cat_insert" method="POST"
            action="admin/admin-process.php?action=cat_insert" enctype="multipart/form-data">
            <label for="catid"> Category *</label>
            <div> <input class="form-control" id="name" type="text" name="name" required="required"
                pattern="^[\w\- ()]+$" /> </div>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('cat_insert'); ?>" />
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend>Edit Category</legend>
          <form class="needs-validation" id="cat_edit" method="POST" action="admin/admin-process.php?action=cat_edit"
            enctype="multipart/form-data">
            <label for="catid"> Select Category *</label>
            <div> <select class="form-select" id="catid" name="catid"><?php echo $options; ?></select></div>
            <label class="mt-1" for="name"> Category *</label>
            <div> <input class="form-control" id="name" name="name" type="text" required="required"
                pattern="^[\w\- ()]+$" /></div>
            <button type="submit" class="btn btn-primary mt-2">Edit</button>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('cat_edit'); ?>" />
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend class="label-text"> Delete Category</legend>
          <form class="needs-validation" id="cat_delete" method="POST"
            action="admin/admin-process.php?action=cat_delete" enctype="multipart/form-data">
            <label class="label-text" for="prod_catid"> Select Category *</label>
            <div> <select class="form-select" id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <button type="submit" class="btn btn-primary mt-2">Delete</button>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('cat_delete'); ?>" />
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend> New Product</legend>
          <form class="needs-validation" id="prod_insert" method="POST"
            action="admin/admin-process.php?action=prod_insert" enctype="multipart/form-data">
            <label for="prod_catid"> Category *</label>
            <div> <select class="form-select" id="prod_catid" name="catid"
                pattern="^\d*$"><?php echo $options; ?></select></div>
            <label class="mt-1" for="prod_name"> Name *</label>
            <div> <input class="form-control" id="prod_name" type="text" name="name" required="required"
                pattern="^[\w\- ()]+$" /></div>
            <label class="mt-1" for="prod_price"> Price *</label>
            <div> <input class="form-control" id="prod_price" type="text" name="price" required="required"
                pattern="^\d+.?\d{0,}$" /></div>
            <label class="mt-1" for="prod_desc"> Description *</label>
            <div> <input class="form-control" id="prod_desc" type="text" name="description" required="required" />
            </div>
            <label class="mt-1" for="prod_inventory"> Inventory *</label>
            <div> <input class="form-control" id="prod_inventory" type="text" name="inventory" required="required"
                pattern"^\d*$" /> </div>
            <label class="mt-1" for="prod_image"> Image * </label>
            <div> <input class="mb-2 form-control" type="file" id="prod_image" name="file" required="required"
                onchange="loadFile1(event)" accept="image/jpeg, image/png, image/gif" /> </div>
            <label class="mt-1"> Preview </label>
            <div><img class="img-thumbnail" id="output1" /></div>

            <script>
              var loadFile1 = function (event) {
                var image = document.getElementById('output1');
                image.src = URL.createObjectURL(event.target.files[0]);
              };
            </script>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('prod_insert'); ?>" />
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend> Edit Product</legend>
          <form class="needs-validation" id="prod_edit" method="POST" action="admin/admin-process.php?action=prod_edit"
            enctype="multipart/form-data">
            <label for="pid"> Select Product *</label>
            <div> <select class="form-select" id="pid" name="pid"><?php echo $prodoptions; ?></select></div>
            <label class="mt-1" for="prod_catid"> Category *</label>
            <div> <select class="form-select" id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <label class="mt-1" for="prod_name"> Name *</label>
            <div> <input class="form-control" id="prod_name" type="text" name="name" required="required"
                pattern="^[\w\- ()]+$" /></div>
            <label class="mt-1" for="prod_price"> Price *</label>
            <div> <input class="form-control" id="prod_price" type="text" name="price" required="required"
                pattern="^\d+.?\d{0,}$" /></div>
            <label class="mt-1" for="prod_desc"> Description *</label>
            <div> <input class="form-control" id="prod_desc" type="text" name="description" required="required" />
            </div>
            <label class="mt-1" for="prod_inventory"> Inventory *</label>
            <div> <input class="form-control" id="prod_inventory" type="text" name="inventory" required="required"
                pattern="^\d*$" /> </div>
            <label class="mt-1" for="prod_image"> Image * </label>
            <div> <input class="mb-2 form-control" type="file" id="prod_image" name="file" required="required"
                onchange="loadFile2(event)" accept="image/jpeg, image/png, image/gif" /> </div>
            <label class="mt-1"> Preview </label>
            <div><img class="img-thumbnail" id="output2" /></div>

            <script>
              var loadFile2 = function (event) {
                var image = document.getElementById('output2');
                image.src = URL.createObjectURL(event.target.files[0]);
              };
            </script>
            <button type="submit" class="btn btn-primary mt-2">Edit</button>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('prod_edit'); ?>" />
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend> Delete Product</legend>
          <form class="needs-validation" id="prod_delete" method="POST"
            action="admin/admin-process.php?action=prod_delete" enctype="multipart/form-data">
            <label for="pid"> Select Product*</label>
            <div> <select class="form-select" id="pid" name="pid"><?php echo $prodoptions; ?></select></div>
            <button type="submit" class="btn btn-primary mt-2">Delete</button>
            <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('prod_delete'); ?>" />
          </form>
        </fieldset>
      </div>
    </div>
  </div>
</body>
<footer class="static-bottom mt-5 text-muted bg-light container-fluid">
  <div class="container py-3 d-flex align-items-start">
    <div>
      <p>SID: 1155127347 Name: Lau Long Ching</p>
    </div>
    <div class="ms-auto">
      <a href="#">Back to top</a>
    </div>

  </div>
</footer>

</html>