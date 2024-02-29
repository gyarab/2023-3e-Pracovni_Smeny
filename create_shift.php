<?php
/**Currently in development  */
$cons = "";
session_start();

if (isset($_SESSION["user2_id"])) {

  $mysqli = require __DIR__ . "/database.php";

  $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
}

$mysqli1 = require __DIR__ . "/database.php";
$sql1 = " SELECT * FROM user2 ORDER BY id DESC ";
$result1 = $mysqli1->query($sql1);
$mysqli1->close();


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/main_page.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/tree.css">
  <link rel="stylesheet" href="css/success.css">

  <style>
    .cont {
      margin-bottom: 25px;
      border: 1px solid;
      margin: auto;
      width: 100%;
      padding: 10px;
      box-shadow: 5px 10px #888888;
      margin-left: 10px;
    }

    .head {
      margin: auto;
      width: 100%;
      padding: 10px;
      margin-bottom: 25px;
    }

    .in {
      border-radius: 100%;
      height: 30px;
      width: 30px;
      border: solid #aaa;
    }

    .topright {
      position: absolute;
      top: 8px;
      right: 16px;
      font-size: 18px;
    }


    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>

<body>
<script>
              var id_shift;
              var update;

  </script>

  <nav>

    <div class="navbar container">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="admin_main_page.php">Home :
          <?= $cons ?>
          <?= htmlspecialchars($user["firstname"]) ?>
          <?= htmlspecialchars($user["middlename"]) ?>
          <?= htmlspecialchars($user["lastname"]) ?>
        </a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name">Home page</span>
          <i class='bx bx-x'></i>
        </div>
        <ul class="links">
          <li>
            <a href="#">EMPLOYEES</a>
            <i class='bx bxs-chevron-down js-emarrow arrow '></i>
            <ul class="em-sub-menu sub-menu">
              <li><a href="signup.php">ADD TO SYSTEM</a></li>
              <li><a href="#">LIST</a></li>
              <li><a href="#">CHANGE DATA</a></li>
            </ul>
          </li>
          <li>
            <a href="#">DATABASE</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="create_object.php">CREATE OBJECT</a></li>
              <li><a href="create_shift.php">CREATE SHIFT</a></li>
              <li><a href="#">CURRENT SCHEDULE</a></li>
              <li class="more">
                <span><a href="#">More</a>
                  <i class='bx bxs-chevron-right arrow more-arrow'></i>
                </span>
                <ul class="more-sub-menu sub-menu">
                  <li><a href="#"></a></li>
                  <li><a href="#">Pre-loader</a></li>
                  <li><a href="#">Glassmorphism</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">HISTORY</a>
            <i class='bx bxs-chevron-down js-arrow arrow '></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="#">Dynamic Clock</a></li>
              <li><a href="#">Form Validation</a></li>
              <li><a href="#">Card Slider</a></li>
              <li><a href="#">Complete Website</a></li>
            </ul>
          </li>
          <li><a href="#">STATISTICS</a></li>
          <li><a href="logout.php">LOG OUT</a></li>
        </ul>
      </div>
      <div class="search-box">
        <i class='bx bx-search'></i>
        <div class="input-box">
          <input type="text" placeholder="Search...">
        </div>
      </div>
    </div>
  </nav>
  <script src="js/main_page.js"></script>
  <br>
  <br>
  <br>




  <form id="main_f" method="post" action="load_shift.php" novalidate>

    <?php if (isset($user)): ?>

      <div class="container">

        <div class="head">
          <h1>Create new shift</h1>
        </div>
        <div class="cont">
          <h2>Create permanet shift: </h2>
          <label for="sr">When the first schift should start:</label>
          <input type="date" id="sr" name="sr" value="<?php echo ('Y-m-d'); ?>">
          <br>
          <label for="jobname" style="display:inline">Name of the job position:</label>
          <input type="text" name="jobname" id="jobname" style="display:inline">
          <br id="hbr" style="display:none">
          <label id="label2" style="visibility:hidden;color:red"></label>
          <br>
          <label for="repeat">After how many days the shift should repeat:</label>
          <input type="number" id="repeat" name="repeat" min="0" size="2">
          <br>
          <label>In which days the schift should be:</label>
          <br>
          <h3>General setting</h3>

          <input type="checkbox" id="everyday" name="radio" style="display:inline">
          <label for="everyday" style="display:inline"> Everyday</label>
          <input type="checkbox" id="everyworkday" name="radio" style="display:inline">
          <label for="everyworkday" style="display:inline"> Every work day</label>
          <input type="checkbox" id="weekend" name="radio" style="display:inline">
          <label for="weekend" style="display:inline"> Every weekend</label>
          <br>
          <label for="from" style="display:inline">From </label>
          <input type="time" id="from" name="from" style="display:inline" />
          <label for="to" style="display:inline">To </label>
          <input type="time" id="to" name="to" style="display:inline" />

          <button id="paste" onclick="myFunction()">Paste</button>
          <br>

          <br>
          <h3>Specific setting</h3>
          <input class="select" type="checkbox" id="monday" name="monday" style="display:inline">
          <label for="monday" style="display:inline"> Monday - </label>
          <label for="frommonday" style="display:inline">From </label>
          <input id="frommonday" name="frommonday" type="time" style="display:inline" />
          <label for="tomonday" style="display:inline">To </label>
          <input type="time" id="tomonday" name="tomonday" style="display:inline" />
          <br>


          <input class="select" type="checkbox" id="tuesday" name="tuesday" style="display:inline">
          <label for="tuesday" style="display:inline"> Tuesday - </label>
          <label for="fromtuesday" style="display:inline">From </label>
          <input type="time" id="fromtuesday" name="fromtuesday" style="display:inline" />
          <label for="totuesday" style="display:inline">To </label>
          <input type="time" id="totuesday" name="totuesday" style="display:inline" />
          <br>


          <input class="select" type="checkbox" id="wednesday" name="wednesday" style="display:inline">
          <label for="wednesday" style="display:inline"> Wednesday - </label>
          <label for="fromwednesday" style="display:inline">From </label>
          <input type="time" id="fromwednesday" name="fromwednesday" style="display:inline" />
          <label for="towednesday" style="display:inline">To </label>
          <input type="time" id="towednesday" name="towednesday" style="display:inline" />
          <br>


          <input class="select" type="checkbox" id="thursday" name="thursday" style="display:inline">
          <label for="thursday" style="display:inline"> Thursday - </label>
          <label for="fromthursday" style="display:inline">From </label>
          <input type="time" id="fromthursday" name="fromthursday" min="00:00" max="00:00" style="display:inline" />
          <label for="tothursday" style="display:inline">To </label>
          <input type="time" id="tothursday" name="tothursday" min="00:00" max="00:00" style="display:inline" />
          <br>


          <input class="select" type="checkbox" id="friday" name="friday" style="display:inline">
          <label for="Friday" style="display:inline"> Friday - </label>
          <label for="fromfriday" style="display:inline">From </label>
          <input type="time" id="fromfriday" name="fromfriday" min="00:00" max="00:00" style="display:inline" />
          <label for="tofriday" style="display:inline">To </label>
          <input type="time" id="tofriday" name="tofriday" min="00:00" max="00:00" style="display:inline" />
          <br>


          <input class="select" type="checkbox" id="saturday" name="saturday" style="display:inline">
          <label for="saturday" style="display:inline"> Saturday - </label>
          <label for="fromsaturday" style="display:inline">From </label>
          <input type="time" id="fromsaturday" name="fromsaturday" min="00:00" max="00:00" style="display:inline" />
          <label for="tosaturday" style="display:inline">To </label>
          <input type="time" id="tosaturday" name="tosaturday" min="00:00" max="00:00" style="display:inline" />
          <br>


          <input class="select" type="checkbox" id="sunday" name="sunday" style="display:inline">
          <label for="sunday" style="display:inline"> Sunday - </label>
          <label for="fromsunday" style="display:inline">From </label>
          <input class="select" type="time" id="fromsunday" name="fromsunday" min="00:00" max="00:00"
            style="display:inline" />
          <label style="display:inline">To </label>
          <input type="time" id="tosunday" name="tosunday" min="00:00" max="00:00" style="display:inline" />

          <br>
          <br>
          <label>In which object the shift should be:</label>
          <br>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>



          <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <div class='text-end'>
                <span class="close">&times;</span>
              </div>
              <div class="container">
                <div class='row'>

                  <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                    <h6>Name of the shift</h6>
                    <br>
                    <input type="text" id="sfield" placeholder="Name of the shift">
                    <br>
                    <br>
                    <h6>Selected time</h6>

                    <br>
                    <input class="select" type="checkbox" id="smonday" name="smonday" style="display:inline">
                    <label for="smonday" style="display:inline"> Monday - </label>
                    <label for="sfrommonday" style="display:inline">From </label>
                    <input id="sfrommonday" name="sfrommonday" type="time" style="display:inline" />
                    <label for="stomonday" style="display:inline">To </label>
                    <input type="time" id="stomonday" name="stomonday" style="display:inline" />
                    <br>


                    <input class="select" type="checkbox" id="stuesday" name="stuesday" style="display:inline">
                    <label for="stuesday" style="display:inline"> Tuesday - </label>
                    <label for="sfromtuesday" style="display:inline">From </label>
                    <input type="time" id="sfromtuesday" name="sfromtuesday" style="display:inline" />
                    <label for="stotuesday" style="display:inline">To </label>
                    <input type="time" id="stotuesday" name="stotuesday" style="display:inline" />
                    <br>


                    <input class="select" type="checkbox" id="swednesday" name="swednesday" style="display:inline">
                    <label for="swednesday" style="display:inline"> Wednesday - </label>
                    <label for="sfromwednesday" style="display:inline">From </label>
                    <input type="time" id="sfromwednesday" name="sfromwednesday" style="display:inline" />
                    <label for="towednesday" style="display:inline">To </label>
                    <input type="time" id="stowednesday" name="stowednesday" style="display:inline" />
                    <br>


                    <input class="select" type="checkbox" id="sthursday" name="sthursday" style="display:inline">
                    <label for="sthursday" style="display:inline"> Thursday - </label>
                    <label for="sfromthursday" style="display:inline">From </label>
                    <input type="time" id="sfromthursday" name="sfromthursday" min="00:00" max="00:00"
                      style="display:inline" />
                    <label for="stothursday" style="display:inline">To </label>
                    <input type="time" id="stothursday" name="stothursday" min="00:00" max="00:00"
                      style="display:inline" />
                    <br>


                    <input class="select" type="checkbox" id="sfriday" name="sfriday" style="display:inline">
                    <label for="sfriday" style="display:inline"> Friday - </label>
                    <label for="sfromfriday" style="display:inline">From </label>
                    <input type="time" id="sfromfriday" name="sfromfriday" min="00:00" max="00:00"
                      style="display:inline" />
                    <label for="stofriday" style="display:inline">To </label>
                    <input type="time" id="stofriday" name="stofriday" min="00:00" max="00:00" style="display:inline" />
                    <br>


                    <input class="select" type="checkbox" id="ssaturday" name="ssaturday" style="display:inline">
                    <label for="ssaturday" style="display:inline"> Saturday - </label>
                    <label for="sfromsaturday" style="display:inline">From </label>
                    <input type="time" id="sfromsaturday" name="sfromsaturday" min="00:00" max="00:00"
                      style="display:inline" />
                    <label for="stosaturday" style="display:inline">To </label>
                    <input type="time" id="stosaturday" name="stosaturday" min="00:00" max="00:00"
                      style="display:inline" />
                    <br>


                    <input class="select" type="checkbox" id="ssunday" name="ssunday" style="display:inline">
                    <label for="ssunday" style="display:inline"> Sunday - </label>
                    <label for="sfromsunday" style="display:inline">From </label>
                    <input class="select" type="time" id="sfromsunday" name="sfromsunday" min="00:00" max="00:00"
                      style="display:inline" />
                    <label style="display:inline">To </label>
                    <input type="time" id="stosunday" name="stosunday" min="00:00" max="00:00" style="display:inline" />
                    <br>
                    <br>
                    <h6>Picked color:</h6>
                    <br>

                    <input id="scolor-1" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #124072;" value="">
                    <input id="scolor-2" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #067088;" value="">
                    <input id="scolor-3" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #056362;" value="">
                    <input id="scolor-4" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #055d2b;" value="">
                    <input id="scolor-5" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #4b8723;" value="">
                    <input id="scolor-6" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #889d1e;" value="">
                    <br>
                    <input id="scolor-7" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #c3b204;" value="">
                    <input id="scolor-8" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #ce8425;" value="">
                    <input id="scolor-9" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color:  #a53d1a;" value="">
                    <input id="scolor-10" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color:  #880002;" value="">
                    <input id="scolor-11" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color:  #6a1161;" value="">
                    <input id="scolor-12" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color:  #4c1862 ;" value="">
                    <br>
                    <input id="scolor-13" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #1965b9;" value="">
                    <input id="scolor-14" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color:  #039ce0;" value="">
                    <input id="scolor-15" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #01969c;" value="">
                    <input id="scolor-16" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #009242;" value="">
                    <input id="scolor-17" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color:  #67ad31 ;" value="">
                    <input id="scolor-18" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #bcd637;" value="">
                    <br>
                    <input id="scolor-19" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #fff002;" value="">
                    <input id="scolor-20" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #fdaf43;" value="">
                    <input id="scolor-21" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #e87034;" value="">
                    <input id="scolor-22" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #eb1c26;" value="">
                    <input id="scolor-23" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #a2288d;" value="">
                    <input id="scolor-24" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #652d90;" value="">
                    <br>
                    <input id="scolor-25" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #81c1e7;" value="">
                    <input id="scolor-26" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #50ddd5;" value="">
                    <input id="scolor-27" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #addc81;" value="">
                    <input id="scolor-28" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #ffffba;" value="">
                    <input id="scolor-29" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #fea698;" value="">
                    <input id="scolor-30" type="button" class="in" onclick="sColor(this.id)"
                      style="background-color: #b697dd;" value="">
                    <script>
                      const map1 = new Map();

                      map1.set('#124072', 'scolor-1');
                      map1.set('#067088', 'scolor-2');
                      map1.set('#056362', 'scolor-3');
                      map1.set('#055d2b', 'scolor-4');
                      map1.set('#4b8723', 'scolor-5');
                      map1.set('#889d1e', 'scolor-6');

                      map1.set('#c3b204', 'scolor-7');
                      map1.set('#ce8425', 'scolor-8');
                      map1.set('#a53d1a', 'scolor-9');
                      map1.set('#880002', 'scolor-10');
                      map1.set('#6a1161', 'scolor-11');
                      map1.set('#4c1862', 'scolor-12');

                      map1.set('#1965b9', 'scolor-13');
                      map1.set('#039ce0', 'scolor-14');
                      map1.set('#01969c', 'scolor-15');
                      map1.set('#009242', 'scolor-16');
                      map1.set('#67ad31', 'scolor-17');
                      map1.set('#bcd637', 'scolor-18');

                      map1.set('#fff002', 'scolor-19');
                      map1.set('#fdaf43', 'scolor-20');
                      map1.set('#e87034', 'scolor-21');
                      map1.set('#eb1c26', 'scolor-22');
                      map1.set('#a2288d', 'scolor-23');
                      map1.set('#652d90', 'scolor-24');

                      map1.set('#81c1e7', 'scolor-25');
                      map1.set('#50ddd5', 'scolor-26');
                      map1.set('#addc81', 'scolor-27');
                      map1.set('#ffffba', 'scolor-28');
                      map1.set('#fea698', 'scolor-29');
                      map1.set('#b697dd', 'scolor-30');


                    </script>
                    <br>
                    <br>

                  </div>
                  <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                    <h6>Selected object :</h6>
                    <br>
                    <Select id="select_obj" style="display: inline">
                      <!--<option value="0">Pick a object</option>-->
                      <?php
                      $mysqli = require __DIR__ . "/database.php";

                      $conn = new mysqli($host, $username, $password, $dbname);
                      $query2 = "SELECT * FROM list_of_objects WHERE superior_object_name='' ";
                      $result2 = mysqli_query($conn, $query2);
                      $counter = 0;
                      if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                          $id_obj = $row2['id_object'];
                          $name_obj = $row2['object_name'];
                          if ($counter == 0) {
                            $pick = $id_obj;
                          }
                          $counter++;
                          ?>
                          <option value="<?php echo $id_obj; ?>" seleted="selected">
                            <?php echo $name_obj; ?>
                          </option>

                          <?php
                        }
                      }
                      ?>
                    </Select>
                    <div class="tree">
                      <div id="object">

                      </div>
                    </div>
                    <script>
                      var name = "spa";
                      var input_obj =
                        <?php echo json_encode($pick); ?>;
                      $.ajax({
                        url: "load_object_in_rights.php",
                        method: "POST",
                        data: { input: input_obj },
                        success: function (data) {
                          $("#object").html(data);
                        }
                      });


                      $('#select_obj').change(function () {
                        var inp = $(this).val();
                        $.ajax({
                          url: "load_object_in_rights.php",
                          method: "POST",
                          data: { input: inp },
                          success: function (data) {
                            $("#object").html(data);
                            if(document.getElementsByName("s" + transfer[23]) != null){
                            let find = document.getElementsByName("s" + transfer[23]);
                               find[0].style.backgroundColor = '#056362';
                               find[0].style.color = '#fff';
                              find[0].style.border = "solid #056362";
                          }
                          }
                        });
                        previous3 = 0;
                      });
                      function edit_obj(inps, obj) {
                        var inp = inps;
                        $.ajax({
                          url: "load_object_in_rights.php",
                          method: "POST",
                          data: { input: inp },
                          success: function (data) {
                            $("#object").html(data);
                            let find = document.getElementsByName("s" + obj);
                find[0].style.backgroundColor = '#056362';
                find[0].style.color = '#fff';
                find[0].style.border = "solid #056362";
                          }
                        });
                      }

                      function Delete_shift() {
                        $.ajax({
                          url: "delete_shift.php",
                          method: "POST",
                          data: { input: id_shift },
                          success: function (data) {
                            modal.style.display = "none";
                            alert("Shift was deleted successfully");
                          }
                        });
                      }
                    </script>
                  </div>
                </div>
                <div>

                  <input type="button" style="display: inline; float: right" onclick="Edit_shift()" class="btn btn-primary" value="EDIT">
                  <input type="button" style="display: inline; float: left" onclick="Delete_shift()" class="btn btn-danger" value="DELETE">
