<?php
include('core\init_profile.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">

<b id="welcome">Welcome! <i><?php echo $login_session; ?></i></b> <br/>


<b>Go to index </b><a href="../index.php">Go To Main Page</a> <br/>

<b id="update"><a href="/whatsontapprepo/whatsontapp/site/account/register/update.php">Update Info</a></b><br/>
<b id="logout"><a href="/whatsontapprepo/whatsontapp/site/account/logout.php">Log Out</a></b>


</div>
</body>
</html>