<?php
session_start();
include('../inc/connect.php');
$sql = "SELECT id, name FROM states WHERE country_id = $_GET[country]";
$result = $con->query($sql);

$update = "SELECT * FROM user WHERE id = '" . $_SESSION['user'] . "'";
$resultUpdate = $con->query($update);
if (is_object($result) && ($resultUpdate->num_rows > 0)) {
    while ($row = $resultUpdate->fetch_object()) {
        $user = $row;
    }
}
?>

 <label for="" class="form-label">State</label>
<select class="form-select" name="state" required>
    <option selected>Select State</option>
    <?php
    while ($row = $result->fetch_object()) {
        ?>
            <option <?php if ($row->id == $user->state_id) { echo 'selected'; }  ?> value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
        <?php
        // echo "<option value = " . $row->id . ">" . $row->name . "</option>";
    }
    ?>
</select>