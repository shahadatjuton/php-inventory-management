<?php
include 'lib/Session.php';
Session::checkSession();
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
$user_id = $_SESSION['user_id'];


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

//Place Order ====================================
if (isset($_POST['placeOrder'] )){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('Y-m-d H:i:s');
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
                VALUES('$user_id', '0', '$date')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
           $sql ="SELECT * FROM `session` WHERE user_id = $user_id";
            $result = $db->retrieve($sql);
            $orders= $result->fetch_assoc();
            $count_order = mysqli_num_rows($result);
            $product_id = $orders['product_id'];
            $order_quantity = $orders['order_quantity'];
            for ($i = 0; $i < $count_order; $i ++){

                $sql = "INSERT INTO order_details(order_id, product_id, quantity)
                VALUES('$last_id', '$product_id', '$order_quantity')";
                $create = $db->insert($sql);
            }
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