<br>
<br><br>
<br>
                </div>
              </div>
            </div>

          </div>






          <?php
          $names = $_GET['day'];
          foreach ($names as $color) {
            echo $color . "<br />";
          }
          ?>








          <div class="tree">
            <div id="res"></div>
          </div>
          <br id="hbr3" style="display:none">
          <label id="label3" style="visibility:hidden;color:red">Object needs to be selected*</label>






          <script>



            var input = 0;
            var ChA = JSON.parse(input);
            $.ajax({
              url: "load_object_in_shift.php",
              method: "POST",
              data: { input: ChA },
              success: function (data) {
                $("#res").html(data);
              }
            });


            var ff;


            var previous;
            function Helal(clicked) {
              let vjvj = document.getElementById(clicked);
              ff = clicked.substring(3);
              if (previous != ff) {
                vjvj.style.backgroundColor = '#4CAF50';
                vjvj.style.color = '#fff';
                vjvj.style.border = "solid #4CAF50";

                if (previous != "0" && previous != null) {

                  var kka = "box" + previous;
                  let ffa = document.getElementById(kka);
                  ffa.style.color = '';
                  ffa.style.backgroundColor = '';
                  ffa.style.border = "";
                }
                previous = ff;

              } else {
                vjvj.style.color = '';
                vjvj.style.backgroundColor = '';
                vjvj.style.border = "";

                previous = 0;
              }
            }

            var qq;
            var previous3;
            function Sel(clicked) {
              let pjpj = document.getElementById(clicked);
              qq = clicked.substring(3);
              if (previous3 != qq) {
                if(pjpj.style.backgroundColor != "rgb(5, 99, 98)"){
                pjpj.style.backgroundColor = '#4CAF50';
                pjpj.style.color = '#fff';
                pjpj.style.border = "solid #4CAF50";
                

                if (previous3 != "0" && previous3 != null) {

                  var kkq = "spa" + previous3;
                  let fff = document.getElementById(kkq);
                  fff.style.color = '';
                  fff.style.backgroundColor = '';
                  fff.style.border = "";
                }
                previous3 = qq;
              }

              } else {
                if(pjpj.style.backgroundColor != "rgb(5, 99, 98)"){
                pjpj.style.color = '';
                pjpj.style.backgroundColor = '';
                pjpj.style.border = "";
                }
                previous3 = 0;
                
              }
            }


            $("#savemain").click(function () {
              $(".check-icon").hide();
              setTimeout(function () {
                $(".check-icon").show();
              }, 10);
            });

            let previous2 = "color-1";
            let codecolor = "#124072";
            let hex;
            window.addEventListener("load", (event) => {

              let clicked_color = document.getElementById(previous2);
              clicked_color.style.border = "solid black";
              hex = "#124072";
            });

            function Color(clicked) {
              let clicked_color = document.getElementById(clicked);
              clicked_color.style.border = "solid black";
              codecolor = clicked_color.style.backgroundColor;
              /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
              var rgb = codecolor.match(/\d+/g);
              hex = '#' + ('0' + parseInt(rgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[2], 10).toString(16)).slice(-2);
              let clicked_color_prev = document.getElementById(previous2);
              clicked_color_prev.style.border = "";

            }
            let sprevious2 = "scolor-1";
            let scodecolor = "#124072";
            let shex;

            window.addEventListener("load", (event) => {

              let sclicked_color = document.getElementById(sprevious2);
              sclicked_color.style.border = "solid black";
              shex = "#124072";
            });

            function sColor(clicked) {
              let sclicked_color = document.getElementById(clicked);
              sclicked_color.style.border = "solid black";
              scodecolor = sclicked_color.style.backgroundColor;
              /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
              var srgb = scodecolor.match(/\d+/g);
              shex = '#' + ('0' + parseInt(srgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(srgb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(srgb[2], 10).toString(16)).slice(-2);
              let sclicked_color_prev = document.getElementById(sprevious2);
              if (clicked != sprevious2) {
                sclicked_color_prev.style.border = "";
                sprevious2 = clicked;
              }


            }
            var cq = 0;
            var Cq = JSON.parse(cq);


            function Edit_shift() {
              let e = document.getElementById("sfield").value;
              
              if (e != "") {
               
                var mf = document.getElementById('sfrommonday').value;
                var mt = document.getElementById('stomonday').value;
                var tuf = document.getElementById('sfromtuesday').value;
                var tut = document.getElementById('stotuesday').value;
                var wf = document.getElementById('sfromwednesday').value;
                var wt = document.getElementById('stowednesday').value;
                var thf = document.getElementById('sfromthursday').value;
                var tht = document.getElementById('stothursday').value;
                var ff = document.getElementById('sfromfriday').value;
                var ft = document.getElementById('stofriday').value;
                var saf = document.getElementById('sfromsaturday').value;
                var sat = document.getElementById('stosaturday').value;
                var suf = document.getElementById('sfromsunday').value;
                var sut = document.getElementById('stosunday').value;

                var name = document.getElementById('sfield').value;
                var start = document.getElementById('sr').value;

                var mo_d = document.getElementById("smonday");
                var tu_d = document.getElementById("stuesday");
                var we_d = document.getElementById("swednesday");
                var th_d = document.getElementById("sthursday");
                var fr_d = document.getElementById("sfriday");
                var sa_d = document.getElementById("ssaturday");
                var su_d = document.getElementById("ssunday");
                if (previous3 != "0" && previous3 != null) {
                  var bb = "spa" + previous3;
                  var hh = "shi" + previous3;
                  var pj = document.getElementById(bb).value;
                  var jj = document.getElementById(hh).value;
                } else {
                  var pj = transfer[24];
                  var jj = transfer[23]
                } 
                var update = 1;
                //alert(previous3);
                  if (mo_d.checked == true) {
                    mon_day = 1;
                  } else {
                    mon_day = 0;
                  }
                  if (tu_d.checked == true) {
                    tue_day = 1;
                  } else {
                    tue_day = 0;
                  }
                  if (we_d.checked == true) {
                    wed_day = 1;
                  } else {
                    wed_day = 0;
                  }
                  if (th_d.checked == true) {
                    thu_day = 1;
                  } else {
                    thu_day = 0;
                  }
                  if (fr_d.checked == true) {
                    fri_day = 1;
                  } else {
                    fri_day = 0;
                  }
                  if (sa_d.checked == true) {
                    sat_day = 1;
                  } else {
                    sat_day = 0;
                  }
                  if (su_d.checked == true) {
                    sun_day = 1;
                  } else {
                    sun_day = 0;
                  }


                  var monf = JSON.stringify(mf);
                  var mont = JSON.stringify(mt);
                  var tuef = JSON.stringify(tuf);
                  var tuet = JSON.stringify(tut);
                  var wedf = JSON.stringify(wf);
                  var wedt = JSON.stringify(wt);
                  var thuf = JSON.stringify(thf);
                  var thut = JSON.stringify(tht);
                  var frif = JSON.stringify(ff);
                  var frit = JSON.stringify(ft);
                  var satf = JSON.stringify(saf);
                  var satt = JSON.stringify(sat);
                  var sunf = JSON.stringify(suf);
                  var sunt = JSON.stringify(sut);

                  var jobname = JSON.stringify(name);

                  var mond = JSON.parse(mon_day);
                  var tued = JSON.parse(tue_day);
                  var wedd = JSON.parse(wed_day);
                  var thud = JSON.parse(thu_day);
                  var frid = JSON.parse(fri_day);
                  var satd = JSON.parse(sat_day);
                  var sund = JSON.parse(sun_day);
                  //alert(jj);
                  $.ajax({


                    url: "load_shift2.php",
                    method: "POST",
                    data: {
                      mond: mond, monf: monf, mont: mont,
                      tued: tued, tuef: tuef, tuet: tuet,
                      wedd: wedd, wedf: wedf, wedt: wedt,
                      thud: thud, thuf: thuf, thut: thut,
                      frid: frid, frif: frif, frit: frit,
                      satd: satd, satf: satf, satt: satt,
                      sund: sund, sunf: sunf, sunt: sunt,
                      jobname: e, color: shex, start: start,
                      object_name: pj, object_id: jj, update : update,
                      id_shift : id_shift
                    },
                    success: function (data) {
                      modal.style.display = "none";
                      alert("Shift was successfully edited");
                      //alert("Schift saved succesfully");
                    }
                  });


              } else {


              }
            }







            function Save_shift() {

              let q = document.getElementById("jobname").value;

              if (q != "") {
                var cq = 0;
                var Cq = JSON.parse(cq);


                var mf = document.getElementById('frommonday').value;
                var mt = document.getElementById('tomonday').value;
                var tuf = document.getElementById('fromtuesday').value;
                var tut = document.getElementById('totuesday').value;
                var wf = document.getElementById('fromwednesday').value;
                var wt = document.getElementById('towednesday').value;
                var thf = document.getElementById('fromthursday').value;
                var tht = document.getElementById('tothursday').value;
                var ff = document.getElementById('fromfriday').value;
                var ft = document.getElementById('tofriday').value;
                var saf = document.getElementById('fromsaturday').value;
                var sat = document.getElementById('tosaturday').value;
                var suf = document.getElementById('fromsunday').value;
                var sut = document.getElementById('tosunday').value;

                var name = document.getElementById('jobname').value;
                var start = document.getElementById('sr').value;

                var mo_d = document.getElementById("monday");
                var tu_d = document.getElementById("tuesday");
                var we_d = document.getElementById("wednesday");
                var th_d = document.getElementById("thursday");
                var fr_d = document.getElementById("friday");
                var sa_d = document.getElementById("saturday");
                var su_d = document.getElementById("sunday");
                if (previous != "0" && previous != null) {
                  var bb = "box" + previous;
                  var hh = "hid" + previous;
                  var pj = document.getElementById(bb).value;
                  var jj = document.getElementById(hh).value;
                  var update = 0;
                  if (mo_d.checked == true) {
                    mon_day = 1;
                  } else {
                    mon_day = 0;
                  }
                  if (tu_d.checked == true) {
                    tue_day = 1;
                  } else {
                    tue_day = 0;
                  }
                  if (we_d.checked == true) {
                    wed_day = 1;
                  } else {
                    wed_day = 0;
                  }
                  if (th_d.checked == true) {
                    thu_day = 1;
                  } else {
                    thu_day = 0;
                  }
                  if (fr_d.checked == true) {
                    fri_day = 1;
                  } else {
                    fri_day = 0;
                  }
                  if (sa_d.checked == true) {
                    sat_day = 1;
                  } else {
                    sat_day = 0;
                  }
                  if (su_d.checked == true) {
                    sun_day = 1;
                  } else {
                    sun_day = 0;
                  }


                  var monf = JSON.stringify(mf);
                  var mont = JSON.stringify(mt);
                  var tuef = JSON.stringify(tuf);
                  var tuet = JSON.stringify(tut);
                  var wedf = JSON.stringify(wf);
                  var wedt = JSON.stringify(wt);
                  var thuf = JSON.stringify(thf);
                  var thut = JSON.stringify(tht);
                  var frif = JSON.stringify(ff);
                  var frit = JSON.stringify(ft);
                  var satf = JSON.stringify(saf);
                  var satt = JSON.stringify(sat);
                  var sunf = JSON.stringify(suf);
                  var sunt = JSON.stringify(sut);

                  var jobname = JSON.stringify(name);

                  var mond = JSON.parse(mon_day);
                  var tued = JSON.parse(tue_day);
                  var wedd = JSON.parse(wed_day);
                  var thud = JSON.parse(thu_day);
                  var frid = JSON.parse(fri_day);
                  var satd = JSON.parse(sat_day);
                  var sund = JSON.parse(sun_day);

                  $.ajax({


                    url: "load_shift2.php",
                    method: "POST",
                    data: {
                      mond: mond, monf: monf, mont: mont,
                      tued: tued, tuef: tuef, tuet: tuet,
                      wedd: wedd, wedf: wedf, wedt: wedt,
                      thud: thud, thuf: thuf, thut: thut,
                      frid: frid, frif: frif, frit: frit,
                      satd: satd, satf: satf, satt: satt,
                      sund: sund, sunf: sunf, sunt: sunt,
                      jobname: q, color: hex, start: start,
                      object_name: pj, object_id: jj, update : update,
                      id_shift : id_shift
                    },
                    success: function (data) {
                      alert("Schift saved succesfully");
                    }
                  });
                  var popup = document.getElementById("label2");
                  popup.style.visibility = "hidden";
                  popup.innerText = "";
                  var po = document.getElementById("hbr");
                  po.style.display = "none";

                  var popu = document.getElementById("label1");
                  popu.style.visibility = "hidden";
                  var pop = document.getElementById("hbr1");
                  pop.style.display = "none";

                  var popups = document.getElementById("label3");
                  popups.style.visibility = "hidden";
                  var p = document.getElementById("hbr3");
                  p.style.display = "none";
                } else {
                  var popup = document.getElementById("label3");
                  popup.style.visibility = "visible";
                  var po = document.getElementById("hbr3");
                  po.style.display = "";

                  var popu = document.getElementById("label1");
                  popu.style.visibility = "visible";
                  var pop = document.getElementById("hbr1");
                  pop.style.display = "";


                }
              } else {
                var popup = document.getElementById("label2");
                popup.style.visibility = "visible";
                popup.innerText = "Needs to be filled*";
                var po = document.getElementById("hbr");
                po.style.display = "";

                var popu = document.getElementById("label1");
                popu.style.visibility = "visible";
                var pop = document.getElementById("hbr1");
                pop.style.display = "";


              }
            }
          </script>




          <br>
          <label for="colorpicker">Color Picker:</label>
          <br>
          <br>

          <input id="color-1" type="button" class="in" onclick="Color(this.id)" style="background-color: #124072;"
            value="">
          <input id="color-2" type="button" class="in" onclick="Color(this.id)" style="background-color: #067088;"
            value="">
          <input id="color-3" type="button" class="in" onclick="Color(this.id)" style="background-color: #056362;"
            value="">
          <input id="color-4" type="button" class="in" onclick="Color(this.id)" style="background-color: #055d2b;"
            value="">
          <input id="color-5" type="button" class="in" onclick="Color(this.id)" style="background-color: #4b8723;"
            value="">
          <input id="color-6" type="button" class="in" onclick="Color(this.id)" style="background-color: #889d1e;"
            value="">
          <br>
          <input id="color-7" type="button" class="in" onclick="Color(this.id)" style="background-color: #c3b204;"
            value="">
          <input id="color-8" type="button" class="in" onclick="Color(this.id)" style="background-color: #ce8425;"
            value="">
          <input id="color-9" type="button" class="in" onclick="Color(this.id)" style="background-color:  #a53d1a;"
            value="">
          <input id="color-10" type="button" class="in" onclick="Color(this.id)" style="background-color:  #880002;"
            value="">
          <input id="color-11" type="button" class="in" onclick="Color(this.id)" style="background-color:  #6a1161;"
            value="">
          <input id="color-12" type="button" class="in" onclick="Color(this.id)" style="background-color:  #4c1862 ;"
            value="">
          <br>
          <input id="color-13" type="button" class="in" onclick="Color(this.id)" style="background-color: #1965b9;"
            value="">
          <input id="color-14" type="button" class="in" onclick="Color(this.id)" style="background-color:  #039ce0;"
            value="">
          <input id="color-15" type="button" class="in" onclick="Color(this.id)" style="background-color: #01969c;"
            value="">
          <input id="color-16" type="button" class="in" onclick="Color(this.id)" style="background-color: #009242;"
            value="">
          <input id="color-17" type="button" class="in" onclick="Color(this.id)" style="background-color:  #67ad31 ;"
            value="">
          <input id="color-18" type="button" class="in" onclick="Color(this.id)" style="background-color: #bcd637;"
            value="">
          <br>
          <input id="color-19" type="button" class="in" onclick="Color(this.id)" style="background-color: #fff002;"
            value="">
          <input id="color-20" type="button" class="in" onclick="Color(this.id)" style="background-color: #fdaf43;"
            value="">
          <input id="color-21" type="button" class="in" onclick="Color(this.id)" style="background-color: #e87034;"
            value="">
          <input id="color-22" type="button" class="in" onclick="Color(this.id)" style="background-color: #eb1c26;"
            value="">
          <input id="color-23" type="button" class="in" onclick="Color(this.id)" style="background-color: #a2288d;"
            value="">
          <input id="color-24" type="button" class="in" onclick="Color(this.id)" style="background-color: #652d90;"
            value="">
          <br>
          <input id="color-25" type="button" class="in" onclick="Color(this.id)" style="background-color: #81c1e7;"
            value="">
          <input id="color-26" type="button" class="in" onclick="Color(this.id)" style="background-color: #50ddd5;"
            value="">
          <input id="color-27" type="button" class="in" onclick="Color(this.id)" style="background-color: #addc81;"
            value="">
          <input id="color-28" type="button" class="in" onclick="Color(this.id)" style="background-color: #ffffba;"
            value="">
          <input id="color-29" type="button" class="in" onclick="Color(this.id)" style="background-color: #fea698;"
            value="">
          <input id="color-30" type="button" class="in" onclick="Color(this.id)" style="background-color: #b697dd;"
            value="">
          <br>
          <br>
          <input type="button" id="savebtn" onclick="Save_shift()" value="Save">
          <br id="hbr1" style="display:none">
          <label id="label1" style="visibility:hidden;color:red">Something went wrong. Check if object is selected or
            shift has proper name </label>
          <br>

          <h6>Existing shifts</h6>
          <br>
          <select name="option" id="option">
            <?php
            $mysqli2 = require __DIR__ . "/database.php";
            $sql2 = " SELECT * FROM list_of_objects ORDER BY id_object ASC";
            $result3 = $mysqli2->query($sql2);
            $mysqli2->close();
            $counter = 0;
            while ($rows_dat = mysqli_fetch_assoc($result3)) {
              if (null == $rows_dat['superior_object_name']) {
                if ($counter == 0) {
                  $first = $rows_dat['id_object'];
                }
                $counter++;
                ?>
                <option value="<?php echo $rows_dat['id_object'] ?>">
                  <?php echo $rows_dat['object_name']; ?>
                </option>
                <?php
              }
            }
            ?>
          </select>
          <br>
          <br>
          <div id="shift_ex_load">
          </div>
          <br>

          <script>
            var typ_btn = 1;
            var inp0 =
              <?php echo json_encode($first); ?>;
            $.ajax({


              url: "load_existing_shift.php",
              method: "POST",
              data: { input: inp0, type : typ_btn },
              success: function (data) {
                $("#shift_ex_load").html(data);
              }
            });


            $('#option').change(function () {
              var inp = $(this).val();
              $.ajax({


                url: "load_existing_shift.php",
                method: "POST",
                data: { input: inp, type : typ_btn  },
                success: function (data) {
                  $("#shift_ex_load").html(data);
                }
              });
            })
            var transfer = new Array();
            function Open_edit(clicked_id) {
              id_shift = clicked_id.substring(5);
              var modal = document.getElementById("myModal");
              var span = document.getElementsByClassName("close")[0];
              modal.style.display = "block";
              var arr;
              
              $.ajax({


                url: "edit_shift.php",
                method: "POST",
                dataType: "json",
                cache: false,
                async: false,
                data: { input: id_shift },
                success: function (data) {
                  arr = JSON.stringify(data);
                }
              });
              arr = arr.substring(1, arr.length - 1);
              transfer = arr.split(",");
              for (let i = 0; i < transfer.length; i++) {
                var wap = transfer[i];
                wap = wap.substring(1, wap.length - 1);
                transfer[i] = wap;
              }

              var inpp = transfer[23];
              var saas;
              $.ajax({
                url: "look_for_main_object.php",
                method: "POST",
                dataType: "json",
                cache: false,
                async: false,
                data: { input: inpp },
                success: function (data) {

                  saas = JSON.stringify(data);
                }
              });
              saas = saas.substring(1, saas.length - 2);
              var mainb = saas.substring(0, 1);
              var sideb = saas.substring(3);
              sColor(map1.get(transfer[22]));
              document.getElementById("select_obj").value = sideb;
              edit_obj(sideb, transfer[23]);

                
              document.getElementById("smonday").checked = false;
              document.getElementById("stuesday").checked = false;
              document.getElementById("swednesday").checked = false;
              document.getElementById("sthursday").checked = false;
              document.getElementById("sfriday").checked = false;
              document.getElementById("ssaturday").checked = false;
              document.getElementById("ssunday").checked = false;
              document.getElementById("sfrommonday").value = "";
              document.getElementById("stomonday").value = "";
              document.getElementById("sfromtuesday").value = "";
              document.getElementById("stotuesday").value = "";
              document.getElementById("sfromwednesday").value = "";
              document.getElementById("stowednesday").value = "";
              document.getElementById("sfromthursday").value = "";
              document.getElementById("stothursday").value = "";
              document.getElementById("sfromfriday").value = "";
              document.getElementById("stofriday").value = "";
              document.getElementById("sfromsaturday").value = "";
              document.getElementById("stosaturday").value = "";
              document.getElementById("sfromsunday").value = "";
              document.getElementById("stosunday").value = "";

              if (transfer[0] == 1) {
                document.getElementById("smonday").checked = true;
                var mf = transfer[1];
                mf = mf.substring(0, 5);
                document.getElementById("sfrommonday").value = mf;
                var mf = transfer[2];
                mf = mf.substring(0, 5);
                document.getElementById("stomonday").value = mf;
              }
              if (transfer[3] == 1) {
                document.getElementById("stuesday").checked = true;
                var mf = transfer[4];
                mf = mf.substring(0, 5);
                document.getElementById("sfromtuesday").value = mf;
                var mf = transfer[5];
                mf = mf.substring(0, 5);
                document.getElementById("stotuesday").value = mf;
              }
              if (transfer[6] == 1) {
                document.getElementById("swednesday").checked = true;
                var mf = transfer[7];
                mf = mf.substring(0, 5);
                document.getElementById("sfromwednesday").value = mf;
                var mf = transfer[8];
                mf = mf.substring(0, 5);
                document.getElementById("stowednesday").value = mf;
              }
              if (transfer[9] == 1) {
                document.getElementById("sthursday").checked = true;
                var mf = transfer[10];
                mf = mf.substring(0, 5);
                document.getElementById("sfromthursday").value = mf;
                var mf = transfer[11];
                mf = mf.substring(0, 5);
                document.getElementById("stothursday").value = mf;
              }
              if (transfer[12] == 1) {
                document.getElementById("sfriday").checked = true;
                var mf = transfer[13];
                mf = mf.substring(0, 5);
                document.getElementById("sfromfriday").value = mf;
                var mf = transfer[14];
                mf = mf.substring(0, 5);
                document.getElementById("stofriday").value = mf;
              }
              if (transfer[15] == 1) {
                document.getElementById("ssaturday").checked = true;
                var mf = transfer[16];
                mf = mf.substring(0, 5);
                document.getElementById("sfromsaturday").value = mf;
                var mf = transfer[17];
                mf = mf.substring(0, 5);
                document.getElementById("stosaturday").value = mf;
              }
              if (transfer[18] == 1) {
                document.getElementById("ssunday").checked = true;
                var mf = transfer[19];
                mf = mf.substring(0, 5);
                document.getElementById("sfromsunday").value = mf;
                var mf = transfer[20];
                mf = mf.substring(0, 5);
                document.getElementById("stosunday").value = mf;
              }

              document.getElementById("sfield").value = transfer[21];
            }


            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 


            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
              modal.style.display = "none";

            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
              if (event.target == modal) {
                modal.style.display = "none";

              }
            }

          </script>
        </div>



      </div>
      </div>

    <?php else: ?>
    <?php endif; ?>
</body>
<script>
  document.getElementById('sr').valueAsDate = new Date();
  document.cookie = "myval= " + document.getElementById('sr').value;

</script>
<script>
  function cr() {
    var s = document.getElementById('sr').value;
    <?php
    faasr();
    ?>

  }
  <?php
  function faasr()
  {
   
  }
  ?>

</script>
<script>
</script>


<script>
  document.getElementById('everyday').onclick = function () {
    var mo = document.getElementById('monday');
    var tu = document.getElementById('tuesday');
    var we = document.getElementById('wednesday');
    var th = document.getElementById('thursday');
    var fr = document.getElementById('friday');
    var sa = document.getElementById('saturday');
    var su = document.getElementById('sunday');
    if (mo.checked == true) {
      mo.checked = false;
    } else {
      mo.checked = true;
    }
    if (tu.checked == true) {
      tu.checked = false;
    } else {
      tu.checked = true;
    }
    if (we.checked == true) {
      we.checked = false;
    } else {
      we.checked = true;
    }
    if (th.checked == true) {
      th.checked = false;
    } else {
      th.checked = true;
    }
    if (fr.checked == true) {
      fr.checked = false;
    } else {
      fr.checked = true;
    }
    if (sa.checked == true) {
      sa.checked = false;
    } else {
      sa.checked = true;
    }
    if (su.checked == true) {
      su.checked = false;
    } else {
      su.checked = true;
    }

  }
  document.getElementById('everyworkday').onclick = function () {

    var mo = document.getElementById('monday');
    var tu = document.getElementById('tuesday');
    var we = document.getElementById('wednesday');
    var th = document.getElementById('thursday');
    var fr = document.getElementById('friday');
    if (mo.checked == true) {
      mo.checked = false;
    } else {
      mo.checked = true;
    }
    if (tu.checked == true) {
      tu.checked = false;
    } else {
      tu.checked = true;
    }
    if (we.checked == true) {
      we.checked = false;
    } else {
      we.checked = true;
    }
    if (th.checked == true) {
      th.checked = false;
    } else {
      th.checked = true;
    }
    if (fr.checked == true) {
      fr.checked = false;
    } else {
      fr.checked = true;
    }

  }
  document.getElementById('weekend').onclick = function () {


    var sa = document.getElementById('saturday');
    var su = document.getElementById('sunday');

    if (sa.checked == true) {
      sa.checked = false;
    } else {
      sa.checked = true;
    }
    if (su.checked == true) {
      su.checked = false;
    } else {
      su.checked = true;
    }
  }
  function myFunction() {//w ww  . jav a 2 s  .  c  o m
    if (document.getElementById("monday").checked) {
      document.getElementById("frommonday").value = document.getElementById("from").value;
      document.getElementById("tomonday").value = document.getElementById("to").value;
    }
    if (document.getElementById("tuesday").checked) {
      document.getElementById("fromtuesday").value = document.getElementById("from").value;
      document.getElementById("totuesday").value = document.getElementById("to").value;
    }
    if (document.getElementById("wednesday").checked) {
      document.getElementById("fromwednesday").value = document.getElementById("from").value;
      document.getElementById("towednesday").value = document.getElementById("to").value;
    }
    if (document.getElementById("thursday").checked) {
      document.getElementById("fromthursday").value = document.getElementById("from").value;
      document.getElementById("tothursday").value = document.getElementById("to").value;
    }
    if (document.getElementById("friday").checked) {
      document.getElementById("fromfriday").value = document.getElementById("from").value;
      document.getElementById("tofriday").value = document.getElementById("to").value;
    }
    if (document.getElementById("saturday").checked) {
      document.getElementById("fromsaturday").value = document.getElementById("from").value;
      document.getElementById("tosaturday").value = document.getElementById("to").value;
    }
    if (document.getElementById("sunday").checked) {
      document.getElementById("fromsunday").value = document.getElementById("from").value;
      document.getElementById("tosunday").value = document.getElementById("to").value;
    }
  }


</script>

<script>
  let form = document.querySelector('#main_f');





  form.addEventListener('submit', function (event) {

    // Ignore the #toggle-something button
    if (event.submitter.matches('#paste')) {
      event.preventDefault();
    }

    console.log('Someone said hi!');

  });

</script>
</form>

</html>