<?php require("config/config.php") ?>

<?php require("include/header.php"); ?>
<?php require("include/households/sidebar.php"); ?>

<?php
if (isset($_POST['submit'])) {
    $barangay_id = $_SESSION['barangay_id'];
    $owner_name = $_POST['owner_name'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $tenure = $_POST['tenure'];
    $income_level = $_POST['income_level'];

    $insert = $conn->prepare("INSERT INTO household( barangay_id, owner_name, size, type, tenure, income_level) VALUES ( :barangay_id, :owner_name, :size, :type, :tenure, :income_level)");
    $insert->execute([
        ":barangay_id" => $barangay_id,
        ":owner_name" => $owner_name,
        ":size" => $size,
        ":type" => $type,
        ":tenure" => $tenure,
        ":income_level" => $income_level,
    ]);
}
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">HOUSEHOLDS</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo APPURL ?>/index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Households
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
                                    <h2 class="card-title m-1">Households Table</h2>
                                    <button type="button" data-toggle="modal" data-target="#addNew" data-whatever="@getbootstrap" class="btn btn-sm btn-success add-new card-title m-1"><i class="la la-plus-circle"></i></button>
                                </div>
                            </div>

                            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="card-header text-center mt-1">
                                            <h4 class="card-title" id="exampleModalLabel">ADD NEW HOUSEHOLD</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="households.php">
                                                <div class="mb-1">
                                                    <select name="owner_name" id="owner_name" class="form-control">
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
                                                    <input type="number" class="form-control" placeholder="Size (no. of individuals living on household)" id="size" required name="size">
                                                </div>
                                                <div class="mb-1">
                                                    <select class="form-control" name="type" id="type" required>
                                                        <option value="" selected disabled>Type of household</option>
                                                        <option value="Nuclear Family">Nuclear Family</option>
                                                        <option value="Single-person Household">Single-person Household</option>
                                                        <option value="Extended Family">Extended Family</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <select class="form-control" name="tenure" id="tenure">
                                                        <option value="" selected disabled>Tenure</option>
                                                        <option value="Owned">Owned</option>
                                                        <option value="Rent">Rent</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <select class="form-control" name="income_level" id="income_level">
                                                        <option value="" selected disabled>Income Level</option>
                                                        <option value="Rich">Rich: ₱219,140 and up</option>
                                                        <option value="High income">High income: ₱131,484 to ₱219,140</option>
                                                        <option value="Upper middle class">Upper middle class: ₱76,669 to ₱131,484</option>
                                                        <option value="Middle class">Middle class: ₱43,828 to ₱76,669</option>
                                                        <option value="Lower middle class">Lower middle class: ₱21,194 to ₱43,828</option>
                                                        <option value="Low income">Low income: ₱10,957 to ₱21,194</option>
                                                        <option value="Poor">Poor: Less than ₱10,957</option>
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
                                        <th>Owner</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>

                                    <!-- fetch data from database to resident table -->
                                    <?php
                                    $stmt = $conn->prepare(
                                        "SELECT * FROM household WHERE barangay_id = $brgy"
                                    );
                                    $stmt->execute();
                                    $users = $stmt->fetchAll();
                                    foreach ($users as $user) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $user['household_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['owner_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['size']; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <button name="<?php echo $user['household_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#viewModal<?php echo $user['household_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-info">
                                                        <i class='la la-eye'></i>
                                                    </button>
                                                    <button name="<?php echo $user['household_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#editModal<?php echo $user['household_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-primary">
                                                        <i class='la la-edit'></i>
                                                    </button>
                                                    <button name="<?php echo $user['household_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#deleteModal<?php echo $user['household_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-danger">
                                                        <i class='la la-trash'></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- View modal -->
                                        <div class="modal fade" id="viewModal<?php echo $user['household_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewHousehold">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title" id="viewHousehold">HOUSEHOLD INFORMATION</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="d-inline" style="width: 25%;"><Strong>Owner</Strong></p>
                                                                <p class="d-inline" style="width: 10%;">:</p>
                                                                <p class="d-inline" style="width: 59%;">
                                                                    <?php echo $user['owner_name']; ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="d-inline" style="width: 25%;"><Strong>Type of Household</Strong></p>
                                                                <p class="d-inline" style="width: 10%;">:</p>
                                                                <p class="d-inline" style="width: 59%;">
                                                                    <?php echo $user['type']; ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="d-inline" style="width: 25%;"><Strong>Tenure</Strong></p>
                                                                <p class="d-inline" style="width: 10%;">:</p>
                                                                <p class="d-inline" style="width: 59%;">
                                                                    <?php echo $user['tenure']; ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="d-inline" style="width: 25%;"><Strong>Size</Strong></p>
                                                                <p class="d-inline" style="width: 10%;">:</p>
                                                                <p class="d-inline" style="width: 59%;">
                                                                    <?php echo $user['size']; ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="d-inline" style="width: 25%;"><Strong>Income Level</Strong></p>
                                                                <p class="d-inline" style="width: 10%;">:</p>
                                                                <p class="d-inline" style="width: 59%;">
                                                                    <?php echo $user['income_level']; ?>
                                                                </p>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- View modal -->

                                        <!-- Edit modal -->
                                        <div class="modal fade" id="editModal<?php echo $user['household_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editHousehold">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title" id="editHousehold">EDIT HOUSEHOLD</h4>
                                                    </div>
                                                    <div class="card-body">

                                                        <form role="form" method="post" action="<?php echo APPURL ?>/updates-btn/editHousehold.php">
                                                            <input type="hidden" name="household_id" value="<?php echo $user['household_id']; ?>">
                                                            <div class="mb-1">
                                                                <input type="text" class="form-control" name="owner_name" readonly value="<?php echo $user['owner_name']; ?>">
                                                            </div>
                                                            <div class="mb-1">
                                                                <input type="number" class="form-control" value="<?php echo $user['size']; ?>" id="size" required name="size">
                                                            </div>
                                                            <div class="mb-1">
                                                                <select class="form-control" name="type" id="type" required>
                                                                    <option value="" selected disabled>Type of household</option>
                                                                    <option value="Nuclear Family">Nuclear Family</option>
                                                                    <option value="Single-person Household">Single-person Household</option>
                                                                    <option value="Extended Family">Extended Family</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-1">
                                                                <select class="form-control" name="tenure" id="tenure">
                                                                    <option value="" selected disabled>Tenure</option>
                                                                    <option value="Owned">Owned</option>
                                                                    <option value="Rent">Rent</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-1">
                                                                <select class="form-control" name="income_level" id="income_level">
                                                                    <option value="" selected disabled>Income Level</option>
                                                                    <option value="Rich">Rich: ₱219,140 and up</option>
                                                                    <option value="High income">High income: ₱131,484 to ₱219,140</option>
                                                                    <option value="Upper middle class">Upper middle class: ₱76,669 to ₱131,484</option>
                                                                    <option value="Middle class">Middle class: ₱43,828 to ₱76,669</option>
                                                                    <option value="Lower middle class">Lower middle class: ₱21,194 to ₱43,828</option>
                                                                    <option value="Low income">Low income: ₱10,957 to ₱21,194</option>
                                                                    <option value="Poor">Poor: Less than ₱10,957</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" name="update" class="btn btn-primary" style="width: 100%;">Update</button>
                                                        </form>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit modal -->

                                        <!-- Delete modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $user['household_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteHousehold">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title text-danger" id="deleteHousehold">DELETE HOUSEHOLD</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="text-center">Are you sure you want to delete <strong class="text-danger"><?php echo $user['owner_name']; ?></strong> from the households table?</h6>
                                                    </div>
                                                    <div class="text-center mb-1">
                                                        <form method="post" action="<?php echo APPURL ?>/deletes-btn/deleteHousehold.php">
                                                            <input type="hidden" name="household_id" value="<?php echo $user['household_id']; ?>">
                                                            <button type="submit" name="delete" class="btn btn-danger" style="width: 45%;">YES</button>
                                                            <button type="button" class="btn btn-secondary" style="width: 45%;" data-dismiss="modal">NO</button>
                                                        </form>
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