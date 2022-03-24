<?php

include_once $_SERVER['DOCUMENT_ROOT'] .'/lib/csrf.php';


function ierg4210_DB()
{
    // connect to the database
    // TODO: change the following path if needed
    // Warning: NEVER put your db in a publicly accessible location
    $db = new PDO('sqlite:/var/www/cart.db');

    // enable foreign key support
    $db->query('PRAGMA foreign_keys = ON;');

    // FETCH_ASSOC:
    // Specifies that the fetch method shall return each row as an
    // array indexed by column name as returned in the corresponding
    // result set. If the result set contains multiple columns with
    // the same name, PDO::FETCH_ASSOC returns only a single value
    // per column name.
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $db;
}

function ierg4210_cat_fetchall()
{
    // DB manipulation
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM categories LIMIT 100;");
    if ($q->execute()) return $q->fetchAll();
}

function ierg4210_prod_insert()
{

    global $db;
    $db = ierg4210_DB();

    // TODO: complete the rest of the INSERT command
    if (!preg_match('/^\d*$/', $_POST['catid'])) throw new Exception("invalid-catid");
    $_POST['catid'] = (int)$_POST['catid'];
    if (!preg_match('/^[\w\- ()]+$/', $_POST['name'])) throw new Exception("invalid-name");
    if (!preg_match('/^\d+.?\d{0,}$/', $_POST['price'])) throw new Exception("invalid-price");
    $_POST['price'] = (float)$_POST['price'];
    if (!preg_match('/^\d*$/', $_POST['inventory'])) throw new Exception("invalid-inventory");
    $_POST['inventory'] = (int)$_POST['inventory'];

    $sql = "INSERT INTO products (catid, name, price, description, inventory) VALUES (?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);

    if ($_FILES["file"]["error"] == 0 && $_FILES["file"]["type"] == "image/jpeg" && mime_content_type($_FILES["file"]["tmp_name"]) == "image/jpeg" && $_FILES["file"]["size"] < 10000000)
    {

        $catid = $_POST["catid"];
        $name = htmlspecialchars($_POST["name"]);
        $price = $_POST["price"];
        $desc = htmlspecialchars($_POST["description"]);
        $inv = $_POST["inventory"];
        $filename = $name . ".jpg";
        $sql = "INSERT INTO products (catid, name, price, description, inventory, filename) VALUES (?, ?, ?, ?, ?, ?);";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->bindParam(5, $inv);
        $q->bindParam(6, $filename);
        $q->execute();
        //$lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $name . ".jpg"))
        {
            // redirect back to original page; you may comment it during debug
            header('Location: ../admin.php');
            exit();
        }
    }
    
    if ($_FILES["file"]["error"] == 0 && $_FILES["file"]["type"] == "image/png" && mime_content_type($_FILES["file"]["tmp_name"]) == "image/png" && $_FILES["file"]["size"] < 10000000)
    {

        $catid = $_POST["catid"];
        $name = htmlspecialchars($_POST["name"]);
        $price = $_POST["price"];
        $desc = htmlspecialchars($_POST["description"]);
        $inv = $_POST["inventory"];
        $filename = $name . ".png";
        $sql = "INSERT INTO products (catid, name, price, description, inventory, filename) VALUES (?, ?, ?, ?, ?, ?);";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->bindParam(5, $inv);
        $q->bindParam(6, $filename);
        $q->execute();
        //$lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $name . ".png"))
        {
            // redirect back to original page; you may comment it during debug
            header('Location: ../admin.php');
            exit();
        }
    }
    
    if ($_FILES["file"]["error"] == 0 && $_FILES["file"]["type"] == "image/gif" && mime_content_type($_FILES["file"]["tmp_name"]) == "image/png" && $_FILES["file"]["size"] < 10000000)
    {

        $catid = $_POST["catid"];
        $name = htmlspecialchars($_POST["name"]);
        $price = $_POST["price"];
        $desc = htmlspecialchars($_POST["description"]);
        $inv = $_POST["inventory"];
        $filename = $name . ".gif";
        $sql = "INSERT INTO products (catid, name, price, description, inventory, filename) VALUES (?, ?, ?, ?, ?, ?);";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->bindParam(5, $inv);
        $q->bindParam(6, $filename);
        $q->execute();
        //$lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $name . ".gif"))
        {
            // redirect back to original page; you may comment it during debug
            header('Location: ../admin.php');
            exit();
        }
    }

    // Only an invalid file will result in the execution below
    // To replace the content-type header which was json and output an error message
    header('Content-Type: text/html; charset=utf-8');
    echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
    exit();
}

