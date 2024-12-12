<?php require("config/config.php") ?>

<?php require("include/header.php"); ?>
<?php require("include/residents/sidebar.php"); ?>


<!-- Input data to database -->
<?php
if (isset($_POST['submit'])) {
    $barangay_id = $_SESSION['barangay_id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['civil_status'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $other_details = $_POST['other_details'];
    $insert = $conn->prepare("INSERT INTO resident( barangay_id, last_name, first_name, middle_name, birthdate, age, birthplace, sex, civil_status, address, contact_number, other_details) VALUES (:barangay_id, :last_name, :first_name, :middle_name, :birthdate, :age, :birthplace, :sex, :civil_status, :address, :contact_number, :other_details)");
    $insert->execute([
        ":barangay_id" => $barangay_id,
        ":last_name" => $last_name,
        ":first_name" => $first_name,
        ":middle_name" => $middle_name,
        ":birthdate" => $birthdate,
        ":age" => $age,
        ":birthplace" => $birthplace,
        ":sex" => $sex,
        ":civil_status" => $civil_status,
        ":address" => $address,
        ":contact_number" => $contact_number,
        ":other_details" => $other_details,
    ]);
}
?>
<!-- Input data to database -->

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">RESIDENTS</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo APPURL ?>/index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Residents
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
                                    <h2 class="card-title m-1">Residents Table</h2>
                                    <button type="button" data-toggle="modal" data-target="#addNew" data-whatever="@getbootstrap" class="btn btn-success btn-sm add-new card-title m-1"><i class="la la-plus-circle"></i></button>
                                </div>
                            </div>

                            <!-- Add resident modal -->
                            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="card-header text-center mt-1">
                                            <h4 class="card-title" id="exampleModalLabel">ADD NEW RESIDENTS</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="residents.php">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <input type="text" class="form-control d-inline" style="width: 33%;" placeholder="Last name" id="last_name" required name="last_name">
                                                    <input type="text" class="form-control d-inline" style="width: 33%;" placeholder="First name" id="first_name" required name="first_name">
                                                    <input type="text" class="form-control d-inline" style="width: 33%;" placeholder="Middle name" id="middle_name" required name="middle_name">
                                                </div>
                                                <div class="d-flex justify-content-between mb-1">
                                                    <input type="date" id="birthdate" name="birthdate" class="form-control d-inline" style="width: 25%;">
                                                    <input type="text" class="form-control d-inline" style="width: 74%;" placeholder="Place of Birth" id="birthplace" required name="birthplace">
                                                </div>
                                                <div class="d-flex justify-content-between mb-1">
                                                    <input type="number" class="form-control d-inline" style="width: 25%;" placeholder="Age" id="age" required name="age">
                                                    <select class="form-control d-inline" style="width: 25%;" name="sex" id="sex">
                                                        <option value="" selected disabled>Sex</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <select class="form-control d-inline" style="width: 49%;" name="civil_status" id="civil_status">
                                                        <option value="" selected disabled>Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Legally Separated">Legally Separated</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <input type="email" class="form-control" placeholder="Email address" id="address" required name="address" aria-describedby="emailHelp">
                                                </div>
                                                <div class="mb-1">
                                                    <input type="number" class="form-control" placeholder="Contact number" id="contact_number" required name="contact_number">
                                                </div>
                                                <div class="mb-1">
                                                    <textarea class="form-control" placeholder="Other details (optional)" rows="3" id="other_details" name="other_details"></textarea>
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
                            <!-- add resident modal -->

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                        <tr>
                                            <th>ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Action</th>
                                        </tr>

                                        <!-- fetch data from database to resident table -->
                                        <?php
                                        $brgy = $_SESSION['barangay_id'];
                                        $stmt = $conn->prepare(
                                            "SELECT * FROM resident WHERE barangay_id = $brgy"
                                        );
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $user) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $user['resident_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['last_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['first_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['middle_name']; ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <button name="<?php echo $user['resident_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#viewModal<?php echo $user['resident_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-info">
                                                            <i class='la la-eye'></i>
                                                        </button>
                                                        <button name="<?php echo $user['resident_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#editModal<?php echo $user['resident_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-primary">
                                                            <i class='la la-edit'></i>
                                                        </button>
                                                        <button name="<?php echo $user['resident_id']; ?>" style="width: 30%;" type="button" data-toggle="modal" data-target="#deleteModal<?php echo $user['resident_id']; ?>" data-whatever="@getbootstrap" class="btn btn-sm btn-danger">
                                                            <i class='la la-trash'></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- fetch data from database to resident table -->

                                            <!-- View modal -->
                                            <div class="modal fade" id="viewModal<?php echo $user['resident_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewResident">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="card-header text-center mt-1">
                                                            <h4 class="card-title" id="viewResident">PERSONAL INFORMATION</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Name</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Date of Birth</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['birthdate']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Age</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['age']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Place of Birth</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['birthplace']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Sex</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['sex']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Civil Status</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['civil_status']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Email</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['address']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Contact Number</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['contact_number']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <p class="d-inline" style="width: 15%;"><Strong>Other Details</Strong></p>
                                                                    <p class="d-inline" style="width: 10%;">:</p>
                                                                    <p class="d-inline" style="width: 69%;">
                                                                        <?php echo $user['other_details']; ?>
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
                                            <div class="modal fade" id="editModal<?php echo $user['resident_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editResident">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="card-header text-center mt-1">
                                                            <h4 class="card-title" id="editResident">EDIT RESIDENT</h4>
                                                        </div>
                                                        <div class="card-body">

                                                            <form role="form" method="post" action="<?php echo APPURL ?>/updates-btn/editResident.php">
                                                                <input type="hidden" name="resident_id" value="<?php echo $user['resident_id']; ?>">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <input type="text" class="form-control d-inline" style="width: 33%;" placeholder="Last name" id="last_name" required name="last_name" value="<?php echo $user['last_name']; ?>">
                                                                    <input type="text" class="form-control d-inline" style="width: 33%;" placeholder="First name" id="first_name" required name="first_name" value="<?php echo $user['first_name']; ?>">
                                                                    <input type="text" class="form-control d-inline" style="width: 33%;" placeholder="Middle name" id="middle_name" required name="middle_name" value="<?php echo $user['middle_name']; ?>">
                                                                </div>
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <input type="date" id="birthdate" name="birthdate" class="form-control d-inline" style="width: 25%;" value="<?php echo $user['birthdate']; ?>">
                                                                    <input type="text" class="form-control d-inline" style="width: 74%;" placeholder="Place of Birth" id="birthplace" required name="birthplace" value="<?php echo $user['birthplace']; ?>">
                                                                </div>
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <input type="number" class="form-control d-inline" style="width: 25%;" placeholder="Age" id="age" required name="age" value="<?php echo $user['age']; ?>">
                                                                    <select class="form-control d-inline" style="width: 25%;" name="sex" id="sex">
                                                                        <option value="" selected disabled>Sex</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                    <select class="form-control d-inline" style="width: 49%;" name="civil_status" id="civil_status">
                                                                        <option value="" selected disabled>Civil Status</option>
                                                                        <option value="Single">Single</option>
                                                                        <option value="Married">Married</option>
                                                                        <option value="Widowed">Widowed</option>
                                                                        <option value="Legally Separated">Legally Separated</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <input type="email" class="form-control" placeholder="Email address" id="address" required name="address" aria-describedby="emailHelp" value="<?php echo $user['address']; ?>">
                                                                </div>
                                                                <div class="mb-1">
                                                                    <input type="number" class="form-control" placeholder="Contact number" id="contact_number" required name="contact_number" value="<?php echo $user['contact_number']; ?>">
                                                                </div>
                                                                <div class="mb-1">
                                                                    <textarea class="form-control" placeholder="Other details (optional)" rows="3" id="other_details" name="other_details"><?php echo $user['other_details']; ?></textarea>
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
                                            <div class="modal fade" id="deleteModal<?php echo $user['resident_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteResident">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="card-header text-center mt-1">
                                                            <h4 class="card-title text-danger" id="deleteResident">DELETE RESIDENT</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="text-center">Are you sure you want to delete <strong class="text-danger"><?php echo $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']; ?></strong> from the residents table?</h6>
                                                        </div>
                                                        <div class="text-center mb-1">
                                                            <form method="post" action="<?php echo APPURL ?>/deletes-btn/deleteResident.php">
                                                                <input type="hidden" name="resident_id" value="<?php echo $user['resident_id']; ?>">
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