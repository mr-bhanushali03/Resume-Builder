<?php
error_reporting(0);
session_start();
$title = 'My Account';
include("header.php");
?>
<main>
    <div id="title">
        <h1 class="text-center py-2">My Account</h1>
        <?php
        include('inc/connect.php');
        if (isset($_POST['submit'])) {
            $error = false;
            if ($_FILES['image']['size'] >= 500000) {
                $error = true;
                echo $message = "<div class = 'container text-danger mb-3'>File size is greater than 5Mb</div>";
            }
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check == false) {
                $error = true;
                echo $message = "<div class = 'container text-danger mb-3'>Please upload your Image</div>";
            }
            $imagefiletype = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));
            if (!$error) {
                $filepath = 'uploads/' . $_SESSION['user'] . time() . "." . $imagefiletype;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)) {
                    $sql = "UPDATE user SET image = '" . $filepath . "' WHERE id = '" . $_SESSION['user'] . "'";
                    $con->query($sql);
                } else {
                    echo $message = "<div class = 'container text-danger mb-3'>Image not uploaded</div>";
                }
            }
        }

        //user select data query
        $sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user'] . "'";
        $result = $con->query($sql);
        if (is_object($result) && ($result->num_rows > 0)) {
            while ($row = $result->fetch_object()) {
                $user = $row;
            }
        }

        //qualification select data query
        $qualification = "SELECT * FROM qualification WHERE user_id = '" . $_SESSION['user'] . "'";
        $qualificationresult = $con->query($qualification);
        if (is_object($qualificationresult) && ($qualificationresult->num_rows > 0)) {
            while ($row = $qualificationresult->fetch_object()) {
                $qualificationresultuser = $row;
            }
        }

        //company select data query
        $company = "SELECT * FROM company WHERE user_id = '" . $_SESSION['user'] . "'";
        $companyresult = $con->query($company);
        if (is_object($companyresult) && ($companyresult->num_rows > 0)) {
            while ($row = $companyresult->fetch_object()) {
                $companyresultuser = $row;
            }
        }

        // Give permission to user 
        $sqlp = "SELECT user.name,role.role,permission.permission FROM user,role,permission,Permission_role WHERE user.role_id=role.id AND Permission_role.role_id=role.id AND Permission_role.permission_id=permission.id AND user.id='" . $_SESSION['user'] . "'";
        $resultp = $con->query($sqlp);
        $permission = array();
        while ($row = $resultp->fetch_object()) {
            $permission[] = $row->permission;
        }
        $con->close();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-5">
                    <?php if ($user->image == null) { ?>
                        <img class="w-100 rounded col-sm-12 col-md-12 collg-3" src="<?php echo BASEURL; ?>images/user.png" alt="default-profile">
                    <?php } else { ?>
                        <img class="w-100 rounded col-sm-12 col-md-12 collg-3" src="<?php echo BASEURL . $user->image; ?>" alt="profile">
                    <?php }; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" id="" class="form-control mt-2">
                        <input type="submit" value="Upload" class="btn btn-primary mt-2" name="submit">
                    </form>
                </div>
                <div class="col-md-9">
                    <a href="editprofile.php" class="btn btn-primary float-end ms-2 mb-2">Edit Profile</a>
                    <a href="print.php" class="btn btn-info float-end mb-2">Print Resume</a>
                    <?php
                    // if (in_array('create_resume', $permission)) {
                    //     echo '<a href="create.php" class="btn btn-secondary float-end me-2">Create Resume</a>';
                    // }
                    if (in_array('send_message', $permission)) {
                        echo '<a href="chat.php" class="btn btn-secondary float-end me-2">Chat</a>';
                    }
                    ?>
                    <table class="table table-striped">
                        <tr>
                            <th colspan="3">Personal Details</th>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td colspan="3"><?php echo $user->name; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td colspan="3"><?php echo $user->email; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td colspan="3"><?php echo $user->gender; ?></td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td colspan="3"><?php echo $user->dob; ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">Educational Qualifications</th>
                        </tr>
                        <tr>
                            <th>Qualifications</th>
                            <th>Year</th>
                            <th>Percentage</th>
                        </tr>
                        <tr>
                            <td><?php echo $qualificationresultuser->qualification; ?></td>
                            <td><?php echo $qualificationresultuser->year; ?></td>
                            <td><?php echo $qualificationresultuser->percentage; ?></td>
                        </tr>
                        <tr>
                            <th colspan="3">Work Experience</th>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <th>Position</th>
                            <th>Time</th>
                        </tr>
                        <tr>
                            <td><?php echo $companyresultuser->name; ?></td>
                            <td><?php echo $companyresultuser-> role; ?></td>
                            <td><?php echo $companyresultuser-> time; ?></td>
                        </tr>
                        <tr>
                            <th colspan="3">Other Details</th>
                        </tr>
                        <tr>
                            <td>language</td>
                            <td colspan="3"><?php echo $user->language; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include('footer.php');
?>