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
  <!-- admin modal-->
  <div class="modal fade" id="adminModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Create Administrator</h4>
        </div>
        <div class="modal-body">
          <form id="adminForm" action="userHandler.php">
            <div class="form-group">
              <label for="adminUsername" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="adminUsername" placeholder="name" name="username">
              </div>
            </div>
            <div class="form-group">
              <label for="adminpwd" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="adminpwd" placeholder="name" name="password">
                <input type="hidden" style="display: none;" name="create" value="admin">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saveUser">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- student modal-->
  <div class="modal fade" id="studentModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Create Student</h4>
        </div>
        <div class="modal-body">
          <form id="userForm" action="userHandler.php">
            <div class="form-group">
              <label for="eventName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="eventName" placeholder="name" name="name">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saveUser" >Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- staff modal-->
  <div class="modal fade" id="staffModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Create Staff/Faculty Member</h4>
        </div>
        <div class="modal-body">
          <form id="userForm" action="userHandler.php">
            <div class="form-group">
              <label for="userName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="userName" placeholder="name" name="name">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saveUser">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- noncs modal-->
  <div class="modal fade" id="nonCSModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Create Non-CS User</h4>
        </div>
        <div class="modal-body">
          <form id="userForm" action="eventHandler.php">
            <div class="form-group">
              <label for="eventName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="eventName" placeholder="name" name="name">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saveUser">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Navigation -->
  <?php include 'navbar-loggedin.php'; ?>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Create Student</div>
                        </div>
                    </div>
                </div>
                <a data-toggle="modal" href="#studentModal">
                    <div class="panel-footer">
                        <span class="pull-left">Create</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div>Create Staff/Faculty</div>
                        </div>
                    </div>
                </div>
                <a data-toggle="modal" href="#staffModal">
                    <div class="panel-footer">
                        <span class="pull-left">Create</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Create Non-CS</div>
                        </div>
                    </div>
                </div>
                <a data-toggle="modal" href="#nonCSModal">
                    <div class="panel-footer">
                        <span class="pull-left">Create</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div>Create Administrator</div>
                        </div>
                    </div>
                </div>
                <a data-toggle="modal" href="#adminModal">
                    <div class="panel-footer">
                        <span class="pull-left">Create</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
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
    $(document).ready(function(){
      $('.saveUser').click(function(e){
        console.log("Hi");
        var $form = $(this).parent().siblings('.modal-body').find('form')[0];
        var formdata = new FormData($form);
          $.ajax({
          	'method':'post',
          	'url':$form.action,
          	'data':formdata,
          	'contentType': false,
          	'processData': false,
          	'success':function(responsedata){
          		$('#myModal').modal('hide');
          	}
          });
      });
    });
    </script>

</body>

</html>
