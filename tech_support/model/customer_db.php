<?php
function get_customers() {
    global $db;
    $query = 'SELECT * FROM customers
              ORDER BY lastName';
    $customers = $db->query($query);
    return $customers;
}
function get_customers_by_last_name($last_name) {
    global $db;
    $query = "SELECT * FROM customers
              WHERE lastName = '$last_name'
              ORDER BY lastName";
    $customers = $db->query($query);
    return $customers;
}
function get_customer($customer_id) {
    global $db;
    $query = "SELECT * FROM customers
              WHERE customerID = '$customer_id'";
    $customer = $db->query($query);
    $customer = $customer->fetch();
    return $customer;
}
function get_customer_by_email($email) {
    global $db;
    $query = "SELECT * FROM customers
              WHERE email = '$email'";
    $customer = $db->query($query);
    $customer = $customer->fetch();
    return $customer;
}
function delete_customer($customer_id) {
    global $db;
    $query = "DELETE FROM customers
              WHERE customerID = '$customer_id'";
    $db->exec($query);
}
function add_customer($first_name, $last_name, 
        $address, $city, $state, $postal_code, $country_code,
        $phone, $email, $password) {
    global $db;
    $query = "INSERT INTO customers
                 (firstName, lastName,
                  address, city, state, postalCode, countryCode,
                  phone, email, password)
              VALUES
                 ('$first_name', '$last_name',
                  '$address', '$city', '$state', '$postal_code', '$country_code',
                  '$phone', '$email', '$password')";
    $db->exec($query);
}
function update_customer($customer_id, $first_name, $last_name,
        $address, $city, $state, $postal_code, $country_code,
        $phone, $email, $password) {
    global $db;
    $query = "UPDATE customers
              SET firstName = '$first_name',
                  lastName = '$last_name',
                  address = '$address',
                  city = '$city',
                  state = '$state',
                  postalCode = '$postal_code',
                  countryCode = '$country_code',
                  phone = '$phone',
                  email = '$email',
                  password = '$password'
              WHERE customerID = '$customer_id'";
    $db->exec($query);
}
?>