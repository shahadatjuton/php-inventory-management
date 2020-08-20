<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';

$db = new Database();
$user_id = $_SESSION['user_id'];

//$sql = "SELECT * FROM orders
//INNER JOIN order_details ON order_details.order_id = orders.id
//INNER JOIN users ON users.id = orders.user_id
//INNER JOIN products ON products.id = order_details.product_id
//WHERE user_id = $user_id";

$sql = "SELECT * FROM products
WHERE quantity < 20";
$lowStocks = $db->retrieve($sql);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Stock</li>
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
               <h4>Product Stock</h4>
                  <a class="btn btn-success btn-sm float-right " href="createProduct.php">
                      <i class="fa fa-plus-circle"> Add Product</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Product Number</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($lowStocks) {
                        foreach ($lowStocks as $key => $lowStock) { ?>
                            <tr>
                                <td><?php echo $lowStock['id'] ?></td>
                                <td><?php echo $lowStock['name'] ?></td>
                                <td><?php echo $lowStock['quantity'] ?></td>
                            </tr>
                        <?php }//end foreach
                    } else {?>
                        <h2 class="text-center mt-4 mb-4">No Data is found here!</h2>
                    <?php } ?>
                    </tbody>

                </table>

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
    <script type="text/javascript">

        function deleteuser(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-user-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>
<?php include 'inc/footer.php'; ?>
