<?php
session_start();
if ($_SESSION['user_token']||$_SESSION['admin_token']){
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
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-primary text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <form class="mb-md-5 mt-md-4 pb-5 needs-validation" action="auth-process.php?action=login"
                                method="post">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white mb-5">Please enter your login and password!</p>
                                <?php
                                      if ($_SESSION['wrong_credential'] == 1)
                                      echo '<div class="alert alert-dismissible alert-secondary fade show">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  Wrong credentials. Please check again.
</div>';
                                    ?>
                                <?php
                                      if ($_SESSION['change_success'] == 1)
                                      echo '<div class="alert alert-dismissible alert-info fade show">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  Password changed successfully. Please login again with the new password.
</div>';
                                    ?>
                                <input type="email" id="email" name="email" class="form-control form-control-lg my-3"
                                    required="required" />

                                <input type="password" autocomplete="current-password" id="current-password" name="pw"
                                    class="form-control form-control-lg my-3" required="required" />

                                <p class="small mb-5 pb-lg-2"><a class="text-white" href="#!">Forgot password?</a>
                                </p>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                <input type="hidden" name="nonce" value="<?php echo csrf_getNonce('login'); ?>" />
                            </form>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="../signup.php"
                                        class="text-white-50 fw-bold">Sign
                                        Up</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

</html>