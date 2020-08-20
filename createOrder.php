<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
$user_id = $_SESSION['user_id'];
//Retrieve data for create products   =======================
$sql = "SELECT * FROM products";
$products = $db->retrieve($sql);

$sql = "SELECT * FROM `session`
INNER JOIN products ON products.id = session.product_id 
WHERE user_id = $user_id  ";
$cart_products = $db->retrieve($sql);

//Delete Order ================***********************================================
if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
    $sql = "DELETE FROM session WHERE session_id = $id";
    $deleteData = $db->delete($sql);
    if ($deleteData){
        echo "Order deleted successfully!";
        header('location: createOrder.php');
    }else{
        echo "Order does not deleted";
        header('location: createOrder.php');
    }
}


//add Product into session =======================
if(isset($_POST['addProduct'])){

    $product_id  =  mysqli_real_escape_string ($db->link, $_POST['product_id']);
    $quantity  =  mysqli_real_escape_string ($db->link, $_POST['quantity']);

    if($product_id == ''|| $quantity == ''  ){
        $error = "Field must not be empty!!";
    }else{
//        $product_id = $_POST['product_id'];
//         $_SESSION['product_id'] = $_POST['product_id'];
//        $_SESSION['quantity'] = $_POST['quantity'];

//        $sql = "SELECT * FROM products WHERE id = $product_id";
//        $cart_products = $db->retrieve($sql);
        $sql = "SELECT * FROM products WHERE id= $product_id";
        $result = $db->retrieve($sql);
        $productForPrice = $result->fetch_assoc();
        $product_price = $productForPrice['selling_price'];
        $total = $product_price * $quantity;
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO session (product_id,order_quantity,user_id,total,date) 
VALUES('$product_id', '$quantity','$user_id','$total','$date')";
        $create = $db->insert($sql);
        header('location: createOrder.php');

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
            <h1 class="m-0 text-dark">Manage Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
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
               <h4>Add Order</h4>
                  <a class="btn btn-success btn-sm float-right " href="orderList.php">
                      <i class="fa fa-list"> Order List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="orderAction.php" method="post" id="createUser">

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Select Product</label>
                            <select name="product_id" id="product_id" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Select Product</option>
                                <?php foreach ($products as $key => $product) { ?>
                                    <option value="<?php echo $product['id'] ?>"><?php echo $product['name'] ?></option>
                                <?php } ?>//end foreach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="number" name="quantity"  class="form-control">
                        </div>

                        <div class="form-group col-md-4 offset-5">
                            <button type="submit" name="addProduct" class="btn btn-success">Add Product</button>
                        </div>

                    </div>

                </form>
              </div><!-- /.card-body -->

                <div class="card-body">
                    <form action="orderAction.php" method="post" >
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($cart_products) {
                            foreach ($cart_products as $key => $cart_product) { ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="product_id" <?php echo $cart_product['product_id'] ?> >
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="" ">
                                        <?php echo $cart_product['name'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="">
                                        <?php echo $cart_product['selling_price'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="quantity" value="<?php echo $cart_product['order_quantity']?>">
                                        <?php echo $cart_product['order_quantity']?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="price">
                                        <?php echo $cart_product['order_quantity']*$cart_product['selling_price'] ?>
                                    </td>
                                    <td>
                                        <a href="orderAction.php?order_id=<?php echo $cart_product['session_id'] ?>"
                                           class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php }//end foreach
                        } else {?>
                            <h2 class="text-center mt-4 mb-4">Products Are Not Selected Yet</h2>
                        <?php } ?>
                        </tbody>

                    </table>

                        <div class="form-group col-md-4 offset-5">
                            <button type="submit" name="orderClear" class="btn btn-danger">Clear Order</button>
                            <button type="submit" name="placeOrder" class="btn btn-success">Place Order</button>
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
    <script type="text/javascript">
        $(function () {
        $(document).on('','',function () {
        var supplier_id = $(this).val();
        $.ajax({
            url:"orderAction.php",
            type:"GET",
            data:{supplier_id:supplier_id},
            success:function (data) {
            var html = '<option value="">Select Category</option>';
            $.each(data,function (key , v) {
            html += '<option value="'+v.category_id+'">'+v.category_id+'</option>';
            });
            $(#'category_id').html(html);
            }
        });
        });
        });
    </script>
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
