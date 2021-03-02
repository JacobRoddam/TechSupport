<?php
function get_countries() {
    global $db;
    $query = 'SELECT * FROM countries
              ORDER BY countryName';
    $statement = $db->prepare($query);
    $statement->execute();
    $countries = $statement->fetchAll();
    $statement->closeCursor();
    return $countries;
}

function get_country($countryCode){
    global $db;
    $query = 'SELECT * FROM countries
              WHERE countryCode = :countryCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':countryCode', $countryCode);
    $statement->execute();
    $country = $statement->fetch();
    $statement->closeCursor();
    return $country;
}

?>