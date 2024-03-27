<?php
require_once 'session_helper.php';
if (isset( $_SESSION['name'] ) && isset( $_SESSION['pass'] )  ) {
include 'conn.php';
$toggle = $_GET['switch'];


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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

          <a href="index.php" class="btn btn-light">
          <img src="images/logo2.jpg" style="width:85px; height:50px; border-radius:4px;" >` 
          </a>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ordered.php">Ordered</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sold.php">Sold</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="reports.php">Reports</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Logout <i class="fa fa-sign-out mr-1"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">
        <h2 class="mb-4">Make reports</h2>
        <div class="row">
          <?php
          if ($toggle != '1') {
          ?>
            <div class="col-lg-12 col-md-6 mb-4">

              <div class="card">

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <h5 class="card-title">Bought Cars</h5>
                      <form method="post" action="">
                        <input type="date" name="date" class="form-control mb-2">
                        <input type="date" name="date" class="form-control mb-2">
                        <button type="submit" name="saves" class="btn btn-dark btn-sm w-100 mb-1">View report <i class="fa fa-printer ml-1"></i> </button>
                      </form>

                    </div>
                    <div class="col-md-4">
                      <h5 class="card-title">Sold cars</h5>
                      <form method="post" action="">
                        <input type="date" name="date" class="form-control mb-2">
                        <input type="date" name="date" class="form-control mb-2">
                        <button type="submit" name="saves" class="btn btn-dark btn-sm w-100 mb-1">View Report <i class="fa fa-printer ml-1"></i> </button>
                      </form>
                    </div>
                    <div class="col-md-4">
                      <h5 class="card-title">On sale cars</h5>
                      <form method="post" action="reports.php?switch=1 ">
                        <input type="date" name="date1" class="form-control mb-2">
                        <input type="date" name="date2" class="form-control mb-2">
                        <button type="submit" name="save" class="btn btn-dark btn-sm w-100 mb-1">View report <i class="fa fa-printer ml-1"></i> </button>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          } elseif ($toggle == '1') {
          ?>
            <div class="col-lg-12 col-md-6 mb-12">

              <div class="card">

                <div class="card-body">
                  <form method="post" action="reports.php?switch=2 ">
                    <button type="submit" class="btn btn-dark mb-1">Back</button>
                  </form>
                  <form method="post" action="report1.php">
                    <a href="sold_cars.php" class="btn btn-dark mb-1">Print</a>
                  </form>
                    <table class="table table-sm table-bordered">
                      <tr>
                        <th>Model</th>
                        <th>Color</th>
                        <th>N<sup><u>o</u></sup> de Sachet</th>
                      </tr>
                      <tr>
                      <?php
                      if (isset($_POST['save'] ) ) {
                      $sdate1=$_POST['date1'];
                      $edate1=$_POST['date2'];
                      $_SESSION['date1']=$sdate1;
                      $_SESSION['date2']=$edate1;

                      $pull=$conn->query(" SELECT * from cars WHERE status='2' ");
                      while ($rows=mysqli_fetch_array($pull)) {
                      ?>
                      <td><?php echo $rows['model'] ?></td>
                      <td><?php echo $rows['color'] ?></td>
                      <td><?php echo $rows['chasse'] ?></td>
                      <?php
                      }
                    }
                    ?>
                    </tr>
                    </table>
                    


                  </form>
                </div>
              </div>
            </div>
          <?php
          }
          ?>

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
    </style>
</body>

</html>
<?php 
}
?>