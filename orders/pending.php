<?php

include "../connect.php";

$usersid = filterRequest("id") ;

//page => Order
getAllData('orders',"orders_usersid = '$usersid' ");


?>