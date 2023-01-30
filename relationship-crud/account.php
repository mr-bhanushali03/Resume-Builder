<?php
session_start();
$title = 'My Account';
include("header.php");
?>
<main>
    <div id="title">
        <h1 class="text-center py-5">My Account</h1>
        <?php
        include('inc/connect.php');
        if (isset($_POST['submit'])) {
            $error = false;
            if($_FILES['image']['size'] >= 500000){
                $error = true;
                echo $message = "<div class = 'container text-danger mb-3'>File size is greater than 5Mb</div>";
            }
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check == false) {
                $error = true;
                echo $message = "<div class = 'container text-danger mb-3'>Please upload your Image</div>";
            }
            $imagefiletype = strtolower(pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION));
            if (!$error) {
                $filepath = 'uploads/'.$_SESSION['user'].time().".".$imagefiletype;
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)){
                    $sql = "UPDATE user SET image = '".$filepath."' WHERE id = '" . $_SESSION['user'] . "'";
                    $con->query($sql);  
                }else{
                    echo $message = "<div class = 'container text-danger mb-3'>Image not uploaded</div>";
                }
            }
        }
        $sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user'] . "'";
        $result = $con->query($sql);
        if (is_object($result) && ($result->num_rows > 0)) {
            while ($row = $result->fetch_object()) {
                $user = $row;
            }
        }
        $con->close();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
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
                    <table class="table table-striped">
                        <tr>
                            <th colspan="2">Personal Details</th>
                        </tr>
                        <tr>
                            <td>Name :- </td>
                            <td><?php echo $user->name; ?></td>
                        </tr>
                        <tr>
                            <td>Email :- </td>
                            <td><?php echo $user->email; ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">Educational Qualifications</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2">Work Experience</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2">Other Details</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
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