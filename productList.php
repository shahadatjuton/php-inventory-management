<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';

$db = new Database();

//Delete Product================
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";
    $deleteData = $db->delete($sql);
    if ($deleteData){
        echo "Product deleted successfully!";
    }else{
        echo "Product does not deleted";
    }
//    header('location: categoryList.php');

}

//$sql = "SELECT products.*, categories.name, suppliers.name, units.name
//        FROM products , categories, suppliers, units
//        INNER JOIN categories , suppliers, units
//        ON posts.category_id = categories.id,
//        posts.supplier_id = suppliers.id,
//        posts.unit_id = units.id
//        ORDER BY posts.id DESC ";
$sql = "SELECT * FROM products";
$products = $db->retrieve($sql);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
               <h4>Product List</h4>
                  <a class="btn btn-success btn-sm float-right " href="createProduct.php">
                      <i class="fa fa-plus-circle"> Add Product</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Name</th>
                        <th>Supplier</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($products) {
                        foreach ($products as $key => $product) { ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $product['name'] ?></td>
                                <td><?php echo $product['supplier'] ?></td>
                                <td><?php echo $product['category'] ?></td>
                                <td><?php echo $product['unit'] ?></td>
                                <td><?php echo $product['quantity'] ?></td>
                                <td>
                                    <a href="editProduct.php?id=<?php echo $product['id'] ?>"
                                       class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="productList.php?id=<?php echo $product['id'] ?>"
                                       class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <!--                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary btn-sm" title="Edit">-->
                                    <!--                                <i class="fa fa-edit"></i>-->
                                    <!--                            </a>-->
                                    <!--                            <button type="button"  class="btn btn-danger waves-effect btn-sm" onclick="deleteuser({{$user->id}})">-->
                                    <!--                                <i class="fas fa-trash-alt"></i>-->
                                    <!---->
                                    <!--                            </button>-->
                                    <!--                            <form  id="delete-user-{{$user->id}}" action="{{route('user.destroy',$user->id)}}"-->
                                    <!--                                   method="post" style="display:none;"-->
                                    <!--                            >-->
                                    <!--                                @csrf-->
                                    <!--                                @method('DELETE')-->
                                    <!--                            </form>-->
                                </td>
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
