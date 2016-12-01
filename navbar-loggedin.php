<?php session_start(); ?>
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
            <a class="navbar-brand" href="index.php#page-top">CSVolunteer</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <?php
                if($_SESSION['user_type'] == "admin" OR $_SESSION['user_type'] == "staff"){
                  echo '<li><a href="students.php">View Students</a></li>';
                  echo '<li><a href="requests.php">View Requests</a></li>';
                }
                else if($_SESSION['user_type'] == "student"){
                  echo '<li><a href="profile.php?id='.$_SESSION['user_id'].'">My Profile</a></li>';
                }
                ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="events.php">View Events</a></li>
                    <li><a href="create.php">Create Event</a></li>
                  </ul>
                </li>
                <li>
                    <a href="#">Volunteer of the month</a>
                </li>
                <li>
                  <a class="page-scroll" href="login.php?logout=true">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
