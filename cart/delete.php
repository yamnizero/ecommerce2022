<?php

include "../connect.php";

$usersid  = filterRequest("usersid") ;
$itemsid  = filterRequest("itemsid") ;


deleteData("cart" ,"cart_id = (SELECT cart_id FROM cart WHERE cart_userid = $usersid AND cart_itemsid = $itemsid LIMIT 1) AND cart_orders = 0");


?> 