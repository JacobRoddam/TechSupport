<?php

session_start();
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        if (isset($_SESSION['customer'])){
            $action = 'show_register_form';
        }
        else {
            $action = 'customer_login';
        }
        
    }
}



switch ($action) {
    case 'customer_login':
        include('customer_login.php');
        break;
    case 'show_register_form':
        $products = array();
        if (isset($_SESSION['customer'])){
            $customer = $_SESSION['customer'];
        }
        else {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $customer = get_customer_by_email($email);
            $_SESSION['customer'] = $customer;
        }
        
        //$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        //$customer = get_customer_by_email($email);
        $customerName = $customer['firstName'].' '.$customer['lastName'];
        $products = get_products();


        include('register_product_form.php');
        break;
    case 'register_product':
        //$customerID = filter_input(INPUT_POST, 'customerID');
        $customerID = $_SESSION['customer']['customerID'];
        $productCode = filter_input(INPUT_POST, 'productCode');
        //$productCode = $_SESSION['customer']['productCode'];
        $registrationDate = date('Y-m-d H:i:s');

        add_registration($customerID, $productCode, $registrationDate); // write this function in registration_db.php
        include('display_registered_product.php');
        break;
}

/* replace with switch

if ($action == 'customer_login'){
    include('customer_login.php');
    
} else if ($action == 'show_register_form') {
    $products = array();
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $customer = get_customer_by_email($email);
    $customerName = $customer['firstName'].' '.$customer['lastName'];
    $products = get_products();


    include('register_product_form.php');
} else if ($action == 'register_product') {
    
    $customerID = filter_input(INPUT_POST, 'customerID');
    $productCode = filter_input(INPUT_POST, 'productCode');
    $registrationDate = date('Y-m-d H:i:s');

    add_registration($customerID, $productCode, $registrationDate); // write this function in registration_db.php
    include('display_registered_product.php');

}

*/




?>