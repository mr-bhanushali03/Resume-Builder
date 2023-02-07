<?php
error_reporting(0);
session_start();
$title = 'Edit Profile';
include("header.php");
?>
<main>
    <a href="account.php"><button class="btn btn-primary mt-2 ms-2" name="back"><i class="fa fa-arrow-left " aria-hidden="true"></i>
            Back</button></a>
    <div id="title">
        <h1 class="text-center py-3"><?php echo $title; ?></h1>
        <?php
        include('inc/connect.php');
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $country = $_POST['country'];
            $state = $_POST['state'];
            $languages = implode(',', $_POST['languages']);
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $qualification = implode(',', $_POST['qualification']);
            $year = implode(',', $_POST['year']);
            $percent = implode(',', $_POST['percent']);
            $company = implode(',', $_POST['company']);
            $role = implode(',', $_POST['role']);
            $time = implode(',', $_POST['time']);
            // print_r($name,$country,$state,$languages,$gender,$dob,$qualification,$year,$percent,$company,$role,$time);
            // $update = "UPDATE user,qualification,company SET user.name='$name',user.country_id=$country,user.state_id=$state,user.language='$languages',user.gender='$gender',user.dob='$dob',qualification.qualification='$qualification',qualification.year=$year,qualification.percentage=$percent,company.name='$company',company.role='$role',company.time='$time' WHERE user.qualification_id=qualification.id AND user.company_id=company.id AND user.id= '" . $_SESSION['user'] . "'";

            $update = "UPDATE user SET user.name = '$name',user.dob='$dob',user.gender='$gender',user.language='$languages',user.country_id='$country',user.state_id='$state' WHERE user.id = '$_SESSION[user]'";
            $userUpdate = $con->query($update);

            $update = "UPDATE `qualification` SET `qualification`='$qualification',`year`='$year',`percentage`='$percent' WHERE user_id = '$_SESSION[user]'";
            $qualificationUpdate = $con->query($update);

            $update = "UPDATE `company` SET `name`='$company',`role`='$role',`time`='$time' WHERE user_id = '$_SESSION[user]'";
            $companyUpdate = $con->query($update);

            if ($userUpdate && $qualificationUpdate && $companyUpdate) {
                header('location: account.php');
            }
        }

        $sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user'] . "'";
        $result = $con->query($sql);
        if (is_object($result) && ($result->num_rows > 0)) {
            while ($row = $result->fetch_object()) {
                $user = $row;
            }
        }

        $qualification = "SELECT * FROM qualification WHERE user_id = '" . $_SESSION['user'] . "'";
        $qualificationresult = $con->query($qualification);
        if (is_object($qualificationresult) && ($qualificationresult->num_rows > 0)) {
            while ($row = $qualificationresult->fetch_array()) {
                $qualificationresultuser = $row;
            }
        }

        $company = "SELECT * FROM company WHERE user_id = '" . $_SESSION['user'] . "'";
        $companyresult = $con->query($company);
        if (is_object($companyresult) && ($companyresult->num_rows > 0)) {
            while ($row = $companyresult->fetch_array()) {
                $companyresultuser = $row;
            }
        }

        $sql = "SELECT id, name FROM countries";
        $result = $con->query($sql);
        $con->close();
        ?>
    </div>
    <div class="container-fluid px-5">
        <form method="post">
            <div class="row">
                <div class="col-6">
                    <h5>Personal Details</h5>
                    <div class="mb-3">
                        <label for="" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" value="<?php echo $user->name ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <h5>Address Details</h5>
                    <div class="mb-3">
                        <label for="" class="form-label">Countries</label>
                        <select class="form-select" name="country" onchange="loadstates(this.value)" required>
                            <option selected>Select country</option>
                            <?php
                            while ($row = $result->fetch_object()) {
                            ?>
                                <option <?php if ($row->id == $user->country_id) {
                                            echo 'selected';
                                        }  ?> value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                            <?php
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
                            $languagesArray = explode(' ', $user->language);
                            $languages = array("English", "Hindi", "Gujarati");
                            foreach ($languages as $lang) {
                            ?>
                                <div class="form-check">
                                    <input type="checkbox" id="<?php echo $lang; ?>" value="<?php echo $lang; ?>" name="languages[]" <?php if (in_array($lang, $languagesArray)) { ?> checked <?php } ?> class="form-check-input">
                                    <label for="<?php echo $lang; ?>" class="form-check-label"><?php echo $lang; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label">Gender</label>
                            <div class="form-check">
                                <input type="radio" name="gender" id="male" value="Male" <?php if ($user->gender == 'Male') {
                                                                                                echo 'checked';
                                                                                            } ?> class="form-check-input">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" id="female" value="Female" <?php if ($user->gender == 'Female') {
                                                                                                    echo 'checked';
                                                                                                } ?> class="form-check-input">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date Of Birth</label>
                        <input type="date" name="dob" id="dob" value="<?php echo $user->dob; ?>" placeholder="Date Of Birth" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <h5>Educational Qualification</h5>
                    <?php
                    $degree = explode(',', $qualificationresultuser['qualification']);
                    $year = explode(',', $qualificationresultuser['year']);
                    $percentage = explode(',', $qualificationresultuser['percentage']);
                    ?>


                    <div id="qualificationInput">
                        <?php

                        for ($i = 0; $i < count($degree); $i++) {
                        ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Qualification</label>
                                        <input type="text" name="qualification[]" value="<?php echo $degree[$i]; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="year[]" value="<?php echo $year[$i]; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Percent/Marks</label>
                                        <input type="text" name="percent[]" value="<?php echo $percentage[$i]; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <a class="float-end btn btn-info" id="addQualification">Add More</a>
                    <div class="clearfix"></div>
                    <h5>Work Experience</h5>
                    <?php
                    $name = explode(',', $companyresultuser['name']);
                    $role = explode(',', $companyresultuser['role']);
                    $time = explode(',', $companyresultuser['time']);
                    ?>
                    <div class="justify-content-center" id="workInput">
                        <?php

                        for ($i = 0; $i < count($name); $i++) {
                        ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Company</label>
                                        <input type="text" name="company[]" value="<?php echo $name[$i]; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <input type="text" name="role[]" value="<?php echo $role[$i]; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Year/Month</label>
                                        <input type="text" name="time[]" value="<?php echo $time[$i]; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <a class="float-end btn btn-info" id="addworkexperience">Add More</a>
                    <div class="clearfix"></div>
                    <input type="submit" value="submit" class="btn btn-primary" name="submit">
                </div>
            </div>
        </form>
    </div>
</main>
<script src="jquery-3.6.3.js"></script>
<script>
    window.addEventListener('load', function() {
        loadstates(<?php echo $user->country_id; ?>);
    });

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
    var qualificationHtml = "<div class='row'><div class='col-md-4'><div class='mb-3'><label class='form-label'>Qualification</label>             <input type='text' name='qualification[]' class='form-control' /></div></div>     <div class='col-md-4'>         <div class='mb-3'>             <label class='form-label'>Year</label>             <input type='text' name='year[]' class='form-control' />         </div>     </div>     <div class='col-md-4'>         <div class='mb-3'>             <label class='form-label'>Percent/Marks</label>             <input type='text' name='percent[]' class='form-control' />         </div>     </div> </div>";

    $('#addQualification').click(function() {
        $('#qualificationInput').append(qualificationHtml);
    });

    var workInput = "<div class='row'>     <div class='col-md-4'>         <div class='mb-3'>             <label class='form-label'>Company</label>             <input type='text' name='company[]' class='form-control'>         </div>     </div>     <div class='col-md-4'>         <div class='mb-3'>             <label class='form-label'>Role</label>             <input type='text' name='role[]' class='form-control'>         </div>     </div>     <div class='col-md-4'>         <div class='mb-3'>             <label class='form-label'>Year/Month</label>             <input type='text' name='time[]' class='form-control'>         </div>     </div> </div>";

    $('#addworkexperience').click(function() {
        $('#workInput').append(workInput);
    });
</script>
<?php
include('footer.php');
?>