// TODO: add other functions here to make the whole application complete
function ierg4210_cat_insert()
{
    global $db;
    $db = ierg4210_DB();
    $name = htmlspecialchars($_POST['name']);
    $q = $db->prepare('INSERT INTO categories (name) VALUES (?)');
    $q->bindParam(1, $name, PDO::PARAM_STR);
    $q->execute();
    header('Location: ../admin.php');
    exit();
}

function ierg4210_cat_edit()
{
    global $db;
    $db = ierg4210_DB();
    $catid = $_POST['catid'];
    $name = htmlspecialchars($_POST['name']);
    $q = $db->prepare('UPDATE categories SET name = ? WHERE catid = ?;');
    $q->bindParam(1, $name, PDO::PARAM_STR);
    $q->bindParam(2, $catid, PDO::PARAM_INT);
    $q->execute(array(
        $name,
        $catid
    ));
    header('Location: ../admin.php');
    exit();
}

function ierg4210_cat_delete()
{
    global $db;
    $db = ierg4210_DB();
    $catid = $_POST["catid"];
    $name = htmlspecialchars($_POST["name"]);
    $q = $db->prepare('DELETE FROM categories WHERE catid = $catid');
    $q->bindParam(1, $catid, PDO::PARAM_INT);
    $q->execute(array(
        $catid
    ));
    header('Location: ../admin.php');
    exit();
}

function ierg4210_prod_delete_by_catid()
{
    global $db;
    $db = ierg4210_DB();
    $catid = $_POST["catid"];
    $name = htmlspecialchars($_POST["name"]);
    $q = $db->prepare('DELETE FROM products WHERE catid = $catid');
    $q->bindParam(1, $catid, PDO::PARAM_INT);
    $q->execute(array(
        $catid
    ));
    header('Location: ../admin.php');
    exit();
}

function ierg4210_prod_fetchAll()
{
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM products ;");
    if ($q->execute())
    {
        return $q->fetchAll();
    }
}

function ierg4210_prod_fetchOne($pid){
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM products WHERE pid = ?");
    $q -> bindParam(1, $pid, PDO::PARAM_INT);
    if ($q->execute())
    {
        return $q->fetchAll();
    }
 
}


function ierg4210_cat_fetchOne($catid){
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM categories WHERE catid = ?");
    $q -> bindParam(1, $catid, PDO::PARAM_INT);
    if ($q->execute())
    {
        return $q->fetchAll();
    }
 
}

