<?php

include "../connect.php";

$usersid  = filterRequest("usersid") ;
$itemsid  = filterRequest("itemsid") ;

$count = getData( "cart","cart_itemsid = $itemsid AND cart_userid = $usersid" ,null , false);


    $data = array(
        "cart_userid" => $usersid,
        "cart_itemsid" => $itemsid,
    );
    insertData("cart", $data );


