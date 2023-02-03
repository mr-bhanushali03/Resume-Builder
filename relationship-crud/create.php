<?php
session_start();
$title = 'Create Resume';
include("header.php");
?>
<main>
    <div id="title">
        <h1 class="text-center py-5"><?php echo $title; ?></h1>
        <?php
        include('inc/connect.php');
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $country = $_POST['country'];
            $state = $_POST['state'];
            $languages = implode(',',$_POST['languages']);
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $qualification = implode(',',$_POST['qualification']);
            $year = implode(',',$_POST['year']);
            $percent = implode(',',$_POST['percent']);
            $company = implode(',',$_POST['company']);
            $role = implode(',',$_POST['role']);
            $time = implode(',',$_POST['time']);
            // print_r($name,$country,$state,$languages,$gender,$dob,$qualification,$year,$percent,$company,$role,$time);

            $update ="UPDATE user SET user.name = '$name',user.dob='$dob',user.gender='$gender',user.language='$languages',user.country_id='$country',user.state_id='$state' WHERE user.id = '$_SESSION[user]'";
            // $insert = "INSERT INTO `user`(`id`,`name`, `language`, `gender`, `dob`, `state_id`, `country_id`) VALUES ('$_SESSION[user]','$name','$languages','$gender','$dob','$state','$country')";
            $userInsert= $con->query($update);
            
            // $update ="UPDATE `qualification` SET `qualification`='$qualification',`year`='$year',`percentage`='$percent' WHERE user_id = '$_SESSION[user]'";
            $insert = "INSERT INTO `qualification`(`user_id`,`qualification`, `year`, `percentage`) VALUES ('$_SESSION[user]','$qualification','$year','$percent')";
            $qualificationInsert= $con->query($insert);

            // $update = "UPDATE `company` SET `name`='$company',`role`='$role',`time`='$time' WHERE user_id = '$_SESSION[user]'";
            $insert = "INSERT INTO `company`(`user_id`,`name`, `role`, `time`) VALUES ('$_SESSION[user]','$company','$role','$time')";
            $companyInsert = $con->query($insert);

            if ($userInsert && $qualificationInsert && $companyInsert) {
                header('location: account.php');
            }
        }

        $sql = "SELECT id, name FROM countries";
        $result = $con->query($sql);
        $con->close();
        ?>
    </div>
    <div class="container-fluid">
        <form method="post">
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
                                <input type="radio" name="gender" id="male" value="Male" class="form-check-input">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="female" value="Female" class="form-check-input">
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
                    <h5>Work Experience</h5>
                    <div class="row justify-content-center" id="workInput">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Company</label>
                                <input type="text" name="company[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" name="role[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Year/Month</label>
                                <input type="text" name="time[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <a class="float-end btn btn-info" onclick="addworkexperience()">Add More</a>
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
        // document.getElementById('qualificationInput').innerHTML+=qualificationHtml;
        document.getElementById('qualificationInput').innerHTML+=qualificationHtml;
    }

    var workInput = document.getElementById('workInput').innerHTML;
    function addworkexperience(){
        document.getElementById('workInput').innerHTML+=workInput;
    }
</script>
<?php
include('footer.php');
?>