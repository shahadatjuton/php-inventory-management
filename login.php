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

                <form action="login.php" method="post" id="createUser">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>User Name</label>
                            <input type="text" name="user_name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group col-md-4 offset-5">
                            <button type="submit" name="createSupplier" class="btn btn-success">Log IN</button>
                        </div>

                    </div>

                </form>


    <script>
        $(function () {

            $('#createUser').validate({
                rules: {

                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,

                    },
                    address: {
                        required: true,

                    },

                },
                messages: {

                    name: {
                        required: "Please enter a name"
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    phone: {
                        required: "Please enter a contact number"
                    },
                    address: {
                        required: "Please provide the address"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
