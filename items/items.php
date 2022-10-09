<?php

include "../connect.php";


$categoryId = filterRequest("id");

getAllData("itemview","categories_id = $categoryId");

?>