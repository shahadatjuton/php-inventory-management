<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$id = $_GET['id'];
$db = new Database();
$fm = new Format();
$sql = "SELECT * FROM categories WHERE id = $id";
$category = $db->retrieve($sql)->fetch_assoc();

//Update user =======================
if(isset($_POST['updateCategory'])){
    $name  =  mysqli_real_escape_string ($db->link, $_POST['name']);
    if($name == '' ){
        $error = "Field must not be empty!!";
    }else{
        $sql = "UPDATE categories SET name='$name' WHERE id= $id";
        $update = $db->update($sql);
        if ($update){
            echo "Category Updated Successfully!";
//            header("location: categoryList.php");
        }else{
            echo "Category Does Not Updated!";
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
            <h1 class="m-0 text-dark">Manage Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
               <h4>Update Category</h4>
                  <a class="btn btn-success btn-sm float-right " href="categoryList.php">
                      <i class="fa fa-list"> Category List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="editCategory.php?id=<?php echo $category['id'] ?>" method="POST">
                    <div class="form-row">

                        <!-- /.form-group -->
                        <div class="form-group col-md-6 offset-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $category['name'] ?>">
                        </div>
                        <div class="form-group col-md-4 offset-5">
                            <a href="categoryList.php" class="btn btn-dark">Back</a>
                            <button type="submit" name="updateCategory" class="btn btn-success">Update</button>
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

