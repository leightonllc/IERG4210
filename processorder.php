<?php
   header('Content-Type: application/json');

   session_start();
    function configDB() {
        $db = new PDO('sqlite:/var/www/cart.db');
        $db->query('PRAGMA foreign_keys = ON;');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    }
    $salt =  mt_rand() . mt_rand();
    $digest = $_POST['digest'];
    $hash = hash_hmac('sha256', $digest, $salt);
    $username = $_POST['username'];
    $status = 'Pending';
    
    global $db;
    $db = configDB();
    $sql = "INSERT INTO orders (username, digest, salt, hash, status) VALUES (?, ?, ?, ?, ?);";
    $q = $db->prepare($sql);
    $q->bindParam(1, $username);
    $q->bindParam(2, $digest);
    $q->bindParam(3, $salt);
    $q->bindParam(4, $hash);
    $q->bindParam(5, $status);
    

    echo json_encode($q->execute());

?>