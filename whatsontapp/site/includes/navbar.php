<?php
include('./account/core/init_profile.php'); 
?>

<body style="background-image:url('http://shutterstock.7eer.net/c/39150/43068/1305?u=http%3A%2F%2F');">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" >What's on Tapp</a>
				<p style="float:right;margin-left:350px;margin-top:12px;text-transform:uppercase;font-weight:bold;font-family:courier new;color:lightblue;"><i>Welcome, <?php echo $login_session; ?>!</i></p>
            </div>
					
		
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul  class="nav navbar-nav navbar-right">
                    <li>
                        <a href="services.php">Services</a>
                    </li>
					<li>
                        <a href="account/register/update.php">Update Info</a>
                    </li>
					<li>
                        <a href="account/logout.php">Logout</a>
                    </li>
			
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	