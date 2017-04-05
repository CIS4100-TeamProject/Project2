<?php
require("../model/database.php");
require("../model/customer_db.php");
require("../model/product_db.php");
require("../model/registrations_db.php");
session_start();
if (isSet($_POST['action'])) {
    $action = $_POST['action'];
}
else if (isSet($_GET['action'])) {
    $action = $_GET['action'];
}
else if(isSet($_SESSION['email'])) {
    $action = 'get_customer';
}
else {
    $action = 'login';
}
switch($action) {
    case 'login':
        include('login.php');
        break;
    case 'get_customer':
        if(!isSet($_SESSION['email'])) {
            $_SESSION['email'] = $_POST['email'];
        }
        $customer = get_customer_by_email($_SESSION['email']);
        $products = get_products();
        include('register_product.php');
        break;
    case 'register_product':
        if(!isSet($_SESSION['customerID'])) {
            $_SESSION['customerID'] = $_POST['customerID'];
        }
		//$customer_id = $_POST['customer_id'];
        $product_code = $_POST['productCode'];
        $date = date('Y-m-d');
        add_registration($_SESSION['customerID'], $product_code, $date);
        include('registration_confirmation.php');
        break;
	case 'logout':
        // End session
        $_SESSION = array();
        session_destroy();
        
        // Delete cookie from browser
        $name = session_name();
        $expire = strtotime('-1 year');
        $params = session_get_cookie_params();
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        
        // Reset email and password and return to main menu
        $email = '';
        $password  = '';
		include('../view/header.php');
        break;
}
?>