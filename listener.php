<?php
 
// STEP 1: Read POST data
 
// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
file_put_contents('raw.txt', $raw_post_data);
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}
 
 
// STEP 2: Post IPN data back to paypal to validate
 
$ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
 
// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);
 
function configDB() {
    $db = new PDO('sqlite:/var/www/cart.db');
    $db->query('PRAGMA foreign_keys = ON;');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

// STEP 3: Inspect IPN validation result and act accordingly
 
if (0 == 0) {

    
    global $db;
    $db = configDB();
    $q = $db->prepare("SELECT * FROM orders ORDER BY txid DESC LIMIT 1;"); //last tx attempt
    if ($q->execute()) $serverrecord = $q->fetchAll();
    
    $flag = true;

    // check whether the payment_status is Completed

    if ($myPost["payment_status"] != "Completed") {$flag = false;};

    // check that txn_id has not been previously processed

    // check that receiver_email is your Primary PayPal email

    if ($myPost["receiver_email"] != "sb-n0zww15617805@business.example.com") {$flag = false;};

    // check that payment_amount/payment_currency are correct
    if ($myPost["mc_currency"] != "HKD") {$flag = false;};

    if (json_decode($serverrecord[0]["digest"], true)["total"] == $myPost["mc_gross"]) {$flag = false;}; //compare with digest

    // process payment
 
    $sql = "INSERT INTO record (txnid, username, status, digest) VALUES (?, ?, ?, ?);";
        $q = $db->prepare($sql);
        $q->bindParam(1, $myPost["txn_id"]);
        $q->bindParam(2, $serverrecord[0]["username"]);
        $q->bindParam(3, $myPost["payment_status"]);
        $q->bindParam(4, $serverrecord[0]["digest"]);
        $q->execute();

} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
    file_put_contents('log.txt', "invalid");
}
?>