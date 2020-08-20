<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();

$sql = "SELECT * FROM products";
$products = $db->retrieve($sql);
$count_product = mysqli_num_rows($products);

$sql = "SELECT * FROM orders";
$result = $db->retrieve($sql);
$count_order = mysqli_num_rows($result);
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $count_order?></h3>

                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $count_product?></h3>

                                <p>Total Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
<!--                    <div class="col-lg-3 col-6">-->
                        <!-- small box -->
<!--                        <div class="small-box bg-warning">-->
<!--                            <div class="inner">-->
<!--                                <h3>44</h3>-->
<!---->
<!--                                <p>User Registrations</p>-->
<!--                            </div>-->
<!--                            <div class="icon">-->
<!--                                <i class="ion ion-person-add"></i>-->
<!--                            </div>-->
<!--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- ./col -->
<!--                    <div class="col-lg-3 col-6">-->
                        <!-- small box -->
<!--                        <div class="small-box bg-danger">-->
<!--                            <div class="inner">-->
<!--                                <h3>65</h3>-->
<!---->
<!--                                <p>Unique Visitors</p>-->
<!--                            </div>-->
<!--                            <div class="icon">-->
<!--                                <i class="ion ion-pie-graph"></i>-->
<!--                            </div>-->
<!--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th class="text-center">Stock</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($products as $key=>$product) {?>
                                        <tr>
                                            <td><?php echo $key +1 ?></td>
                                            <td><?php echo $product['name'] ?></td>
                                            <td class="bg-danger text-center"><?php echo $product['quantity'] ?></td>

                                        </tr>
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