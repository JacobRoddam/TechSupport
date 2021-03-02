<?php

require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');
require('../model/incident_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'get_customer';
    }
}

switch ($action) {
    case 'get_customer':
        include('get_customer.php');
        break;
    case 'create_incident_form':
        // get email from post, use to get customer, pull out name
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $customer = get_customer_by_email($email);
        $customerName = $customer['firstName'].' '.$customer['lastName'];
        $customerID = $customer['customerID'];

        // init array for registered products and get all products this customer has registered
        $reg_products = array();
        $products = get_registered_products_for_customer($customerID);

        include('create_incident_form.php');
        break;
    case 'create_incident':
        // get neccessary params for creating incident in database
        $customerID = filter_input(INPUT_POST, 'customerID');
        $productCode = filter_input(INPUT_POST, 'productCode');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');



        // add incident to db
        add_incident($customerID, $productCode, $title, $description);

        // show success
        include('display_created_incident.php');
        break;
}


/* replace this with switch 

if ($action == 'get_customer'){
    include('get_customer.php');
} else if ($action == 'create_incident_form') {
    // get email from post, use to get customer, pull out name
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $customer = get_customer_by_email($email);
    $customerName = $customer['firstName'].' '.$customer['lastName'];
    $customerID = $customer['customerID'];

    // init array for registered products and get all products this customer has registered
    $reg_products = array();
    $products = get_registered_products_for_customer($customerID);

    include('create_incident_form.php');
} else if ($action == 'create_incident'){
    // get neccessary params for creating incident in database
    $customerID = filter_input(INPUT_POST, 'customerID');
    $productCode = filter_input(INPUT_POST, 'productCode');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');



    // add incident to db
    add_incident($customerID, $productCode, $title, $description);

    // show success
    include('display_created_incident.php');
}

*/

?>