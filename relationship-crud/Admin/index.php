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
include('header.php');

include('../inc/connect.php');
$sql = "SELECT COUNT(id) as count, role FROM user GROUP BY role";
$result = mysqli_query($con, $sql);

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo $row['role'] . "-" . $row['count'] . "<br>";
    }
    ?>
</div>
<?php
include('footer.php');
?>