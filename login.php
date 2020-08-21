<?php
include 'lib/Session.php';
Session::init();
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_name = $fm->validation($_POST['user_name']);
        $password = $fm->validation(md5($_POST['password']));

        $user_name  =  mysqli_real_escape_string ($db->link, $_POST['user_name']);
        $password  =  mysqli_real_escape_string ($db->link, $_POST['password']);



        $query = "SELECT * FROM users WHERE name = '$user_name' AND password = '$password'";
        $result = $db->retrieve($query);
        if ($result != false){
            $value = mysqli_fetch_array($result);
            $row = mysqli_num_rows($result);
            if ($result>0){
                $_SESSION['user_type'] = $value['user_type'];
                $_SESSION['user_id'] = $value['id'];
                $_SESSION['user_name'] = $value['name'];
                Session::set("login",true);
                Session::set("user_name",$value['name']);
                Session::set("user_id",$value['id']);
                if ($value['user_type']=="Admin"){
                    header("Location:admin.php");
                }elseif($value['user_type']=="User"){
                    header("Location:user.php");
                }
            }else{
                echo "No Result Found";
            }
        }else{
            echo "Not Match!";
        }
    }


?>


<style>
    body {
        background: #000 !important;
    }
    .card {
        border: 1px solid #28a745;
    }
    .card-login {
        margin-top: 130px;
        padding: 18px;
        max-width: 30rem;
    }

    .card-header {
        color: #fff;
        /*background: #ff0000;*/
        font-family: sans-serif;
        font-size: 20px;
        font-weight: 600 !important;
        margin-top: 10px;
        border-bottom: 0;
    }

    .input-group-prepend span{
        width: 50px;
        background-color: #ff0000;
        color: #fff;
        border:0 !important;
    }

    input:focus{
        outline: 0 0 0 0  !important;
        box-shadow: 0 0 0 0 !important;
    }

    .login_btn{
        width: 130px;
    }

    .login_btn:hover{
        color: #fff;
        background-color: #ff0000;
    }

    .btn-outline-danger {
        color: #fff;
        font-size: 18px;
        background-color: #28a745;
        background-image: none;
        border-color: #28a745;
    }

    .form-control {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1.2rem;
        line-height: 1.6;
        color: #28a745;
        background-color: transparent;
        background-clip: padding-box;
        border: 1px solid #28a745;
        border-radius: 0;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .input-group-text {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding: 0.375rem 0.75rem;
        margin-bottom: 0;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1.6;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0;
    }
</style>

<link href="login/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="login/bootstrap.min.js"></script>
<script src="login/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="login/all.css">
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <h4>Inventory Management System</h4>
            <span class="logo_title mt-5"> Login Dashboard </span>
            <!--            <h1>--><?php //echo $message?><!--</h1>-->

        </div>
        <div class="card-body">
            <form action="login.php" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="user_name" class="form-control" placeholder="Username">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Login" class="btn btn-outline-danger float-right login_btn">
                </div>

            </form>
        </div>
    </div>
</div>
