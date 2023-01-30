<?php
session_start();
$title = 'Home';
include("header.php");
?>
<main>
  <div id="title">
    <h1 class="text-center py-4">Resume Maker</h1>
  </div>
  <div class="featured">
    <div class="container-fluid ps-5">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
        <img src="images/henil.jpeg" alt="" class="w-75" />
        </div>
        <div class="col-lg-8 col-md-6 col-sm-6">
          <h2>Welcome to web Development Courses</h2>
          <p>HTML, CSS, Javascript, PHP etc</p>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</main>
<?php 
  include('footer.php');
?>