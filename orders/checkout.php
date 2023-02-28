<?php 

include "../connect.php";

$usersid = filterRequest("usersid") ;
$addressid = filterRequest("addressid") ;
$orderstype = filterRequest("orderstype") ;
$pricedelivery = filterRequest("pricedelivery") ;
$ordersprice = filterRequest("ordersprice") ;
$couponid = filterRequest("couponid") ;
$paymentmethod = filterRequest("paymentmethod") ;
$couponDiscount = filterRequest("couponDiscount") ;


if($orderstype == "receive"){
    $pricedelivery = 0;
}
$totalPrice = $ordersprice + $pricedelivery ;


///chek Coupone

$now = date("Y-m-d H:i:s");

$checkCoupon = getData("coupon" , "coupon_id = '$couponid' AND coupon_expiredate > '$now' AND coupon_count > 0" , null,false);

if($checkCoupon > 0){
    $totalPrice = $totalPrice - $ordersprice * $couponDiscount /100 ;
    $stmt = $con->prepare("UPDATE `coupon` SET `coupon_count`=`coupon_count` - 1 WHERE coupon_id = '$couponid'");
    $stmt->execute();
}

$data = array(
    "orders_usersid"  => $usersid,
    "orders_address"  => $addressid ,
    "orders_type"  => $orderstype,
    "orders_pricedelivery"  => $pricedelivery,
    "orders_price"  => $ordersprice,
    "orders_coupon"  => $couponid,
    "orders_paymentmethod"  => $paymentmethod,
    "orders_totalprice"  =>$totalPrice,

);

$count = insertData("orders", $data, false) ;

if($count > 0){
    $stmt = $con->prepare("SELECT MAX(orders_id) from orders ");
    $stmt->execute();
    $mixid = $stmt->fetchColumn() ;

    $data = array("cart_orders" => $mixid);
    updateData("cart" , $data ,"cart_userid = $usersid AND cart_orders = 0" );
}


 
?>