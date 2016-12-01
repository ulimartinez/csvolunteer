<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
  }
  else if($_SESSION['user_type'] == "admin" OR $_SESSION['user_type'] == "staff"){
    $nav = 'navbar-loggedin.php';
  }
  else{
    //isnt allowed
    header("Location: login.html");
    exit();
  }
  require("config.php");
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM events WHERE approved = 0";
  $result = $conn->query($sql);
  if($result){
    $data = $result->fetch_all();
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

  <!-- Navigation -->
  <?php include $nav; ?>

    <section>
      <div class="container">
        <div class="row">
          <h3>Not Approved Events</h3>
          <div class="row">
              <?php
              if(true){
                echo '<table class="table table-striped">
                  <thead>
                    <td>Event</td>
                    <td>Date</td>
                    <td>Location</td>
                    <td>Creator</td>
                    <td>Approve</td>
                  </thead>';
                  foreach ($data as $row) {
                    echo '<tr data-eventid="'.$row[0].'"><td>'.$row[1].'</td><td>'.$row[3].'</td><td>'.$row[5].'</td><td><a target="_blank" href="student.php?id='.$row[8].'">View Creator</a></td><td><button type="button" class="btn btn-success approve">Approve</button></td></tr>';
                  }
                echo '</table>';
              }

              ?>
          </div>
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
    <script>
    $('.approve').click(function(e){
      var eventId = $(this).closest('tr').data('eventid');
      $.post('eventHandler.php', {'approve':true, 'eventid':eventId}, function(data){
        if(data.hasOwnProperty('success')){
          alert("Event approved");
          $(this).closest('tr').remove();
        }
        else if(data.hasOwnProperty('error')){
          alert(data.error);
        }
      });
    });
    </script>

</body>

</html>
<?php $conn->close(); ?>
