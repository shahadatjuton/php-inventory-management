<?php
include 'inc/header.php';
//include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$id = $_GET['id'];
$db = new Database();
$fm = new Format();
$sql = "SELECT * FROM customers WHERE id = $id";
$customer = $db->retrieve($sql)->fetch_assoc();
//Update Supplier =======================
if(isset($_POST['updateCustomer'])){
    $id = $_GET['id'];
    $name  =  mysqli_real_escape_string ($db->link, $_POST['name']);
    $email  =  mysqli_real_escape_string ($db->link, $_POST['email']);
    $phone  =  mysqli_real_escape_string ($db->link, $_POST['phone']);
    $address  =  mysqli_real_escape_string ($db->link, $_POST['address']);
    $updated_by  =  1;

    if($name == ''|| $email == '' || $phone == '' || $address == '' ){
        $error = "Field must not be empty!!";
    }else{
        $sql = "UPDATE customers SET name='$name', email= '$email', phone='$phone', 
        address='$address' , updated_by = '$updated_by' WHERE id= $id";
        $update = $db->update($sql);
        if ($update){
            header("location: customerList.php");
        }else{
            echo "Customer Does Not Updated!";
        }
    }
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 ">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Customer</h4>
                            <a class="btn btn-success btn-sm float-right " href="customerList.php">
                                <i class="fa fa-list"> Customer List</i>
                            </a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form action="editCustomer.php?id=<?php echo $customer['id'] ?>" method="post" id="createUser">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $customer['name'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $customer['email'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $customer['phone'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="<?php echo $customer['address'] ?>">
                                    </div>
                                    <div class="form-group col-md-4 offset-5">
                                        <a href="customerList.php" class="btn btn-dark">Back</a>
                                        <button type="submit" name="updateCustomer" class="btn btn-success">Update</button>
                                    </div>

                                </div>

                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
<?php include 'inc/footer.php'; ?>
