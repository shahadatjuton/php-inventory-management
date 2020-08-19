<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$id = $_GET['id'];
$db = new Database();
$fm = new Format();
//Retrieve data for create products   =======================
$sql = "SELECT * FROM categories";
$categories = $db->retrieve($sql);

$sql = "SELECT * FROM suppliers";
$suppliers = $db->retrieve($sql);

$sql = "SELECT * FROM units";
$units = $db->retrieve($sql);

//Retrieve data from products using product id  =======================
$sql = "SELECT * FROM products WHERE id = $id";
$product = $db->retrieve($sql)->fetch_assoc();
//Update Supplier =======================
if(isset($_POST['updateProduct'])){

    $name  =  mysqli_real_escape_string ($db->link, $_POST['name']);
    $category  =  mysqli_real_escape_string ($db->link, $_POST['category']);
    $supplier  =  mysqli_real_escape_string ($db->link, $_POST['supplier']);
    $unit =  mysqli_real_escape_string ($db->link, $_POST['unit']);
    $quantity =  mysqli_real_escape_string ($db->link, $_POST['quantity']);
    $buying_price =  mysqli_real_escape_string ($db->link, $_POST['buying_price']);
    $selling_price =  mysqli_real_escape_string ($db->link, $_POST['selling_price']);
    $updated_by  =  "Admin";

    if($name == ''|| $category == '' || $supplier == '' || $unit == '' ||
        $quantity == '' || $buying_price==''|| $selling_price==''){
        $error = "Field must not be empty!!";
    }else{
        $sql = "UPDATE products SET name='$name', category= '$category', supplier='$supplier', 
        unit='$unit' ,quantity='$quantity',buying_price ='$buying_price',
        selling_price ='$selling_price' , updated_by = '$updated_by' WHERE id= $id";
        $update = $db->update($sql);
        if ($update){
            echo "Product Updated Successfully!";
//            header('location: categoryList.php');
        }else{
            echo "Product Does Not Updated!";
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
                            <h4>Update Product</h4>
                            <a class="btn btn-success btn-sm float-right " href="productList.php">
                                <i class="fa fa-list"> Product List</i>
                            </a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form action="editProduct.php?id=<?php echo $product['id'] ?>" method="post" id="updateProduct">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $product['name'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control" value="<?php echo $product['quantity'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Buying Price</label>
                                        <input type="number" name="buying_price" min="0" class="form-control" value="<?php echo $product['buying_price'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Selling Price</label>
                                        <input type="number" name="selling_price" min="0" class="form-control" value="<?php echo $product['selling_price'] ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Supplier</label>
                                        <select name="supplier" class="form-control select2" style="width: 100%;">
                                            <option selected="selected"><?php echo $product['supplier'] ?></option>
                                            <?php foreach ($suppliers as $key => $supplier) { ?>
                                                <option><?php echo $supplier['name'] ?></option>
                                            <?php } ?>//end foreach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Category</label>
                                        <select name="category" class="form-control select2" style="width: 100%;">
                                            <option selected="selected"><?php echo $product['category'] ?></option>
                                            <?php foreach ($categories as $key => $category) { ?>
                                                <option><?php echo $category['name'] ?></option>
                                            <?php } ?>//end foreach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Unit</label>
                                        <select name="unit" class="form-control select2" style="width: 100%;">
                                            <option selected="selected"><?php echo $product['unit'] ?></option>
                                            <?php foreach ($units as $key => $unit) { ?>
                                                <option><?php echo $unit['name'] ?></option>
                                            <?php } ?>//end foreach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 offset-5">
                                        <a href="productList.php" class="btn btn-dark">Back</a>
                                        <button type="submit" name="updateProduct" class="btn btn-success">Update</button>
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

        $('#updateProduct').validate({
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
