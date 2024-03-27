<?php
include 'conn.php';
$alertclass="";
$alertmessage="";

if (isset($_POST['order'])) {
  $mod=$_POST['model'];
  $color=$_POST['color'];
  $nc=$_POST['nc'];
  $pa=$_POST['pa'];
  $paid=$_POST['paid'];
  $insert=$conn->query("INSERT INTO cars VALUES ('','$mod','$nc','$color','1') ");
  $last_id = mysqli_insert_id($conn);
  $reste=$pa-$paid;
  $payment= $conn->query("INSERT INTO purcase_history VALUES ('','$last_id','$pa','$reste' )");   
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>CarDealer</title>
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

          <a href="index.php" class="btn btn-light">
          <img src="images/logo2.jpg" style="width:85px; height:50px; border-radius:4px;" >
          </a>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
                <a class="nav-link active" href="ordered.php">Ordered</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sold.php">Sold</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="reports.php">Reports</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Logout <i class="fa fa-sign-out mr-1"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h4 class="mb-4"><a data-toggle="modal" data-target="#thisModal">Record an order <i class="fa fa-plus-circle mr-1"></i></a></h4>
          </div>
          <div class="col-md-6"></div>
          <div class="col-md-2">
            <h4 class="mb-4"><a href="history.php" class="btn btn-dark btn-sm">View Previous</a></h4>
          </div>
        </div>

        <div class="modal fade" id="thisModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-center">New ordered car</h3>
                <span class="fa fa-window-close" data-dismiss="modal"></span>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <form method="post">
                      <input type="text" name="model" class="form-control mb-2" placeholder="Car Model">
                      <input type="text" name="color" class="form-control mb-2" placeholder="Color" >
                      <input type="text" name="nc" class="form-control mb-2" placeholder="Numero de Chasse" >
                      <input type="text" name="pa" class="form-control mb-2" placeholder="Purchase amount" >
                      <button type="submit" name="order" class="btn btn-dark btn-sm w-100">Save</button>
                    </form>
                  </div>

                </div>
              </div>
              <div class="modal-footer w-100">
                <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
          $fetch=$conn->query("SELECT *from cars where status='1'  order by id desc");
          while ($row=mysqli_fetch_array($fetch)) {
            $id=$row['id'];
            $slect=$conn->query("SELECT * FROM purcase_history where car_id='$id' ");
            $fet=mysqli_fetch_array($slect);
          ?>
          <div class="col-lg-12 col-md-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title"><?php echo $row['model'] ?></h5>
                    <p class="card-text mb-1">Color: <?php echo $row['color'] ?></p>
                    <p class="card-text mb-1">N<sup><u>o</u></sup>de Chasse: <?php echo $row['chasse'] ?></p>
                    <p class="card-text mb-1">Purchase Price: <?php echo $fet['purchase']?> </p>
                    <p class="card-text mb-1 text-dark"><u>Purchase Details:</u></p>
                    <?php 
                    $an=$conn->query("SELECT * from p_hist where car_id='$id' ");
                    while ($m=mysqli_fetch_array($an)) {
                    ?>
                    <p class="card-text mb-1 text-sm">Date: <?php echo $m['date']."  <-->  ".$m['paid'] ?>
                    <a href=""> <i class="fa fa-times-circle-o text-dark"></i> </a> 
                    </p>
                  <?php }?>
                    <p class="card-text mb-1">Left: <?php echo $fet['reste']?> </p>
                  </div>
                  <hr>
                  <div class="col-md-4">

                    <form method="post" action="action.php?id=<?php echo $id ?>">
                      <input type="text" name="mod" class="form-control mb-2" value="<?php echo $row['model'] ?>">
                      <input type="text" name="col" class="form-control mb-2" value="<?php echo $row['color'] ?>" >
                      <input type="text" name="cha" class="form-control mb-2" value="<?php echo $row['chasse'] ?>" >
                      <input type="text" name="pur" class="form-control mb-2" value="<?php echo $fet['purchase']?>" >
                      <button type="submit" name="save" class="btn btn-dark btn-sm w-100 mb-1">Save</button>
                      <button type="submit" name="status" class="btn btn-dark btn-dark btn-sm w-100 mb-1  "> Set Available Status<i class="fa fa-share-square ml-1"></i></button>
                      
                    </form>
                  </div>
                  <div class="col-md-4">  
                    <form method="post" action="action.php?id=<?php echo $id?> ">
                      <input type="text" name="pays" class="form-control mb-1" placeholder="Amount">
                      <input type="date" name="date" class="form-control mb-1">
                      <button type="submit" name="comp" class="btn btn-dark btn-sm w-100 mb-1">Complete Payment</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php }?>

        </div>

      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <style>
      /* Stick the navbar to the top */
      .navbar {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        /* Adjust the z-index as needed */
      }

      /* Push the content below the navbar to prevent overlap */
      #content {
        margin-top: 60px;
        /* Adjust the margin-top to match the navbar's height */
      }

      /* Make the navbar full-width */
      .navbar {
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        /* Set the left edge to 0 for full-width */
        right: 0;
        /* Set the right edge to 0 for full-width */
        z-index: 1000;
      }

      /* Push the content below the navbar to prevent overlap */
      #content {
        margin-top: 60px;
        /* Adjust the margin-top to match the navbar's height */
        background-image: url(images/peakpx.jpg);
        background-size: cover;
        /* This scales the image to cover the entire div */
        background-repeat: no-repeat;
        /* This prevents the image from repeating */
        background-attachment: fixed;
        width: 100%;
        /* Set the width of the div as needed */
        height: 350px;
        /* Set the height of the div as needed */
      }
      /**{
        border: 1px solid black;
      }*/
    </style>
</body>

</html>