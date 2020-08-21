
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Inventory Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
            <div class="info">
                <a href="<?php
                if ($_SESSION['user_type']=="Admin"){
                    echo "admin.php";
                }else{
                    echo "user.php";
                }


                ?>" class="d-block ml-4" ><?php echo strtoupper($_SESSION['user_name']); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <?php
                if($_SESSION['user_type'] == "Admin")
                {
                ?>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-user-circle"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="userList.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <p>
                            Category Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="categoryList.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-balance-scale-right"></i>
                        <p>
                            Unit Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="unitList.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Unit List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            Suppliers Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="supplierList.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier List</p>
                            </a>
                        </li>
                    </ul>
                </li>
<!--                <li class="nav-item has-treeview menu-open]">-->
<!--                    <a href="#" class="nav-link ">-->
<!--                        <i class="nav-icon fas fa-tachometer-alt"></i>-->
<!--                        <p>-->
<!--                            Customers Management-->
<!--                            <i class="right fas fa-angle-left"></i>-->
<!--                        </p>-->
<!--                    </a>-->
<!--                    <ul class="nav nav-treeview">-->
<!--                        <li class="nav-item">-->
<!--                            <a href="customerList.php" class="nav-link active">-->
<!--                                <i class="far fa-circle nav-icon"></i>-->
<!--                                <p>Customer List</p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->

                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-pallet"></i>
                        <p>
                            Products Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="productList.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    <?php
                }
                ?>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-cart-plus"></i>
                        <p>
                            Orders Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="orderList.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-shopping-basket"></i>
                        <p>
                            Low  Stock
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="lowStock.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Low Stock</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open]">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="salesReport.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="purchaseReport.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Report</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview menu-open]">
                    <a href="logout.php" class="nav-link ">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>