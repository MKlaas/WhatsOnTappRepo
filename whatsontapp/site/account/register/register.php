
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Fullscreen Responsive Register Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="header">
		<center>
            <div class="container">
                <div class="row">
			
                    <div class="logo span4" style="margin-right: 190px; margin-left: 180px;">
					
                        <h1><a href="">What's on Tapp </a></h1>
						
                    </div>
					
                    <div class="links span8">
                       
                    </div>
                </div>
				</center>
            </div>
        </div>

        <div class="register-container container">
            <div class="row">
                <div class="iphone span5">


                </div>
                <div class="register span6" style="margin-right: 80px; margin-left: 250px;">
                    <form action="" method="post">
                        <h2>REGISTER for <span class="red"><strong>Tapp</strong></span></h2>
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="enter your first name...">
                        <label for="lastname">Last Name</label>
						<input type="text" id="lasttname" name="lastname" placeholder="enter your Last name...">
						<label for="city">City:</label>
						<input type="text" name="city" id="city" placeholder="enter your City...">
						<label for="state">State:</label>
						<input type="text" name="state" id="state" placeholder="enter your State...">
						<label for="zipcode">Zip code</label>
                        <input type="text" id="zipcode" name="zipcode" placeholder="enter your zip code...">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="choose a username...">
                        <label for="email">Email</label>
                        <input type="text" id="" name="email" placeholder="enter your email...">
                        <label for="password">Password</label>
						<input type="password" id="password" name="password" placeholder="choose a password...">
                        <button type="submit" name="insert">REGISTER</button>
						<?php 
						include('../core/init_register-update.php');
						if(isset($_POST['insert'])){
							AddUser();
						}
						?>
                    </form>

					<script>
function checkForm(form)
  {
    // validation fails if the input is blank
    if(form.password.value == "") {
      alert("Error: Input is empty!");
      form.inputfield.focus();
      return false;
    }

    // regular expression to match only alphanumeric characters and spaces
    var re = /^[\w ]+$/;

    // validation fails if the input doesn't match our regular expression
    if(!re.test(form.password.value)) {
      alert("Error: Input contains invalid characters!");
      form.inputfield.focus();
      return false;
    }
	</script>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>

