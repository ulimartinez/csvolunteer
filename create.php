<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('Location: login.html');
    exit();
  }
  else if($_SESSION['user_type'] === "admin"){
    //is admin
    $isAdmin = true;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#222222" />

    <title>CaeruleusDB</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- datepicker -->
    <link href='css/clockpicker.css' rel='stylesheet' />
    <!-- date picker -->
    <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">
  <!-- Navigation -->
  <?php include 'navbar-loggedin.php'; ?>

    <section>
      <!-- Page Content -->
      <div class="container">

          <!-- Page Heading/Breadcrumbs -->
          <div class="row">
              <div class="col-lg-12">
                  <h1 id="event-title" class="page-header">New Event</h1>
                  <ol class="breadcrumb">
                      <li><a href="index.php">Home</a>
                      </li>
                      <li class="active">Create Event</li>
                  </ol>
              </div>
          </div>
          <!-- /.row -->

          <!-- Image Header -->
          <div class="row">
              <div class="col-lg-12 text-center">
                  <img class="img-responsive image" id="picture" src="http://placehold.it/1200x300" alt="">
              </div>
          </div>
          <input type="file" id="file" name="file" accept="image/*" style="display: none;" hidden autocomplete="off" />
          <!-- /.row -->

          <!-- Service Tabs -->
          <div class="row">
              <div class="col-lg-12">
                  <h2 class="page-header">Properties</h2>
              </div>
              <div class="col-lg-12">

                  <ul id="myTab" class="nav nav-tabs nav-justified">
                      <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-pencil"></i> Event Name</a>
                      </li>
                      <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-clock-o"></i> Date &amp; Time</a>
                      </li>
                      <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-list"></i> Time Slots</a>
                      </li>
                      <li class=""><a href="#service-four" data-toggle="tab"><i class="fa fa-list"></i> Skills</a>
                      </li>
                      <li class=""><a href="#service-five" data-toggle="tab"><i class="fa fa-ellipsis-v"></i> Description</a>
                      </li>
                  </ul>

                  <div id="myTabContent" class="tab-content">
                      <div class="tab-pane fade active in" id="service-one">
                          <h4>Event Name</h4>
                          <form>
                          	<div class="form-group">
                          		<label for="title">Event Title:</label>
                          		<input type="text" class="form-control" id="title" />
                          	</div>
                            <div class="form-group">
                          		<label for="title">Event Location:</label>
                          		<input type="text" class="form-control" id="place" />
                          	</div>
                          </form>
                      </div>
                      <div class="tab-pane fade" id="service-two">
          							<h4>Date &amp; Time</h4>
          							<div class="container">
          								<div class="row">
          									<div class='col-sm-6'>
          										<div class="form-group">
          											<div class='input-group date'>
          												<input type='text' class="form-control" id="datetimepicker" />
          												<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
          											</div>
          										</div>
          									</div>
          								</div>
          							</div>
          						</div>
                      <div class="tab-pane fade" id="service-three">
                          <h4>Time Slots</h4>
                          <form>
                            <div class="row">
                            	<div class="form-group">
                            		<label for="numSlots">Number of Slots:</label>
                                    <input class="form-control" type="number" id="numSlots" min="1" value="1"/>
                            	</div>
                            </div>
                            <div id="slotsWrapper">
                          	  <div class="row slotsInputGroup">
                            		<div class="form-group col-sm-5">
                                  <div class="input-group">
                                    <span class="input-group-addon">Start</span>
                                    <input type="text" class="form-control timeSlotStart" placehold="Start time" value=""/>
                                  </div>
                                </div>
                                <div class="form-group col-sm-5">
                                  <div class="input-group">
                                    <span class="input-group-addon">End</span>
                                    <input type="text" class="form-control timeSlotEnd" placehold="End time" value=""/>
                                  </div>
                                </div>
                                <div class="form-group col-sm-2">
                                  <div class="input-group">
                                    <span class="input-group-addon"># Required</span>
                                    <input type="number" class="form-control timeSlotSpots" value="1"/>
                                  </div>
                                </div>
                            	</div>
                            </div>
                          </form>
                      </div>
                      <div class="tab-pane fade" id="service-four">
                          <h4>Skills Required</h4>
                          <form>
                            <div id="skillsWrapper">
                          	  <div class="row skillsInputGroup">
                            		<div class="form-group col-sm-12">
                                  <div class="input-group">
                                    <input type="text" class="form-control skillText">
                                    <div class="input-group-btn">
                                      <!-- Buttons -->
                                      <button class="btn btn-success addSkill" type="button">+</button>
                                      <button class="btn btn-danger removeSkill" type="button">-</button>
                                    </div>
                                  </div><!-- /input-group -->
                                </div>
                            	</div>
                            </div>
                          </form>
                      </div>
                      <div class="tab-pane fade" id="service-five">
                          <h4>Skills Required</h4>
                          <textarea class="form-control" placeholder="event description..." rows="3" id="description"></textarea>
                      </div>
                  </div>

              </div>
          </div>

          <hr>
          <!-- TODO: remove delete if its a new event? -->
          <a href="#" id="delete" class="btn btn-danger btn-lg pull-left">Delete</a>
          <a href="#" id="save" class="btn btn-primary btn-lg pull-right">Save</a>
          <!-- Footer -->
          <footer>
              <div class="row">
                  <div class="col-lg-12">
                      <p>Copyright &copy; Your Website 2014</p>
                  </div>
              </div>
          </footer>

      </div>
      <!-- /.container -->
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; CaeruleusDB 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- date picker -->
    <script src='js/moment.js'></script>
    <script src="js/clockpicker.js"></script>
    <!--date picker -->
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <script>
    $('#picture').click(function(e){
      $('#file').click();
    });
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#picture').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    function setTimepickers($group){
      var $start = $group.find('.timeSlotStart');
      var $end = $group.find('.timeSlotEnd');
      $start.clockpicker({
          placement: 'bottom',
          align: 'left',
          donetext: 'Done',
          autoclose: true
      });
      $end.clockpicker({
          placement: 'bottom',
          align: 'left',
          donetext: 'Done',
          autoclose: true
      });
      return true;
    }
    function placeInputGroups(num){
      var $template = $($('#slotsWrapper').children('.slotsInputGroup')[0]);
      console.log(num);
      $('#slotsWrapper').empty();
      for(var i = 0; i < num; i++){
        $group = $template.clone();
        setTimepickers($group);
        $group.appendTo('#slotsWrapper');
      }
    }
    function getSlot(index){
      var $group = $($('#slotsWrapper').children('.slotsInputGroup')[index]);
      var str = "{\"start\":\"";
      str += $group.find('.timeSlotStart').val() +"\", \"end\":\"";
      str+= $group.find('.timeSlotEnd').val() + "\", \"num\":" + $group.find('.timeSlotSpots').val() + "}";
      return str;
    }
    function getSkill(index){
      var $group = $($('#skillsWrapper').children('.skillsInputGroup')[index]);
      return $group.find('.skillText').val()
    }

    $(document).ready(function(){
      placeInputGroups(1);
      $('#numSlots').change(function(){
        placeInputGroups($('#numSlots').val());
      });
      $('#datetimepicker').datetimepicker({
        'format':"Y-MM-D H:M:S"
      });
      $('#skillsWrapper').delegate('.addSkill', 'click', function(e){
        //add a skill
        var $template = $($('#skillsWrapper').children('.skillsInputGroup')[0]);
        $template.clone().appendTo('#skillsWrapper');
      });
      $('#skillsWrapper').delegate('.removeSkill', 'click', function(e){
        //remove a skill
        if($('#skillsWrapper').children('.skillsInputGroup').length > 1){
          $(this).closest('.skillsInputGroup').remove();
        }
      });
    });

    $("#file").change(function(){
        readURL(this);
    });
    $('#save').click(function(e){
      //save the stuff
      var formData = new FormData();
      formData.append('image', $('input[type=file]')[0].files[0]);
      formData.append('title', $('#title').val());
      formData.append('datetime', $('#datetimepicker').val());
      formData.append('place', $('#place').val());
      formData.append('description', $('#description').val());
      formData.append('create', 'true');
      for(var i = 0; i < $('#numSlots').val(); i++){
        formData.append('slots[]', getSlot(i));
      }
      for(var i = 0; i < $('#skillsWrapper').children('.skillsInputGroup').length; i++){
        formData.append('skills[]', getSkill(i));
      }
      $.ajax({
        'method':'post',
        'url': 'eventHandler.php',
        'data':formData,
        'contentType': false,
        'processData': false,
        'success':function(responsedata){
          if(responsedata.hasOwnProperty('success')){
            window.location = 'events.php';
          }
        }
      });
    });
    </script>

</body>

</html>
