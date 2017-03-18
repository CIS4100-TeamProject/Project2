<?php

function get_registered_products($customerID) {
    global $db;
    $query = 'SELECT * FROM registrations
              WHERE customerID = $customerID';
    $registered_products = $db->query($query);
    return $registered_products;
}
?>