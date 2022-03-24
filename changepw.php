<?php
session_start();
if (!$_SESSION['user_token']&&!$_SESSION['admin_token']){
    header('Location: ./index.php');
    exit();
}
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
    <script src="client-validation.js"></script>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/material-outlined/24/000000/pixel-cat.png">
    <title>IERG4210 Store Login</title>
</head>

<body class="bg-light">

    <section class="vh-100 gradient-custom">

        <nav class="fixed-top navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">IERG4210 Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                           echo '<a class="dropdown-item" href="category.php?catid=' . $cat["CATID"] . '">' . htmlspecialchars($cat["NAME"]) . '</a>';
                           echo '</li>';
                     
                       }
                       ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a tabindex="0" class="nav-link active d-none d-md-block" href="#" data-bs-toggle="popover"
                                data-bs-trigger="hover" type="button" data-bs-placement="bottom" data-bs-html="true"
                                data-content-id="shoppingcart">Shopping Cart <i class="bi bi-cart"></i></a>
                            <a tabindex="0" class="nav-link d-md-none" href="#">Shopping Cart <i
                                    class="bi bi-cart"></i></a>
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
                        <input class="form-control me-sm-2 d-none d-md-block" type="text" placeholder="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>


        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <form class="needs-validation" action="auth-process.php?action=change_password"
                                method="post">

                                <legend> Change Password</legend>
                                <p class="5">Please enter your login, old and new password!</p>
                                <?php
                                      if ($_SESSION['wrong_credential'] == 1)
                                      echo '<div class="alert alert-dismissible alert-secondary fade show">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  Wrong credentials. Please check again.
</div>';
                                    ?>
                                <label for="current-password">Current Password</label>
                                <input type="password" autocomplete="current-password" id="current-password"
                                    name="old_pw" class="form-control form-control-lg my-3" required="required" />
                                <label for="new-password">New Password</label>
                                <input type="password" autocomplete="new-password" id="new-password" name="new_pw"
                                    class="form-control form-control-lg my-3" required="required" />

                                <button class="btn btn-primary mt-2" type="submit">Change</button>
                                <input type="hidden" name="nonce"
                                    value="<?php echo csrf_getNonce('change_password'); ?>" />
                            </form>

                            <div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

</html>