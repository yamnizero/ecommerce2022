<?php

include "../connect.php";

$usersid = filterRequest("id") ;

//page => Order
getAllData('ordersview',"orders_usersid = '$usersid' ");


?>