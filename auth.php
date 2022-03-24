<?php
session_start();


function ierg4210_DB() {
	$db = new PDO('sqlite:/var/www/cart.db');
	$db->query('PRAGMA foreign_keys = ON;');
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $db;
}

function loginProcess($email, $password){
    $_SESSION['change_success'] = NULL;
    $db = ierg4210_DB();
    $q = $db->prepare('SELECT * FROM account WHERE email = ? ');
    $q->bindParam(1, $email, PDO::PARAM_STR);
    $q->execute(array($email));
    if($r=$q->fetch()){
        //$pwd = $_POST['password'];
        $pwd = $password;
        $saltedPwd = hash_hmac('sha256', $pwd, $r['salt']);
        if($saltedPwd == $r['password']){
            $exp = time() + 3600*24*3;
            $token = array(
                'em' => $r['email'],
                'exp' => $exp,
                'k'=> hash_hmac('sha256', $exp.$r['password'], $r['salt'])
            );

            //create the cookie    
        if($r['admin_flag'] == 1){
        // create the cookie, make it HTTP only
  			setcookie('admin_token', json_encode($token), $exp,'','',true,true);
  		// put it also in the session
  			$_SESSION['admin_token'] = $token;
            $_SESSION['username']=$email;
            $_SESSION['wrong_credential'] = 0;
            return 1;
        }

		else if ($r['admin_flag'] == 2) {
        // create the cookie, make it HTTP only
  			setcookie('user_token', json_encode($token), $exp,'','',true,true);
  		// put it also in the session
  			$_SESSION['user_token'] = $token;
            $_SESSION['username']=$email;
            $_SESSION['wrong_credential'] = 0;
            return 2;
        }

			}
		return false;
		}
	return false;

}

function ierg4210_signup(){

    if (empty($_POST['email']) || empty($_POST['pw'])
    || !preg_match("/^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$/", $_POST['email'])
    || !preg_match("/^[\w@#$%!\^\&\*\-]+$/", $_POST['pw']) ||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    )
    throw new Exception('Wrong Credentials');
    
    $email = htmlspecialchars($_POST['email']);
    $salt = mt_rand();
    $password = hash_hmac('sha256', htmlspecialchars($_POST['pw']), $salt);
    $admin_flag = 2;
    $db = ierg4210_DB();
    $q = $db->prepare("INSERT INTO account (email, salt, password, admin_flag) VALUES (?, ?, ?, ?);");
    $q->bindParam(1, $email);
    $q->bindParam(2, $salt);
    $q->bindParam(3, $password);
    $q->bindParam(4, $admin_flag);
    $q->execute();
    header('Location: login.php', true, 302);
    exit();

}

function ierg4210_login(){
    if (empty($_POST['email']) || empty($_POST['pw'])
    || !preg_match("/^[\w=+\-\/][\w='+\-\/\.]*@[\w\-]+(\.[\w\-]+)*(\.[\w]{2,6})$/", $_POST['email'])
    || !preg_match("/^[\w@#$%!\^\&\*\-]+$/", $_POST['pw']) ||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    )
    throw new Exception('Wrong Credentials');

    // Implement the login logic here
    //get salt from DB
    $login_success=loginProcess(htmlspecialchars($_POST['email']),htmlspecialchars($_POST['pw']));
    if ($login_success == 1){
        // redirect to admin page
        header('Location: ../admin.php', true, 302);
        exit();
    }
        else if ($login_success == 2)
        {
        header('Location: index.php', true, 302);
        exit();
    }
    else{
        $_SESSION['wrong_credential'] = 1;
        header('Location: login.php', true, 302);
        exit();
    }
}

function ierg4210_change_password(){
    if (empty($_POST['old_pw']) || empty($_POST['new_pw']))
    throw new Exception('Wrong Credentials');
    $db = ierg4210_DB();
    $q = $db->prepare('SELECT * FROM account WHERE email = ? ');
    $q->bindParam(1, $_SESSION['username'], PDO::PARAM_STR);
    $q->execute(array($_SESSION['username']));
    //echo $_SESSION['username'];
    $r=$q->fetch();
    //Check whether password correct
    $old_saltedPwd = hash_hmac('sha256', htmlspecialchars($_POST['old_pw']), $r['salt']);
    if($old_saltedPwd == $r['password']){
        $new_saltedPwd = hash_hmac('sha256', htmlspecialchars($_POST['new_pw']), $r['salt']);
        $sql='UPDATE account SET password = ? WHERE email =? ;';
        $q = $db->prepare($sql);
        $q->bindParam(1, $new_saltedPwd, PDO::PARAM_STR) ;
        $q->bindParam(2, $_SESSION['username'], PDO::PARAM_STR);
        $q->execute();
    $_SESSION['wrong_credential'] = 0;
    $_SESSION['change_success'] = 1;
    ierg4210_logout();
    }
    else
    {   $_SESSION['wrong_credential'] = 1; 
        header('Location: ./changepw.php', true, 302);
        exit();
    }

}
function ierg4210_logout(){
    //clear the cookies and session 
    setcookie('admin_token', '', time()-3600);
    unset($_COOKIE['admin_token']);
    $_SESSION['admin_token'] = null;
    $_SESSION['username'] = null;

    setcookie('user_token', '', time()-3600);
    unset($_COOKIE['user_token']);
    $_SESSION['user_token'] = null;

    //redirect to login page after logout
    header('Location: login.php', true, 302);
}

?>