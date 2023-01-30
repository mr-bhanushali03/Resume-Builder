<?php
session_start();
include('../inc/contants.php');
if (!isset($_SESSION['user'])) {
    header("location: login.php");
}
if ($_SESSION['role'] != 'Admin') {
    header("location: login.php");
}
$title = "Admin";
include('../inc/connect.php');
$sql = "SELECT * FROM user";
if (isset($_GET['search'])) {
   $sql .= " WHERE name LIKE '%".$_GET['search']."%' OR email LIKE '%".$_GET['search']."%'";
}
$result = mysqli_query($con, $sql);

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $sql = "DELETE FROM user WHERE id = $delete";
    $result = mysqli_query($con, $sql);
    header('location: users.php');
}

include('header.php');
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Users</h1>
    <form action="" method="GET"">
    <div class=" form-group">
        <input type="text" name="search" id="" class="form-control" placeholder="Search here">
</div>
<input type="submit" value="Search" class="btn btn-primary btn-sm">
</form>

<table class="table table-bordered table-striped">
    <tr style="background-color: #3e64d3; color: #d6def7">
        <th>Sr no.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    $n = 1;
    while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $n; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="user/edit.php?user=<?php echo $row['id']; ?>"><button class="btn btn-primary font-weight-bold"><i class="fas fa-edit pr-2"></i>Update</button></a>
                <a href="users.php?delete=<?php echo $row['id']; ?>"><button class="btn btn-danger font-weight-bold"><i class="fas fa-trash-alt pr-2"></i>Delete</button></a>
            </td>
        </tr>
    <?php
        $n++;
    }
    ?>
</table>
</div>
<?php
include('footer.php');
?>