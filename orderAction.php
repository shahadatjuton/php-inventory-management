<?php
include 'lib/Session.php';
Session::checkSession();
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
$user_id = $_SESSION['user_id'];

//Delete Order ================***********************================================
if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
    $sql = "DELETE FROM session WHERE session_id = $id";
    $deleteData = $db->delete($sql);
    if ($deleteData){
        echo "Order deleted successfully!";
        header('location: createOrder.php');
    }else{
        echo "Order does not deleted";
        header('location: createOrder.php');
    }
}

//Clear Order ================***********************================================

if (isset($_POST['orderClear'])) {
    $sql = "DELETE FROM session WHERE user_id = $user_id";
    $deleteData = $db->delete($sql);
    if ($deleteData){
        echo "Order deleted successfully!";
        header('location: createOrder.php');
    }else{
        echo "Order does not deleted";
    }
}
//add Product into session =======================
if(isset($_POST['addProduct'])){

    $product_id  =  mysqli_real_escape_string ($db->link, $_POST['product_id']);
    $quantity  =  mysqli_real_escape_string ($db->link, $_POST['quantity']);

    if($product_id == ''|| $quantity == ''  ){
        $error = "Field must not be empty!!";
    }else{
//        $product_id = $_POST['product_id'];
//         $_SESSION['product_id'] = $_POST['product_id'];
//        $_SESSION['quantity'] = $_POST['quantity'];

//        $sql = "SELECT * FROM products WHERE id = $product_id";
//        $cart_products = $db->retrieve($sql);
        $sql = "SELECT * FROM products WHERE id= $product_id";
        $result = $db->retrieve($sql);
        $productForPrice = $result->fetch_assoc();
        $product_price = $productForPrice['selling_price'];
        $total = $product_price * $quantity;
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO session (product_id,order_quantity,user_id,total,date) 
VALUES('$product_id', '$quantity','$user_id','$total','$date')";
        $create = $db->insert($sql);
        header('location: createOrder.php');

    }
}

//Place Order ====================================
if (isset($_POST['placeOrder'] )){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('Y-m-d H:i:s');
    //sum total from session table===============================
    $sql = "SELECT sum(session.total) as order_total
            FROM session
            WHERE user_id = $user_id";
    $result = $db->retrieve($sql)->fetch_assoc();
    $order_total = $result['order_total'];


    //Database ==========================================================
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php_inventory";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO orders(user_id, total, created_at)
                VALUES('$user_id', '$order_total', '$date')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
           $sql ="SELECT * FROM `session` WHERE user_id = $user_id";
            $result = $db->retrieve($sql);
//            $orders= $result->fetch_assoc();
            $count_order = mysqli_num_rows($result);
            foreach ($result as $order){
                $product_id = $order['product_id'];
                $order_quantity = $order['order_quantity'];
                $sql = "SELECT quantity FROM products WHERE id= $product_id";
                $result = $db->retrieve($sql)->fetch_assoc();
                $product_quantity = $result['quantity'];
                if ($product_quantity >$order_quantity ) {
                    $quantity = $product_quantity - $order_quantity;
                    $sql = "UPDATE products SET quantity='$quantity' WHERE id= $product_id";
                    $update = $db->update($sql);

                    $sql = "INSERT INTO order_details(order_id, product_id, quantity)
                VALUES('$last_id', '$product_id', '$order_quantity')";
                    $create = $db->insert($sql);
                }else{
                    echo "$product_id No product is out of stock";
                    $sql ="DELETE FROM `orders` WHERE order_id = $last_id";
                    $result = $db->retrieve($sql);
                }
            }
    header('location: createOrder.php');

//            for ($i = 0; $i < $count_order; $i ++){
//
//                $sql = "INSERT INTO order_details(order_id, product_id, quantity)
//                VALUES('$last_id', '$product_id', '$order_quantity')";
//                $create = $db->insert($sql);
//            }
            if ($create){
                $sql = "DELETE FROM session WHERE user_id = $user_id";
                $deleteData = $db->delete($sql);

                echo "Order Placed Successfully!";
                header('location: orderList.php');
        }else{
            echo "Order Does Not Created!";
        }

}
?>
