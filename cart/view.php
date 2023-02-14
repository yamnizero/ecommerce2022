

<?php

include "../connect.php";

$usersid  = filterRequest("usersid") ;

$data = getAllData("cartview" , "cart_userid = $usersid " , null ,false);

$stmt = $con->prepare("SELECT SUM(itemsprice) as totalprice , SUM(countitems) as totalcount FROM `cartview` 
WHERE cartview.cart_userid = $usersid 
GROUP BY cart_userid");

$stmt->execute();
$datacountprice = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode(array(
    "status" => "success",
    "datacart" => $data ,
    "countprice" => $datacountprice 
))


?> 