<?php

function auth_admin(){
    if (!empty($_SESSION['admin_token']))
    return $_SESSION['admin_token']['em'];
    if (!empty($_COOKIE['admin_token'])){
        //stripslashes() Returns a string with blackslashes stripped off.
        //(\' becomes' and so on.)
        if ($t =json_decode(stripslashes($_COOKIE['admin_token']), true)){
            if (time() > $t['exp'])
                return false;
            global $db;
            $db = ierg4210_DB(); 
            $q = $db->prepare('SELECT * FROM account WHERE email = ? ');
            $q ->execute(array($t['email']));
            if ($r=$q->fetch()){
                $realk = hash_hmac('sha1', $t['exp'].$r['password'],$r['salt']);
                if($realk == $t['k']){
                    $_SESSION['admin_token'] = $t;
                    return $t['em'];
                }
            }

        }
    }
    return false;
}
?>