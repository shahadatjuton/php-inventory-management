<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
//Create user =======================
if(isset($_POST['createCategory'])){
    $name  =  mysqli_real_escape_string ($db->link, $_POST['name']);
    if($name == '' ){
        $error = "Field must not be empty!!";
    }else{
        $sql = "INSERT INTO units (name) VALUES('$name')";
        $create = $db->insert($sql);
        if ($create){
            echo "Unit Created Successfully!";
//            header('location: categoryList.php');
        }else{
            echo "Unit Does Not Created!";
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
            <h1 class="m-0 text-dark">Manage Unit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Unit</li>
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
               <h4>Add Unit</h4>
                  <a class="btn btn-success btn-sm float-right " href="unitList.php">
                      <i class="fa fa-list"> Unit List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="createUnit.php" method="post" id="createUnit">

                    <div class="form-row">
                        <div class="form-group col-md-6 offset-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <div class="form-group col-md-4 offset-5">
                            <a href="unitList.php" class="btn btn-dark">Back</a>
                            <button type="submit" name="createCategory" class="btn btn-success">Create</button>
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

            $('#createUnit').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name"
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
