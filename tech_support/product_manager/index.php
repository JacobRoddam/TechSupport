<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    // Get product data
    $products = get_products();
    

    // Display the product list
    include('product_list.php');
} else if ($action == 'delete_product') {
    $product_code = filter_input(INPUT_POST, 'product_code');
    delete_product($product_code);
    header("Location: .");
} else if ($action == 'show_add_form') {
    include('product_add.php');
} else if ($action == 'add_product') {
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
    $release_date_string = filter_input(INPUT_POST, 'release_date');

    // Validate the inputs
    if ( $code === NULL || $name === FALSE || 
            $version === NULL || $version === FALSE || 
            $release_date_string === NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        $ts = strtotime($release_date_string);
        $release_date_object = new DateTime();
        $release_date_object->setTimestamp($ts);
        $release_date = $release_date_object->format('Y-m-d');
        add_product($code, $name, $version, $release_date);
        header("Location: .");
    }
}
?>