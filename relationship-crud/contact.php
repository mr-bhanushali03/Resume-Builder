<?php
$title = 'Contact';
include('header.php');
?>
<main>
  <div class="container-fluid py-5" id="contact-form">
    <h1>Contact Us</h1>
    <div class="form">
      <form action="contact.html" onsubmit="return validate()" method="post" class="row col-sm-3 col-md-8 col-lg-3"  >
        <label>Name
          <input type="text" class="form-control" name="name" id="name" autocomplete="off" />
        </label>
        <label>
          Mobile
          <input type="tel" class="form-control" name="mobile" id="mobile" autocomplete="off" />
        </label>
        <label>
          Email
          <input type="email" class="form-control" name="email" id="email" autocomplete="off" />
        </label>
        <label>
          Message
          <textarea name="message" class="form-control" name="message" id="message" autocomplete="off"></textarea>
        </label>
        <input type="submit" value="Submit" class="btn w-35" style="margin-left: 10px;" />
      </form>
    </div>
  </div>
</main>
<?php 
  include('footer.php');
?>