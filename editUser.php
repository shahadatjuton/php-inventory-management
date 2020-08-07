<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$id = $_GET['id'];
$db = new Database();
$fm = new Format();
$sql = "SELECT * FROM users WHERE id = $id";
$user = $db->retrieve($sql)->fetch_assoc();

//Update user =======================
if(isset($_POST['updateUser'])){
    $name  =  mysqli_real_escape_string ($db->link, $_POST['name']);
    $email = mysqli_real_escape_string ($db->link, $_POST['email']);
    $phone = mysqli_real_escape_string ($db->link, $_POST['phone']);
    $role = mysqli_real_escape_string ($db->link, $_POST['role']);
    if($name == '' || $email =='' || $phone =='' || $role == '' ){
        $error = "Field must not be empty!!";
    }else{
        $sql = "UPDATE users SET name='$name', email= '$email', phone='$phone',user_type='$role' WHERE id= $id";
        $update = $db->update($sql);
        if ($update){
            echo "User Updated Successfully!";
//            header("location: categoryList.php");
        }else{
            echo "User Does Not Updated!";
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
               <h4>Update User</h4>
                  <a class="btn btn-success btn-sm float-right " href="{{route('user.index')}}">
                      <i class="fa fa-list"> User List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="editUser.php?id=<?php echo $user['id'] ?>" method="POST">
                    <div class="form-row">

                        <!-- /.form-group -->
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $user['phone'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select class="form-control select2" name="role" style="width: 100%;">
                                <option selected="selected"><?php echo $user['user_type'] ?></option>
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 offset-5">
                            <a href="{{route('user.index')}}" class="btn btn-dark">Back</a>
                            <button type="submit" name="updateUser" class="btn btn-success">Update</button>
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

  @endsection

@push('js')
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
                        minlength: "Your password does not match!"
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

