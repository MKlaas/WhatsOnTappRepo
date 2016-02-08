<?php
//error_reporting(E_ERROR | E_PARSE);  
session_start();
if(!isset($_SESSION['login_user'])){
   //redirect or other you want
   header("Location: account/login.php"); // Redirecting To Home Page
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

    <title>Bar Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
      <?php
      include('includes/navbar.php'); 
      ?>
<?php include('core/init_barpage.php'); if($loaded == false)
{
    include('core/init_connect.php');
    // for the bars table
    $delete_barquery="DELETE FROM dbtablebar WHERE BarID = '$barID' LIMIT 1";
    $delete_barresult=mysqli_query($connection, $delete_barquery) or die('Could not remove bar information ' . mysqli_error($connection)); 
    echo "<p style='color:red; text-align:center;'>Sorry we are having trouble loading info for ".$barName." at ".$barAddress." , " . $barZipCode .".<br/> Please check the information and try to add it again. If you're positive this is the info, <a href='mailto:whatsontapp3@gmail.com'>Contact Us</a> to let us know! </p>";
    echo "<script> /*";
} ?> 
      <!-- Page Content -->
      <div class="container">
       


        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php 
                    echo $barName;
                    ?>
                </h1>
				<!--
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">About</li>
                </ol>
            -->
        </div>
    </div>
    <!-- /.row -->

    <!-- Intro Content -->
    <div class="row">
        <div class="col-md-6">
           <?php echo $detailsImage; ?> 
        </div>
        <div class="col-md-6">
            <h2>Bar Info</h2>
            <?php   
                echo $detailsAddress;
                echo $detailsPhoneNumber;
                echo $detailsWebsite;
                echo $detailsOperatingHoursMonday;
                echo $detailsOperatingHoursTuesday;
                echo $detailsOperatingHoursWednesday;
                echo $detailsOperatingHoursThursday;
                echo $detailsOperatingHoursFriday;
                echo $detailsOperatingHoursSaturday;
                echo $detailsOperatingHoursSunday;
             ?>
      </div>
    </div>
    <!-- /.row -->

    

    <!-- Our Customers -->
    <div class="row">
        <br/><br/>
        <div class="col-lg-12">

        </div>
        <?php
        $i=0;
            foreach ($mapdetails_url->result->photo as $details_photos)
            {
                if($i>=6) break;
                $photo_reference = $details_photos->photo_reference;
                $image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=200&maxheight=200&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
                echo isset($photo_reference) ? '<div class="col-md-2 col-sm-4 col-xs-6">
                                                                <img class="img-responsive customer-img" width="200" height="200" src="'. $image .'"/>
                                                                </div>' 
                                                                : "-<br/>";
                $i++;
            }
        ?>
        
    </div>
    <!-- /.row -->
    
    <!-- Service Tabs -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Service Tabs</h2>
        </div>
        <div class="col-lg-12">

            <ul id="myTab" class="nav nav-tabs nav-justified">
                <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-glass"></i> List of Drinks</a>
                </li>
                <!--
                <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-cutlery"></i> List of Food</a>
                </li>
                -->
                <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-thumbs-up"></i> Reviews</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="service-one">
                    <h4>List of Drinks</h4>

                    <?php include('core/init_barpage_drinklist.php'); ?> 
                 </div>
                 <!-- maybe later
                <div class="tab-pane fade" id="service-two">
                    <h4> List of Food</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae repudiandae fugiat illo cupiditate excepturi esse officiis consectetur, laudantium qui voluptatem. Ad necessitatibus velit, accusantium expedita debitis impedit rerum totam id. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus quibusdam recusandae illum, nesciunt, architecto, saepe facere, voluptas eum incidunt dolores magni itaque autem neque velit in. At quia quaerat asperiores.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae repudiandae fugiat illo cupiditate excepturi esse officiis consectetur, laudantium qui voluptatem. Ad necessitatibus velit, accusantium expedita debitis impedit rerum totam id. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus quibusdam recusandae illum, nesciunt, architecto, saepe facere, voluptas eum incidunt dolores magni itaque autem neque velit in. At quia quaerat asperiores.</p>
                </div>
                 -->
                <div class="tab-pane fade" id="service-three">
                  
                    <h4>Reviews</h4>
                    <?php 
                    foreach ($mapdetails_url->result->review as $details_reviews)
                    {
                        echo isset($details_reviews->author_name) ? "<strong>" . $details_reviews->author_name . "</strong><br/>" : "-<br/>";
                        echo isset($details_reviews->rating) ? "Rating: " . $details_reviews->rating : "-<br/>";
                        echo isset($details_reviews->text) ? "<p>". $details_reviews->text ."</p>" : "-<br/>";
                    }
                    ?>
                    

                 </div>
            </div>

        </div>
    </div>

    <hr>

    <!-- Footer -->
         <footer>
            <div class="row">
                <div class="col-lg-12">
                    <?php include('includes/footer.php'); ?>
                </div>
            </div>
        </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
