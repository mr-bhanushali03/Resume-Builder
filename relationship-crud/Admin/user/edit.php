<?php
session_start();
include('../../inc/contants.php');
if (!isset($_SESSION['user'])) {
    header("location: login.php");
}
if ($_SESSION['role'] != 'Admin') {
    header("location: login.php");
}
$title = "Admin";
include('../../inc/connect.php');


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $sql = "UPDATE user SET name ='$name', email = '$email' WHERE id = $user";
    $result = mysqli_query($con, $sql);
    header('location: ../users.php');
}

$sql = "SELECT id, name, email FROM user WHERE id =".$_GET['user'];
$result = mysqli_query($con, $sql);
while ($obj = $result ->fetch_object()) {
    $user = $obj;
}

include('../header.php');
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit User - <?php echo $user-> name; ?></h1>
    <form action="edit.php?user=<?php echo $user-> id; ?>" method="POST">
        <input type="hidden" name="user" value="<?php echo $user-> id; ?>">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" id="" class="form-control" value="<?php echo $user-> name; ?>">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" id="" class="form-control" value="<?php echo $user-> email; ?>">
        </div>
        <input type="submit" value="Update" class="btn btn-primary" name="submit">
    </form>
</div>
<?php
include('../footer.php');
?>
