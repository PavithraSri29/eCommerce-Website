<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

 <div class="container-fluid px-4">
                        <h3 class="mt-4">Manage Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">User</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Users</h4>

                                    </div>
                                    <div class="card-body">
                                        <table id="cattable"class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>User Id</th>
                                                    <th>User Name</th>
                                                    <th>Email Id</th>
                                                    <th>DOB</th>
                                                    <th>Gender</th>
                                                    <th>Mobile No</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            <?php 
                            $query = $conn->query("SELECT * FROM users");
                            if ($query->num_rows > 0) {
                                foreach ($query as $row) { ?>
                                    <tr>
                                        <td><?= $row['user_id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['dob']; ?></td>
                                        <td><?= $row['gender']; ?></td>
                                        <td><?= $row['phoneno']; ?></td>
                                      
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="6">No Record Found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </div>

<?php  include ('includes/footer.php');
include ('includes/scripts.php');
?>