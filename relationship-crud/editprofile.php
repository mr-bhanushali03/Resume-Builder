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
    <div class="container">
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
                            while ($row = $result -> fetch_object()) {
                                echo "<option value = ".$row -> id.">".$row -> name."</option>"; 
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
            </div>
        </div>
    </div>
</main>
<script>
    function loadstates(countryID){
        let url = "<?php echo BASEURL; ?>formdata/states.php?country="+countryID;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('stateInput').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET",url,true);
        xhttp.send();
    }
</script>
<?php
include('footer.php');
?>