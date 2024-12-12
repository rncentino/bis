<?php require("config/config.php") ?>

<?php require("include/header.php"); ?>
<?php require("include/case/sidebar.php"); ?>

<!-- Input data to database -->
<?php
if (isset($_POST['submit'])) {
    $barangay_id = $_SESSION['barangay_id'];
    $case_title = $_POST['case_title'];
    $case_details = $_POST['case_details'];
    $status = $_POST['status'];
    $other_details = $_POST['other_details'];
    $insert = $conn->prepare("INSERT INTO case_management( barangay_id, case_title, case_details, status, other_details) VALUES (:barangay_id, :case_title, :case_details, :status, :other_details)");
    $insert->execute([
        ":barangay_id" => $barangay_id,
        ":case_title" => $case_title,
        ":case_details" => $case_details,
        ":status" => $status,
        ":other_details" => $other_details,
    ]);
}
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">CASE MANAGEMENTS</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo APPURL ?>/index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Case Managements
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Bordered table start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="table-title">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h2 class="card-title m-1">Case Managements Table</h2>
                                    <button type="button" data-toggle="modal" data-target="#addNew" data-whatever="@getbootstrap" class="btn btn-success btn-sm add-new card-title m-1"><i class='la la-plus-circle'></i></button>
                                </div>
                            </div>

                            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="card-header text-center mt-1">
                                            <h4 class="card-title" id="exampleModalLabel">ADD NEW CASE</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="case.php">
                                                <div class="mb-1">
                                                    <input type="text" class="form-control" placeholder="Enter case title" id="case_title" required name="case_title">
                                                </div>
                                                <div class="mb-1">
                                                    <input type="text" class="form-control" placeholder="Enter case details" id="case_details" required name="case_details">
                                                </div>
                                                <div class="mb-1">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="" selected disabled>Status</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="standby">Standby</option>
                                                        <option value="resolved">Resolved</option>
                                                        <option value="closed">Closed</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <input type="text" class="form-control" placeholder="Enter other details (optional)" id="other_details" name="other_details">
                                                </div>
                                                <div class="text-center mb-1">
                                                    <button name="submit" id="submit" type="submit" class="btn btn-success" style="width: 100%;">ADD</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>ID</th>
                                            <th>Case Title</th>
                                            <th>Case Details</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- fetch data from database to resident table -->
                                        <?php
                                        $a = 1;
                                        $brgy = $_SESSION['barangay_id'];
                                        $stmt = $conn->prepare(
                                            "SELECT * FROM case_management WHERE barangay_id = $brgy"
                                        );
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $user) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $user['case_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['case_title']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['case_details']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['status']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['created_at']; ?>
                                                </td>
                                                <td>
                                                    <?php echo "
                                                    <div class='d-flex justify-content-between'>
                                                    <button style='width: 30%;' type='button' data-toggle='modal' data-target='#viewModal' data-whatever='@getbootstrap' class='btn btn-sm btn-info'><i class='la la-eye'></i></button>
                                                    <button style='width: 30%;' type='button' data-toggle='modal' data-target='#editModal' data-whatever='@getbootstrap' class='btn btn-sm btn-primary'><i class='la la-edit'></i></button>
                                                    <button style='width: 30%;' type='button' data-toggle='modal' data-target='#deleteModal' data-whatever='@getbootstrap' class='btn btn-sm btn-danger'><i class='la la-trash'></i></button>
                                                    </div>
                                                    " ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <!-- fetch data from database to resident table -->

                                        <!-- View modal -->
                                        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewCase">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title" id="viewCase">VIEW CASE</h4>
                                                    </div>
                                                    <div class="card-body">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- View modal -->

                                        <!-- Edit modal -->
                                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editCase">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title" id="editCase">EDIT RESIDENT</h4>
                                                    </div>
                                                    <div class="card-body">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit modal -->

                                        <!-- Delete modal -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteCase">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title text-danger" id="deleteCase">DELETE RESIDENT</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="text-center">Are you sure you want to delete this case?</h6>
                                                    </div>
                                                    <div class="text-center mb-1">
                                                        <button name="deleteYes" id="submit" type="button" class="btn btn-danger" style="width: 45%;">YES</button>
                                                        <button name="deleteNo" id="btnClose" type="button" class="btn btn-secondary" style="width: 45%;" data-dismiss="modal">NO</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete modal -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bordered table end -->
        </div>
    </div>
</div>

<?php require("include/footer.php"); ?>