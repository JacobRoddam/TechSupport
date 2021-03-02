<?php

function add_registration($customerID, $productCode, $registrationDate) {
    global $db;
    $query = 'INSERT INTO registrations
                (customerID, productCode, registrationDate)
              VALUES 
                (:customerID, :productCode, :registrationDate)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->bindValue(':registrationDate', $registrationDate);
    $statement->execute();
    $statement->closeCursor();

}

function get_registered_products_for_customer($customerID) {
    global $db;
    $query = 'SELECT products.productCode, products.name, products.version, products.releaseDate FROM products
              INNER JOIN registrations ON products.productCode = registrations.productCode
              WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}








?>
