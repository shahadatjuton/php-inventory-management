<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
//Create user =======================
if(isset($_POST['createUser'])){
    $name  =  mysqli_real_escape_string ($db->link, $_POST['name']);
    $email = mysqli_real_escape_string ($db->link, $_POST['email']);
    $phone = mysqli_real_escape_string ($db->link, $_POST['phone']);
    $role = mysqli_real_escape_string ($db->link, $_POST['role']);
    if($name == '' || $email =='' || $phone =='' || $role == '' ){
        $error = "Field must not be empty!!";
    }else{
        $sql = "INSERT INTO users (name,email,phone,user_type) VALUES('$name', '$email', '$phone','$role')";
        $create = $db->insert($sql);
        if ($create){
            echo "User Created Successfully!";
//            header('location: categoryList.php');
        }else{
            echo "User Does Not Created!";
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
            <h1 class="m-0 text-dark">Manage User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
               <h4>Add User</h4>
                  <a class="btn btn-success btn-sm float-right " href="{{route('user.index')}}">
                      <i class="fa fa-list"> User List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="createUser.php" method="post" id="createUser">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select class="form-control select2" name="role" style="width: 100%;">
                                <option selected="selected">Select Role</option>
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 offset-5">
                            <a href="userList.php" class="btn btn-dark">Back</a>
                            <button type="submit" name="createUser" class="btn btn-success">Create</button>
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
                    password: {
                        required: true,
                        minlength: 4
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
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
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password_confirmation:  {
                        required: "Please provide a password",
                        equalTo: "Your password does not match!"
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
