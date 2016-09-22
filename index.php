<?php
  session_start();
  if(!isset($_SESSION['loggedin']) OR !$_SESSION['loggedin']){
    header('Location: login.html');
    exit();
  }
  else if($_SESSION['admin']){
    //is admin
  }
  else {
    //isnt admin
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

    <title>MARTECH</title>

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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">CSVolunteer</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Events</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Volunteer of the month</a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Report 1</a></li>
                        <li><a href="#">Report 2</a></li>
                        <li><a href="#">Report 3</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">CS Volunteer</div>
                <div class="intro-heading">Volunteer Oportunities</div>
                <a href="#services" class="page-scroll btn btn-xl">Find Events</a>
            </div>
        </div>
    </header>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; MARTECH 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="https://www.facebook.com/martechnologic"><i class="fa fa-facebook"></i></a>
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

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Diseño de sitio web</h2>
                            <p class="item-intro text-muted">Center for Transportation Infrastrucutre Systems.</p>
                            <img class="img-responsive img-centered" src="img/portfolio/ctiswebsite.png" alt="">
                            <p>Se diseño un nuevo sitio web para el CTIS. Fue disenado con principios como diseño responsivo.</p>
                            <p>Para este proyecto se diseño la pagina web y al mismo tiempo un sistema de gestion de contenidos.</p>
                            <ul class="list-inline">
                                <li>Fecha: Julio 2014</li>
                                <li>Cliente: CTIS</li>
                                <li>Categoria: diseño Web</li>
                                <li>Enlace: <a href="http://ctis.utep.edu">Visita este sitio</a></li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Diseño de sitio web</h2>
                            <p class="item-intro text-muted">Novadent</p>
                            <img class="img-responsive img-centered" src="img/portfolio/novadent-website.png" alt="">
                            <p>Se diseño un nuevo sitio web para un consultorio de odontologia. Este sitio tuvo incluidas aplicaciones web para el manejo de los servicios que el consultorio requeria, tales como manejo de citas, vicualizacion de finansas, entre otros.</p>
                            <ul class="list-inline">
                                <li>Date: Abril 2016</li>
                                <li>Client: Novadent</li>
                                <li>Category: diseño Web</li>
                                <li>          Applicaciones Web</li>
                                <li><a href="novadent">Ir a Novadent!</a></li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        $(function() {
            $(".roll").attr("data-words", function(i, d){
                var $self  = $(this),
                    $words = d.split("|"),
                    tot    = $words.length,
                    c      = 0;

                // CREATE SPANS INSIDE SPAN
                for(var i=0; i<tot; i++) $self.append($('<span/>',{text:$words[i]}));

                // COLLECT WORDS AND HIDE
                $words = $self.find("span").hide();

                // ANIMATE AND LOOP
                (function loop(){
                  $self.animate({ width: $words.eq( c ).width() });
                  $words.stop().fadeOut().eq(c).fadeIn().delay(1000).show(0, loop);
                  c = ++c % tot;
                }());

            });
            //autofill form
            $('.fillContact').click(function(e){
            	var msg = "";
            	$('#message').val(msg);
            	if($(this).data('interest') === "software"){
            		msg = "Hola, estoy interesado en el desarrollo de un programa para...\n";
            	}
            	else if($(this).data('interest') === "web"){
            		msg = "Hola, me gustaría tener una página web. La necesito que la página tenga ...\n";
            	}
            	$('#message').val(msg);
            });
        });
    </script>
    <script src="js/ganalitics.js"></script>

</body>

</html>
