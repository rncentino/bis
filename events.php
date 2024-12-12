<?php require("config/config.php") ?>

<?php require("include/header.php"); ?>
<?php require("include/events/sidebar.php"); ?>


<!-- Input data to database -->
<?php
if (isset($_POST['submit'])) {
    if (
        empty($_POST['project_name']) or
        empty($_POST['project_description']) or
        empty($_POST['duration']) 
    ) {
        // echo "<script>alert()'One or more inputs are empty!'</script>";
    } else {
        $barangay_id = $_SESSION['barangay_id'];
        $project_name = $_POST['project_name'];
        $project_description = $_POST['project_description'];
        $duration = $_POST['duration'];
        $other_details = $_POST['other_details'];
        $insert = $conn->prepare("INSERT INTO project_and_events( barangay_id, project_name, project_description, duration, other_details) VALUES (:barangay_id, :project_name, :project_description, :duration, :other_details)");
        $insert->execute([
            ":barangay_id" => $barangay_id,
            ":project_name" => $project_name,
            ":project_description" => $project_description,
            ":duration" => $duration,
            ":other_details" => $other_details,
        ]);
        // header("location: ".APPURL."/events.php");
    }
}
?>
<!-- Input data to database -->

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">PROJECTS AND EVENTS</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo APPURL ?>/index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Projects and Events
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
                                    <h2 class="card-title m-1">Projects and Events Table</h2>
                                    <button type="button" data-toggle="modal" data-target="#addNew" data-whatever="@getbootstrap" class="btn btn-sm btn-success add-new card-title m-1"><i class="la la-plus-circle"></i></button>
                                </div>
                            </div>

                            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="card-header text-center mt-1">
                                            <h4 class="card-title" id="exampleModalLabel">ADD NEW PROJECTS OR EVENTS</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" method="post" action="events.php">
                                                <div class="mb-1">
                                                    <input type="text" class="form-control" placeholder="Project or event name" id="project_name" required name="project_name">
                                                </div>
                                                <div class="mb-1">
                                                    <input type="text" class="form-control" placeholder="Description" id="project_description" required name="project_description">
                                                </div>
                                                <div class="mb-1">
                                                    <input type="number" class="form-control" placeholder="Duration (by days)" id="duration" required name="duration">
                                                </div>
                                                <div class="mb-1">
                                                    <textarea class="form-control" placeholder="Enter other details (optional)" rows="3" id="other_details" name="other_details"></textarea>
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
                                            <th>Project/Event Name</th>
                                            <th>Description</th>
                                            <th>Start at</th>
                                            <th>Duration (days)</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- fetch data from database to resident table -->
                                        <?php
                                        $a = 1;
                                        $brgy = $_SESSION['barangay_id'];
                                        $stmt = $conn->prepare(
                                            "SELECT * FROM project_and_events WHERE barangay_id = $brgy"
                                        );
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $user) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $user['project_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['project_description']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['start_date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['duration']; ?>
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
                                        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewEvent">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title" id="viewEvent">VIEW PROJECT/EVENT</h4>
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
                                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editEvent">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title" id="editEvent">EDIT PROJECT/EVENT</h4>
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
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteEvent">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header text-center mt-1">
                                                        <h4 class="card-title text-danger" id="deleteEvent">DELETE PROJECT/EVENT</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6 class="text-center">Are you sure you want to delete this project/event?</h6>
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