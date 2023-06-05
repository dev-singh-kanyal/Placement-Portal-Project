<?php

session_start();

if (isset($_SESSION['id_user']) || isset($_SESSION['id_coordinator'])) {
  header("Location: index.php");
  exit();
}
require_once("db.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Placement Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>

</style>

<body class="hold-transition skin-green sidebar-mini">

  <?php
  include 'uploads/register_page_header.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper">
    <div class=" content-wrapper" style="margin-left: 0px;">

      <section class="content-header">
        <div class="container">
          <div class="row latest-job margin-top-50 margin-bottom-20 bg-white">
            <h3 class="text-center margin-bottom-20">Create Your Profile</h3>
            <form method="post" id="registerCandidates" action="adduser.php" enctype="multipart/form-data">
              <div class="col-md-6 latest-job ">
                <div class="form-group">
                  <input class="form-control input-lg" type="text" id="fname" name="fname" placeholder="First Name *"
                    required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" id="lname" name="lname" placeholder="Last Name *"
                    required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" id="email" name="email" placeholder="Email *"
                    required>
                </div>
                <!-- <div class="form-group">
                  <textarea class="form-control input-lg" rows="4" id="aboutme" name="aboutme" placeholder="Brief intro about yourself *" required></textarea>
                </div> -->
                <div class="form-group">
                  <label>Date Of Birth</label>
                  <input class="form-control input-lg" type="date" id="dob" min="1960-01-01" max="2023-01-31" name="dob"
                    placeholder="Date Of Birth">
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" id="age" name="age" placeholder="Age" readonly>
                </div>
                <div class="form-group">
                  <label>Passing Year</label>
                  <input class="form-control input-lg" type="date" id="passingyear" name="passingyear"
                    placeholder="Passing Year">
                </div>

                <div class="form-group">
                  <!-- <input class="form-control input-lg" type="text" id="stream" name="stream" placeholder="B.Tech Stream"> -->
                  <label for="stream">B.Tech Stream</label>
                  <select name="stream" id="stream" class="form-control">
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="CE">CE</option>
                    <option value="ME">ME</option>
                    <option value="EE">EE</option>
                  </select>
                </div>
                 <div class="form-group">
                  <!-- <input class="form-control input-lg" type="text" id="stream" name="stream" placeholder="B.Tech Stream"> -->
                  <label for="stream">Gender</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="Marks">HSC Marks</label>
                  <input type="text" class="form-control input-lg" id="Marks" name="hsc" placeholder="Percentage">
                </div>
                <div class="form-group">
                  <label for="Marks">SSC Marks</label>
                  <input type="text" class="form-control input-lg" id="Marks" name="ssc" placeholder="Percentage">
                </div>
                <div class="form-group">
                  <label for="Marks">B.tech Current Percentage</label>
                  <input type="text" class="form-control input-lg" id="Marks" name="btech" placeholder="Percentage">
                </div>
                <div class="form-group checkbox">
                  <label><input type="checkbox"> I accept terms & conditions</label>
                </div>
                <div class="form-group">
                  <button class="btn btn-flat btn-success">Register</button>
                </div>
                <?php
                //If User already registered with this email then show error message.
                if (isset($_SESSION['registerError'])) {
                  ?>
                  <div class="form-group">
                    <label style="color: red;">Email Already Exists! Choose A Different Email!</label>
                  </div>
                  <?php
                  unset($_SESSION['registerError']);
                }
                ?>

                <?php if (isset($_SESSION['uploadError'])) { ?>
                  <div class="form-group">
                    <label style="color: red;">
                      <?php echo $_SESSION['uploadError']; ?>
                    </label>
                  </div>
                  <?php unset($_SESSION['uploadError']);
                } ?>

              </div>
              <div class="col-md-6 latest-job ">
                <div class="form-group">
                  <input class="form-control input-lg" type="password" id="password" name="password"
                    placeholder="Password *" required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="password" id="cpassword" name="cpassword"
                    placeholder="Confirm Password *" required>
                </div>
                <div id="passwordError" class="btn btn-flat btn-danger hide-me">
                  Password Mismatch!!
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" id="contactno" name="contactno" minlength="10"
                    maxlength="10" onkeypress="return validatePhone(event);" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <textarea class="form-control input-lg" rows="4" id="address" name="address"
                    placeholder="Address"></textarea>
                </div>
                <div class="form-group">
                  <select class="form-control  input-lg" id="country" name="country">
                    <option selected="" value="">Select Country</option>
                    <?php
                    $sql = "SELECT * FROM countries";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
                      }
                    }
                    ?>

                  </select>
                </div>
                <div id="stateDiv" class="form-group" style="display: none;">
                  <select class="form-control  input-lg" id="state" name="state">
                    <option value="" selected="">Select State</option>
                  </select>
                </div>
                <div id="cityDiv" class="form-group" style="display: none;">
                  <select class="form-control  input-lg" id="city" name="city">
                    <option selected="">Select City</option>
                  </select>
                </div>
                <!-- <div class="form-group">
                  <input class="form-control input-lg" type="text" id="city" name="city" placeholder="City">
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" id="state" name="state" placeholder="State">
                </div> -->
                <!-- <div class="form-group">
                  <textarea class="form-control input-lg" rows="4" id="skills" name="skills" placeholder="Enter Skills"></textarea>
                </div> -->
                <!-- <div class="form-group">
                  <input class="form-control input-lg" type="text" id="designation" name="designation" placeholder="Designation">
                </div> -->


                <div class="form-group">
                  <h2> Resume </h2>
                  <label style="color: red;">File Format PDF Only!</label>
                  <input type="file" name="resume" class="btn btn-flat btn-danger" required>
                </div>

              </div>
            </form>

          </div>
        </div>
      </section>



    </div>
    <!-- footer -->
    <div style="color:white">
      <?php
      include 'components/footer.php';
      ?>
    </div>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- ./wrapper -->


  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>

  <script type="text/javascript">
    function validatePhone(event) {

      //event.keycode will return unicode for characters and numbers like a, b, c, 5 etc.
      //event.which will return key for mouse events and other events like ctrl alt etc. 
      var key = window.event ? event.keyCode : event.which;

      if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
        // 8 means Backspace
        //46 means Delete
        // 37 means left arrow
        // 39 means right arrow
        return true;
      } else if (key < 48 || key > 57) {
        // 48-57 is 0-9 numbers on your keyboard.
        return false;
      } else return true;
    }
  </script>
  <script>
    $("#country").on("change", function () {
      var id = $(this).find(':selected').attr("data-id");
      $("#state").find('option:not(:first)').remove();
      if (id != '') {
        $.post("state.php", {
          id: id
        }).done(function (data) {
          $("#state").append(data);
        });
        $('#stateDiv').show();
      } else {
        $('#stateDiv').hide();
        $('#cityDiv').hide();
      }
    });
  </script>

  <script>
    $("#state").on("change", function () {
      var id = $(this).find(':selected').attr("data-id");
      $("#city").find('option:not(:first)').remove();
      if (id != '') {
        $.post("city.php", {
          id: id
        }).done(function (data) {
          $("#city").append(data);
        });
        $('#cityDiv').show();
      } else {
        $('#cityDiv').hide();
      }
    });
  </script>

  <script type="text/javascript">
    $('#dob').on('change', function () {
      var today = new Date();
      var birthDate = new Date($(this).val());
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();

      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }

      $('#age').val(age);
    });
  </script>
  <script>
    $("#registerCandidates").on("submit", function (e) {
      e.preventDefault();
      if ($('#password').val() != $('#cpassword').val()) {
        $('#passwordError').show();
      } else {
        $(this).unbind('submit').submit();
      }
    });
  </script>
</body>

</html>