function ierg4210_prod_edit()
{
    // input validation or sanitization
    // DB manipulation
    global $db;
    $db = ierg4210_DB();

    // TODO: complete the rest of the INSERT command
    if (!preg_match('/^\d*$/', $_POST['catid'])) throw new Exception("invalid-catid");
    $_POST['catid'] = (int)$_POST['catid'];
    if (!preg_match('/^[\w\- ()]+$/', $_POST['name'])) throw new Exception("invalid-name");
    if (!preg_match('/^\d+.?\d{0,}$/', $_POST['price'])) throw new Exception("invalid-price");
    $_POST['price'] = (float)$_POST['price'];
    if (!preg_match('/^\d*$/', $_POST['inventory'])) throw new Exception("invalid-inventory");
    $_POST['inventory'] = (int)$_POST['inventory'];

    $sql = "UPDATE products SET catid= ? , name= ?, price= ?, description = ?, inventory = ? WHERE pid = ?";
    $q = $db->prepare($sql);

    // Copy the uploaded file to a folder which can be publicly accessible at incl/img/[pid].jpg
    if ($_FILES["file"]["error"] == 0 && $_FILES["file"]["type"] == "image/jpeg" && mime_content_type($_FILES["file"]["tmp_name"]) == "image/jpeg" && $_FILES["file"]["size"] < 10000000)
    {

        $pid = $_POST["pid"];
        $catid = $_POST["catid"];
        $name = htmlspecialchars($_POST["name"]);
        $price = $_POST["price"];
        $desc = htmlspecialchars($_POST["description"]);
        $inv = $_POST["inventory"];
        $filename = $name . ".jpg";
        $sql = "UPDATE products SET catid= ? , name= ?, price= ?, description = ?, inventory = ?, filename = ? WHERE pid = ?";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->bindParam(5, $inv);
        $q->bindParam(6, $filename);
        $q->bindParam(7, $pid);
        $q->execute();
        //$lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $name . ".jpg"))
        {
            // redirect back to original page; you may comment it during debug
            header('Location: ../admin.php');
            exit();
        }
    }
    
    if ($_FILES["file"]["error"] == 0 && $_FILES["file"]["type"] == "image/png" && mime_content_type($_FILES["file"]["tmp_name"]) == "image/jpeg" && $_FILES["file"]["size"] < 10000000)
    {

        $pid = $_POST["pid"];
        $catid = $_POST["catid"];
        $name = htmlspecialchars($_POST["name"]);
        $price = $_POST["price"];
        $desc = htmlspecialchars($_POST["description"]);
        $inv = $_POST["inventory"];
        $filename = $name . ".png";
        $sql = "UPDATE products SET catid= ? , name= ?, price= ?, description = ?, inventory = ?, filename = ? WHERE pid = ?";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->bindParam(5, $inv);
        $q->bindParam(6, $filename);
        $q->bindParam(7, $pid);
        $q->execute();
        //$lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $name . ".png"))
        {
            // redirect back to original page; you may comment it during debug
            header('Location: ../admin.php');
            exit();
        }
    }
    
    if ($_FILES["file"]["error"] == 0 && $_FILES["file"]["type"] == "image/gif" && mime_content_type($_FILES["file"]["tmp_name"]) == "image/jpeg" && $_FILES["file"]["size"] < 10000000)
    {

        $pid = $_POST["pid"];
        $catid = $_POST["catid"];
        $name = htmlspecialchars($_POST["name"]);
        $price = $_POST["price"];
        $desc = htmlspecialchars($_POST["description"]);
        $inv = $_POST["inventory"];
        $filename = $name . ".gif";
        $sql = "UPDATE products SET catid= ? , name= ?, price= ?, description = ?, inventory = ?, filename = ? WHERE pid = ?";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->bindParam(5, $inv);
        $q->bindParam(6, $filename);
        $q->bindParam(7, $pid);
        $q->execute();
        //$lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/admin/lib/images/" . $name . ".gif"))
        {
            // redirect back to original page; you may comment it during debug
            header('Location: ../admin.php');
            exit();
        }
    }

    // Only an invalid file will result in the execution below
    // To replace the content-type header which was json and output an error message
    header('Content-Type: text/html; charset=utf-8');
    echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
    exit();
}

function ierg4210_prod_delete()
{
    global $db;
    $db = ierg4210_DB();
    $pid = $_POST["pid"];
    $name = htmlspecialchars($_POST["name"]);
    $q = $db->prepare('DELETE FROM products WHERE pid = $pid');
    $q->bindParam(1, $pid, PDO::PARAM_INT);
    $q->execute(array(
        $pid
    ));
    header('Location: ../admin.php');
    exit();
}