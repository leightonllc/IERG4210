<?php
session_start();
    function configDB() {
        $db = new PDO('sqlite:/var/www/cart.db');
        $db->query('PRAGMA foreign_keys = ON;');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    }

    global $db;
    $db = configDB();
    $_GET['pid'] = (int)$_GET['pid'];
    $q = $db->prepare('SELECT pid, name, price FROM products WHERE pid = ?');
    $q->execute(array($_GET['pid']));
    echo json_encode($q->fetchAll());
?>