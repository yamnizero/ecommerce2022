<?php

include "../connect.php";

$orderid =filterRequest("orderid");


$data = array(
    "order_status" =>  1
);
updateData("orders" ,$data ,"orders_id =$orderid AND order_status = 0 ");


?>