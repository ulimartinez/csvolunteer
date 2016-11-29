<?php
  session_start();
  if(!isset($_SESSION['loggedin']) OR !$_SESSION['loggedin']){
    header('Location: login.html');
    exit();
  }
  else if($_SESSION['admin']){
    //is admin
    $nav = file_get_contents('navbar-admin.php');
  }
  else {
    //isnt admin
    $nav = file_get_contents('navbar-user.php');
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
  <?php echo $nav; ?>

    <section>
      <div class="container">
        <div class="row">
          <h3>Students</h3>
          <div id="student-holder"></div>
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
    var template = '<div class="col-sm-4 col-lg-4 col-md-4">'+
      '<div class="thumbnail">'+
          '<img src="http://placehold.it/150x200" alt="">'+
          '<div class="caption">'+
              '<h4><a href="#" class="fname">Some student</a>'+
              '</h4><small class="lname"></small>'+
              '<p><a class="mail" href="mailto:"></a></p>'+
          '</div>'+
      '</div>'+
    '</div>';
    $(document).ready(function(){
      //do stuff
      $.get('studentHandler.php', {'all':true}, function(data){
        if(data.hasOwnProperty('students')){
          var students = data.students;
          students.forEach(function(e, i){
            var $template = $(template);
            $template.find('.fname').text(e[1]);
            $template.find('.lname').text(e[2]);
            $template.find('a').attr('href', 'student.php?id=' + e[0]);
            $template.find('.mail').text(e[8]);
            $template.find('.mail').attr('href', "mailto:"+e[8]);
            $('#student-holder').append($template);
          })
        }
      });
    });
    </script>

</body>

</html>
