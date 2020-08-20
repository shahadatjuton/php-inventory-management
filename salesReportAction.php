<?php
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
//Delete user================
if (isset($_POST['salesReport'])) {

    $product_id =  mysqli_real_escape_string ($db->link, $_POST['product_id']);
    $fromDate =  mysqli_real_escape_string ($db->link, $_POST['from_date']);
    $toDate  =  mysqli_real_escape_string ($db->link, $_POST['to_date']);

    if($product_id == ''|| $fromDate == '' || $toDate == ''){
        $error = "Field must not be empty!!";
    }else{

        $sql = "SELECT * FROM order_details
                WHERE date BETWEEN $fromDate AND $toDate 
                AND product_id = 1 ";
        $result = $db->retrieve($sql);
        foreach ($result as $product){
            echo  $product['name'] ;
        }
        $sold_products = $result->fetch_assoc();
    }

//    header('location: categoryList.php');

}

$sql = "SELECT * FROM products";
$select_Product = $db->retrieve($sql);
?>
