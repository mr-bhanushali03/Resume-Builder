<?php
$title = 'Login';
include('header.php');
include('inc/connect.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $passowrd = $_POST['password'];
    $sql = "SELECT * FROM user WHERE email = '$email' && password ='$passowrd'";
    $result = mysqli_query($con, $sql);
    if (is_object($result) && ($result->num_rows > 0)) {
        while ($row = $result->fetch_assoc()) {
            if ($row["password"] === $_POST['password']) {
                session_start();
                if (!isset($_SESSION['user'])) {
                    header("location: index.php");
                }
                $_SESSION['user'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
            }
        }
    } else {
?>
        <script>
            alert("Email and Password are doesn't match");
        </script>
<?php
    }
}
?>
<main>
    <div class="container-fluid p-5" id="contact-form">
        <h1><?php echo $title; ?></h1>
        <div class="form">
            <form action="login.php" onsubmit="return validate()" method="post" class="row col-sm-3 col-md-8 col-lg-3">
                <label>
                    Email
                    <input type="email" class="form-control" name="email" id="email" autocomplete="off" required />
                </label>
                <label>
                    Password
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" required />
                </label>
                <input type="submit" value="Login" class="btn btn-primary" name="submit" style="margin : 15px 0px 0px 15px; width : 100px;"/>
            </form>
        </div>
    </div>
</main>
<?php
include('footer.php');
?>