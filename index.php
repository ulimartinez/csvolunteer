<?php
  session_start();
  if(isset($_SESSION['user_id'])){
    $nav = 'navbar-loggedin.php';
  }
  else {
    //isnt logged in
    $nav = 'navbar-user.php';
  }
  require("config.php");
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $num_events = 0;
  $num_students = 0;
  $num_hours = 0;
  $sql = "SELECT COUNT(*) FROM events WHERE approved=1";
  $result = $conn->query($sql);
  if($result){
    $num_events = $result->fetch_array()[0];
  }
  $sql = "SELECT COUNT(*) FROM students";
  $result = $conn->query($sql);
  if($result){
    $num_students = $result->fetch_array()[0];
  }
  $sql = "SELECT SUM(hours) FROM students";
  $result = $conn->query($sql);
  if($result){
    $num_hours = $result->fetch_array()[0];
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
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1204946196223876";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <!-- Navigation -->
  <?php include $nav; ?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">CS Volunteer</div>
                <div class="intro-heading">Volunteer Oportunities</div>
                <a href="events.php" class="page-scroll btn btn-xl">Find Events</a>
            </div>
        </div>
    </header>
    <section>
      <div class="container">
        <div class="col-md-8">
          <h4>Number of Events:</h4><?php echo $num_events; ?>
          <h4>Number of Students:</h4><?php echo $num_students; ?>
          <h4>Total hours volunteered:</h4><?php echo $num_hours; ?>
        </div>
        <div class="col-md-4">
          <div class="fb-page" data-href="https://www.facebook.com/CS-Volunteering-Events-987932044645133" data-tabs="timeline" data-width="900" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CS-Volunteering-Events-987932044645133" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CS-Volunteering-Events-987932044645133">CS Volunteering Events</a></blockquote></div>
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

</body>

</html>
