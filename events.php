<?php
  session_start();
  if(isset($_SESSION['user_id'])){
    $nav = 'navbar-loggedin.php';
  }
  else {
    //isnt admin
    $nav = 'navbar-user.php';
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
  <?php include $nav; ?>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-2">
            <div class="form-group">
              <div class='input-group date'>
                <input type='text' class="form-control" id="from" />
                <span class="input-group-addon">From</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <div class='input-group date'>
                <input type='text' class="form-control" id="to" disabled=""/>
                <span class="input-group-addon">To</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <h3>Events</h3>
          <div id="event-holder"></div>
        </div>
      </div>
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

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>
    <!--date picker -->
    <script src='js/moment.js'></script>
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <script>
    var template = '<div class="col-sm-6 col-lg-6 col-md-6">'+
      '<div class="thumbnail">'+
          '<img src="http://placehold.it/500x300" class="ev-img" alt="">'+
          '<div class="caption">'+
              '<h4><a href="#" class="title">Some event</a>'+
              '</h4><small class="location"></small><small> on </small><small class="date"></small>'+
              '<p class="description"></p>'+
              '<p>See more information about this event by clicking <a class="link" href="#">here</a>.</p>'+
          '</div>'+
      '</div>'+
    '</div>';
    $(document).ready(function(){
      $('#from').datetimepicker({
        'format':"Y-M-D"
      });
      $('#to').datetimepicker({
        'format':"Y-M-D",
        'useCurrent':false
      });
      $("#from").on("dp.change", function (e) {
        $('#to').removeProp('disabled');
            $('#to').data("DateTimePicker").minDate(e.date);
        });
        $("#to").on("dp.change", function (e) {
            $('#from').data("DateTimePicker").maxDate(e.date);
            $.get('eventHandler.php', {'range':true, 'start':$('#from').val(), 'end':$('#to').val()}, function(data){
              if(data.hasOwnProperty('events')){
                $('#event-holder').empty();
                var events = data.events;
                events.forEach(function(e, i){
                  var $template = $(template);
                  $template.find('.location').text(e[5]);
                  $template.find('.date').text(e[3]);
                  $template.find('.title').text(e[1]);
                  $template.find('a').attr('href', 'event.php?id=' + e[0]);
                  if(e[14]!= null){
                    $template.find('.description').text(e[14]);
                  }
                  if(e[13] !== ""){
                    $template.find('img').attr('src', "data:image/png;base64," + e[13]);
                  }
                  $('#event-holder').append($template);
                });
              }
            });
        });
      //do stuff
      $.get('eventHandler.php', {'all':true}, function(data){
        if(data.hasOwnProperty('events')){
          var events = data.events;
          events.forEach(function(e, i){
            var $template = $(template);
            $template.find('.location').text(e[3]);
            $template.find('.date').text(e[2]);
            $template.find('.title').text(e[1]);
            $template.find('a').attr('href', 'event.php?id=' + e[0]);
            if(e[4]!= null){
              $template.find('.description').text(e[4]);
            }
            $.get('eventHandler.php', {"image":true, "event_id":e[0]}, function(data2){
              if(data2.photo !== ""){
                $template.find('img').attr('src', "data:image/png;base64," + data2.photo);
              }
            });
            $('#event-holder').append($template);
          });
        }
      });
    });
    </script>

</body>

</html>
