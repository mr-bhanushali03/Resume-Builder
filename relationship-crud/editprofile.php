<?php
session_start();
$title = 'Edit Profile';
include("header.php");
?>
<main>
    <div id="title">
        <h1 class="text-center py-5"><?php echo $title; ?></h1>
        <?php
        include('inc/connect.php');
        if (isset($_POST['submit'])) {
            print_r($_POST);
        }
        $sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user'] . "'";
        $result = $con->query($sql);
        if (is_object($result) && ($result->num_rows > 0)) {
            while ($row = $result->fetch_object()) {
                $user = $row;
            }
        }

        $sql = "SELECT id, name FROM countries";
        $result = $con->query($sql);
        $con->close();
        ?>
    </div>
    <div class="container-fluid">
        <form action="" method="post">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                    </div>
                    <h5>Address Details</h5>
                    <div class="mb-3">
                        <label for="" class="form-label">Countries</label>
                        <select class="form-select" name="country" onchange="loadstates(this.value)" required>
                            <option selected>Select country</option>
                            <?php
                            while ($row = $result->fetch_object()) {
                                echo "<option value = " . $row->id . ">" . $row->name . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3" id="stateInput">
                        <label for="" class="form-label">State</label>
                        <select class="form-select" name="state" required>
                            <option selected>Select State</option>
                        </select>
                    </div>
                    <div class="row col-12">
                        <div class="mb-3 col-6" id="">
                            <label for="" class="form-label">Languages Known</label>
                            <?php
                            $languages = array("English", "Hindi", "Gujarati");
                            foreach ($languages as $lang) {
                                echo '<div class="form-check">
                                        <input type="checkbox" name="languages[]" id="' . $lang . '" value="' . $lang . '" class="form-check-input">
                                        <label for="' . $lang . '" class="form-check-label">' . $lang . '</label>
                                    </div>';
                            }
                            ?>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label">Gender</label>
                            <div class="form-check">
                                <input type="radio" name="flexRadioDefault" id="male" value="Male" class="form-check-input">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="flexRadioDefault" id="female" value="Female" class="form-check-input">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date Of Birth</label>
                        <input type="date" name="dob" id="dob" placeholder="Date Of Birth" class="form-control">
                    </div>
                    <h5>Educational Qualification</h5>
                    <div class="row" id="qualificationInput">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Year</label>
                                <input type="text" name="year[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Percent/Marks</label>
                                <input type="text" name="percent[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <a class="float-end btn btn-info" onclick="addQualification()">Add More</a>
                    <div class="clearfix"></div>
                    <input type="submit" value="submit" class="btn btn-primary" name="submit">
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    function loadstates(countryID) {
        let url = "<?php echo BASEURL; ?>formdata/states.php?country=" + countryID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('stateInput').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }

    var qualificationHtml = document.getElementById('qualificationInput').innerHTML;
    function addQualification(){
        document.getElementById('qualificationInput').innerHTML+=qualificationHtml;
    }
</script>
<?php
include('footer.php');
?>