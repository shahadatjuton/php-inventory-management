<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';
$db = new Database();
$fm = new Format();
//Delete user================
if (isset($_POST['salesReport'])) {

$product_id  =  mysqli_real_escape_string ($db->link, $_POST['product_id']);
$fromDate =  mysqli_real_escape_string ($db->link, $_POST['from_date']);
$toDate  =  mysqli_real_escape_string ($db->link, $_POST['to_date']);

if($product_id == ''|| $fromDate == '' || $toDate == ''){
    $error = "Field must not be empty!!";
}else{

    $sql = "SELECT * FROM order_details
            INNER JOIN products ON products.id = order_details.product_id
            WHERE date BETWEEN '$fromDate' AND '$toDate' 
            AND product_id = $product_id ";
    $sold_products = $db->retrieve($sql);

//    $sold_products = $result->fetch_assoc();
}

//    header('location: categoryList.php');

}

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
                    <h1 class="m-0 text-dark">Sales Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Report</li>
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
                            <form action="salesReport.php" method="post" id="createUnit">

                                <div class="form-row">
                                    <div class="form-group col-md-4 ">
                                        <label>Product Name</label>
                                        <select name="product_id" id="product_id" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Select Product</option>
                                            <?php foreach ($products as $key => $product) { ?>
                                                <option value="<?php echo $product['id'] ?>"><?php echo $product['name'] ?></option>
                                            <?php } ?>//end foreach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4 offset-5">
                                        <button type="submit" name="salesReport" class="btn btn-success">Generate Report</button>
                                    </div>
                                </div>

                            </form>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Sale Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($sold_products)) {
                                    foreach ($sold_products as $key => $product) { ?>
                                        <tr>
                                            <td><?php echo $key + 1 ?></td>
                                            <td><?php echo $product['name'] ?></td>
                                            <td><?php echo $product['supplier'] ?></td>
                                            <td><?php echo $product['category'] ?></td>
                                            <td><?php echo $product['quantity'] ?><?php echo $product['unit'] ?></td>
                                            <td><?php echo $product['selling_price'] ?></td>
                                            <td><?php echo $product['selling_price'] * $product['quantity']?></td>
                                            <td><?php echo date("d-M-Y", strtotime($product['date'])) ?></td>

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
<?php include 'inc/footer.php'; ?>
