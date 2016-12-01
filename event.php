<?php
  session_start();
  if(isset($_SESSION['user_id'])){
    $nav = 'navbar-loggedin.php';
  }
  else {
    //isnt logged in
    $nav = 'navbar-user.php';
  }
  $event_id = $_GET['id'];
  $sql = "SELECT * FROM events WHERE id = $event_id";
  require("config.php");
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $result = $conn->query($sql);
  if($result){
    $data = $result->fetch_assoc();
  }
  $sum = 0;
  $sql = "SELECT SUM(hours) FROM participate WHERE event_id = $event_id";
  $result = $conn->query($sql);
  if($result){
    $sum = $result->fetch_array()[0];
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
          <h3>Event</h3>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <?php if($data['photo']){
                echo '<img class="ev-img-full" src="data:image/png;base64,'.base64_encode($data['photo']).'">';
              }
              else{
                echo '<img src="http://placehold.it/800x400">';
              }
              $sql = "SELECT skill FROM event_skills WHERE event_id=$event_id";
              $result = $conn->query($sql);
              if($result){
                foreach ($result->fetch_all() as $skill) {
                  echo '<span class="badge">'.$skill[0].'</span>';
                }
              }
              ?>
              <h4>Location:</h4> <?php echo $data['place']; ?>
              <h4>Time:</h4> <?php echo $data['time']; ?>
              <h4>Date:</h4> <?php echo $data['date']; ?>
              <h4>Description:</h4> <?php echo $data['description']; ?>
              <h4>Hours volunteered at this event:</h4> <?php echo $sum; ?>
            </div>
          </div>
          <div class="row">
              <?php
              if(isset($_SESSION['user_id']) AND $_SESSION['user_type'] == "student"){
                echo '<table class="table table-striped">
                  <thead>
                    <td>Start Time</td>
                    <td>End Time</td>
                    <td>Hours</td>
                    <td>Participate</td>
                  </thead>';
                $sql = "SELECT * FROM time_slots WHERE event_id=$event_id";
                $result = $conn->query($sql);
                if($result){
                  $rows = $result->fetch_all();
                  foreach ($rows as $row) {
                    echo '<tr data-timeid="'.$row[0].'" data-eventid="'.$row[2].'"><td>'.$row[1].'</td><td>'.$row[5].'</td><td class="hours">'.$row[6].'</td><td><button type="button" class="btn btn-success participate">Participate</button></td></tr>';
                  }
                }
                echo '</table>';
              }

              ?>
          </div>
        </div>
        <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_type'] == "admin"){
          echo '<div class="row"><div class="btn-group col-md-offset-9" role="group"><button type="button" class="btn btn-danger" id="delete">Delete Event</button></div></div>';
        }
        ?>
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
    $('.participate').click(function(e){
      var eventId = $(this).closest('tr').data('eventid');
      var timeId = $(this).closest('tr').data('timeid');
      var userId = <?php echo $_SESSION['user_id']; ?>;
      $.post('eventHandler.php', {'participate':true, 'eventid':eventId, 'timeid':timeId, 'userid':userId, 'hours':$(this).closest('td').siblings('.hours').text()}, function(data){
        if(data.hasOwnProperty('success')){
          alert("You are now participating in this event");
        }
        else if(data.hasOwnProperty('error')){
          alert(data.error);
        }
      });
    });
    $('#delete').click(function(e){
      if(confirm("Are you sure you want to delete this event?")){
        $.post('eventHandler.php', {'delete': true, 'eventid':<?php echo $event_id;?>}, function(data){
          if(data.hasOwnProperty("success")){
            window.location = "events.php";
          }
        });
      }
    });
    </script>

</body>

</html>
<?php $conn->close(); ?>
