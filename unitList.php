<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include 'config/config.php';
include 'lib/db.php';
include  'helpers/format.php';

$db = new Database();
$fm = new Format();
//Delete user================
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM units WHERE id = $id";
    $deleteData = $db->delete($sql);
//    header('location: categoryList.php');

}

$sql = "SELECT * FROM units";
$units = $db->retrieve($sql);
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
                            <h4>Unit List</h4>
                            <a class="btn btn-success btn-sm float-right " href="createUnit.php">
                                <i class="fa fa-plus-circle"> Add Unit </i>
                            </a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($units as $key=>$unit) {?>
                                <tr>
                                    <td><?php echo $key +1 ?></td>
                                    <td><?php echo $unit['name'] ?></td>
                                    <td>
                                        <a href="editUnit.php?id=<?php echo $unit['id'] ?>" class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="unitList.php?id=<?php echo $unit['id'] ?>" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
<!--                                        <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-primary btn-sm" title="Edit">-->
<!--                                            <i class="fa fa-edit"></i>-->
<!--                                        </a>-->
<!--                                        <button type="button"  class="btn btn-danger waves-effect btn-sm" onclick="deletedata({{$category->id}})">-->
<!--                                            <i class="fas fa-trash-alt"></i>-->
<!--                                        </button>-->
<!--                                        <form  id="delete-data-{{$category->id}}" action="{{route('admin.category.destroy',$category->id)}}"-->
<!--                                               method="post" style="display:none;"-->
<!--                                        >-->
<!--                                            @csrf-->
<!--                                            @method('DELETE')-->
<!--                                        </form>-->
                                    </td>
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
<script type="text/javascript">

    function deletedata(id) {

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
                document.getElementById('delete-data-' + id).submit();
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
