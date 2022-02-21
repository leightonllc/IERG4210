<?php
  if (!defined(DIR))
  {
    define(DIR, dirname(FILE));
  }
  require __DIR__ . '/lib/db.inc.php';
  $res = ierg4210_cat_fetchall();
  $res2 = ierg4210_prod_fetchall();
  $options = '';
  foreach ($res as $value)
  {
    $options .= '<option value="' . $value["CATID"] . '">' . $value["NAME"] . '</option>';
  }
  foreach ($res2 as $value)
  {
    $prodoptions .= '<option value="' . $value["PID"] . '"> ' . $value["NAME"] . ' </option>';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>IERG4210 Phase 2B - Store Admin Panel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    crossorigin="anonymous">
  <link rel="stylesheet" href="./main.css" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

</head>

<body>
  <nav class="fixed-top navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="./index.php">IERG4210 Phase 2B - Store Admin Panel</a>
    </div>
  </nav>

  <div class="album bg-light container-fluid row justify-content-center mt-2">
    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend>New Category</legend>
          <form id="cat_insert" method="POST" action="admin-process.php?action=cat_insert"
            enctype="multipart/form-data">
            <label for="catid"> Category *</label>
            <div> <input class="form-control" id="name" type="text" name="name" required="required" /> </div>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend>Edit Category</legend>
          <form id="cat_edit" method="POST" action="admin-process.php?action=cat_edit" enctype="multipart/form-data">
            <label for="catid"> Select Category *</label>
            <div> <select class="form-select" id="catid" name="name"><?php echo $options; ?></select></div>
            <label class="mt-1" for="catid"> Category *</label>
            <div> <input class="form-control" id="catid" name="catid" content="catid"></input></div>
            <button type="submit" class="btn btn-primary mt-2">Edit</button>
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend class="label-text"> Delete Category</legend>
          <form id="cat_delete" method="POST" action="admin-process.php?action=cat_delete"
            enctype="multipart/form-data">
            <label class="label-text" for="prod_catid"> Select Category *</label>
            <div> <select class="form-select" id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <button type="submit" class="btn btn-primary mt-2">Delete</button>
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend> New Product</legend>
          <form class="dropzone" id="prod_insert" method="POST" action="admin-process.php?action=prod_insert"
            enctype="multipart/form-data">
            <label for="prod_catid"> Category *</label>
            <div> <select class="form-select" id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <label class="mt-1" for="prod_name"> Name *</label>
            <div> <input class="form-control" id="prod_name" type="text" name="name" required="required" /></div>
            <label class="mt-1" for="prod_price"> Price *</label>
            <div> <input class="form-control" id="prod_price" type="text" name="price" required="required"
                pattern="^\d+\.?\d*$" /></div>
            <label class="mt-1" for="prod_desc"> Description *</label>
            <div> <input class="form-control" id="prod_desc" type="text" name="description" /> </div>
            <label class="mt-1" for="prod_inventory"> Inventory *</label>
            <div> <input class="form-control" id="prod_inventory" type="text" name="inventory" /> </div>
            <label class="mt-1" for="prod_image"> Image * </label>
            <div> <input class="mb-2 form-control" type="file" id="prod_image" name="file" required="true"
                onchange="loadFile1(event)" accept="image/jpeg, image/png, image/gif" /> </div>
            <label class="mt-1"> Preview </label>
            <p>
              <div class="image"><img alt="preview" class="thumbnail" id="output1" /></div>
            </p>

            <script>
              var loadFile1 = function (event) {
                var image = document.getElementById('output1');
                image.src = URL.createObjectURL(event.target.files[0]);
              };
            </script>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend> Edit Product</legend>
          <form id="prod_edit" method="POST" action="admin-process.php?action=prod_edit" enctype="multipart/form-data">
            <label for="pid"> Select Product *</label>
            <div> <select class="form-select" id="pid" name="pid"><?php echo $prodoptions; ?></select></div>
            <label class="mt-1" for="prod_catid"> Category *</label>
            <div> <select class="form-select" id="prod_catid" name="catid"><?php echo $options; ?></select></div>
            <label class="mt-1" for="prod_name"> Name *</label>
            <div> <input class="form-control" id="prod_name" type="text" name="name" required="required" /></div>
            <label class="mt-1" for="prod_price"> Price *</label>
            <div> <input class="form-control" id="prod_price" type="text" name="price" required="required"
                pattern="^\d+\.?\d*$" /></div>
            <label class="mt-1" for="prod_desc"> Description *</label>
            <div> <input class="form-control" id="prod_desc" type="text" name="description" /> </div>
            <label class="mt-1" for="prod_inventory"> Inventory *</label>
            <div> <input class="form-control" id="prod_inventory" type="text" name="inventory" /> </div>
            <label class="mt-1" for="prod_image"> Image * </label>
            <div> <input class="mb-2 form-control" type="file" id="prod_image" name="file" required="true"
                onchange="loadFile2(event)" accept="image/jpeg, image/png, image/gif" /> </div>
            <label class="mt-1"> Preview </label>
            <p>
              <div class="image"><img class="thumbnail" id="output2" /></div>
            </p>

            <script>
              var loadFile2 = function (event) {
                var image = document.getElementById('output2');
                image.src = URL.createObjectURL(event.target.files[0]);
              };
            </script>
            <button type="submit" class="btn btn-primary mt-2">Edit</button>
          </form>
        </fieldset>
      </div>
    </div>

    <div class="card mx-4 my-2 col-md-6 col-lg-4 col-xl-3">
      <div class="card-body">
        <fieldset>
          <legend> Delete Product</legend>
          <form id="prod_delete" method="POST" action="admin-process.php?action=prod_delete"
            enctype="multipart/form-data">
            <label for="pid"> Select Product*</label>
            <div> <select class="form-select" id="pid" name="pid"><?php echo $prodoptions; ?></select></div>
            <button type="submit" class="btn btn-primary mt-2">Delete</button>
          </form>
        </fieldset>
      </div>
    </div>
  </div>
</body>

</html>