<?php require("config/config.php") ?>

<?php require("include/header.php"); ?>
<?php require("include/officials/sidebar.php"); ?>

<!-- Input data to database -->
<?php
if (isset($_POST['submit'])) {
    $barangay_id = $_SESSION['barangay_id'];
    $official_name = $_POST['official_name'];
    $position = $_POST['position'];
    $insert = $conn->prepare("INSERT INTO barangay_officials( barangay_id, official_name, position) VALUES (:barangay_id, :official_name, :position)");
    $insert->execute([
        ":barangay_id" => $barangay_id,
        ":official_name" => $official_name,
        ":position" => $position
    ]);
}
?>
<!-- Input data to database -->

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">BARANGAY OFFICIALS</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo APPURL ?>/index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Brgy. Officials
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
                                    <h2 class="card-title m-1">Brgy. Officials Table</h2>
                                    <button type="button" data-toggle="modal" data-target="#addNew" data-whatever="@getbootstrap" class="btn btn-success btn-sm add-new card-title m-1"><i class="la la-plus-circle"></i></button>
                                </div>
                            </div>

                            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="card-header text-center mt-1">
                                            <h4 class="card-title" id="exampleModalLabel">ADD NEW OFFICIAL</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="officials.php">
                                                <div class="mb-1">
                                                    <select name="official_name" id="official_name" class="form-control">
                                                        <option value="" selected disabled>Owner</option>
                                                        <?php
                                                        $brgy = $_SESSION['barangay_id'];
                                                        $owner = $conn->prepare(
                                                            "SELECT * FROM resident WHERE barangay_id = $brgy"
                                                        );
                                                        $owner->execute();
                                                        $owner_users = $owner->fetchAll();
                                                        foreach ($owner_users as $user) {
                                                        ?>
                                                            <option value="<?php echo $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']; ?>"><?php echo $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="mb-1">
                                                    <select name="position" id="position" class="form-control">
                                                        <option value="" class="text-muted" disabled selected>Position</option>
                                                        <option value="Brgy. Chairman">Brgy. Chairman</option>
                                                        <option value="Brgy. Kagawad">Brgy. Kagawad</option>
                                                        <option value="Brgy. Secretary">Brgy. Secretary</option>
                                                        <option value="Brgy. Treasurer">Brgy. Treasurer</option>
                                                        <option value="SK Chairman">SK Chairman</option>
                                                        <option value="SK Kagawad">SK Kagawad</option>
                                                        <option value="SK Secretary">SK Secretary</option>
                                                        <option value="SK Treasurer">SK Treasurer</option>
                                                    </select>
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
                                        <th>Official Name</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                    <!-- fetch data from database to resident table -->
                                    <?php
                                    $brgy = $_SESSION['barangay_id'];
                                    $stmt = $conn->prepare(
                                        "SELECT * FROM barangay_officials WHERE barangay_id = $brgy"
                                    );
                                    $stmt->execute();
                                    $users = $stmt->fetchAll();
                                    foreach ($users as $user) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $user['official_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['official_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['position']; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <button name="<?php echo $user['official_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#viewModal<?php echo $user['official_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-info">
                                                        <i class='la la-eye'></i>
                                                    </button>
                                                    <button name="<?php echo $user['official_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#editModal<?php echo $user['official_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-primary">
                                                        <i class='la la-edit'></i>
                                                    </button>
                                                    <button name="<?php echo $user['official_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#deleteModal<?php echo $user['official_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-danger">
                                                        <i class='la la-trash'></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- fetch data from database to resident table -->

                                        <!-- View modal -->
                                        <div class="modal fade" id="viewModal<?php echo $user['official_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewResident">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-body">
                                                        <div class="card-header text-center mt-1">
                                                            <h4 class="card-title" id="viewHousehold">OFFICIAL INFORMATION</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 25%;"><Strong>Official Name</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 59%;">
                                                                        <?php echo $user['official_name']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 25%;"><Strong>Position</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 59%;">
                                                                        <?php echo $user['position']; ?>
                                                                    </p>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- View modal -->

                                            <!-- Edit modal -->
                                            <div class="modal fade" id="editModal<?php echo $user['official_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editResident">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="card-header text-center mt-1">
                                                            <h4 class="card-title" id="editResident">EDIT OFFICIAL</h4>
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
                                            <div class="modal fade" id="deleteModal<?php echo $user['official_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteResident">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="card-header text-center mt-1">
                                                            <h4 class="card-title text-danger" id="deleteResident">DELETE OFFICIAL</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="text-center">Are you sure you want to delete this official?</h6>
                                                        </div>
                                                        <div class="text-center mb-1">
                                                            <button name="deleteYes" id="submit" type="button" class="btn btn-danger" style="width: 45%;">YES</button>
                                                            <button name="deleteNo" id="btnClose" type="button" class="btn btn-secondary" style="width: 45%;" data-dismiss="modal">NO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete modal -->

                                        <?php
                                    }
                                        ?>
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