<?php
include 'conn.php';
$id=$_GET['id'];
if (isset($_POST['save'])) {
    $mod=$_POST['mod'];
    $col=$_POST['col'];
    $cha=$_POST['cha'];
    $pur=$_POST['pur'];
    $pay=$_POST['pay'];
    $dat=$_POST['dat'];
    $reste=$pur-$pay;

    $update=$conn->query("UPDATE cars set model='$mod',chasse='$cha',color='$col' WHERE id='$id' ");
    $s_update=$conn->query("UPDATE purcase_history set purchase='$pur',paid='$pay',reste='$reste' where car_id='$id' ");
    header("location:ordered.php");
}

if (isset($_POST['status'])) {
	$stat=$conn->query("UPDATE cars set status='2' where id='$id' ");
    header("location:ordered.php");
}

if (isset($_POST['comp'])) {
	$pays=$_POST['pays'];
	$date=$_POST['date'];
	$insert=$conn->query("INSERT INTO p_hist VALUES('','$id','$date','$pays') ");

    $bring=$conn->query("SELECT sum(paid) as sum from p_hist where car_id='$id'  ");
    $brin=mysqli_fetch_array($bring);
    $sums=$brin['sum'];

    $brought=$conn->query("SELECT purchase from purcase_history where  car_id='$id' ");
    $broug=mysqli_fetch_array($brought);
    $brou=$broug['purchase'];

    $rester=$brou-$sums;
    
    $upd=$conn->query("UPDATE purcase_history set reste='$rester' where car_id='$id' ");
    header("location:ordered.php");
}

if (isset($_POST['compe'])) {
    $pays=$_POST['pays'];
    $date=$_POST['date'];
    $insert=$conn->query("INSERT INTO p_hist VALUES('','$id','$date','$pays') ");

    $bring=$conn->query("SELECT sum(paid) as sum from p_hist where car_id='$id'  ");
    $brin=mysqli_fetch_array($bring);
    $sums=$brin['sum'];

    $brought=$conn->query("SELECT purchase from purcase_history where  car_id='$id' ");
    $broug=mysqli_fetch_array($brought);
    $brou=$broug['purchase'];

    $rester=$brou-$sums;
    
    $upd=$conn->query("UPDATE purcase_history set reste='$rester' where car_id='$id' ");
    header("location:history.php");
}

if (isset($_POST['saves'])) {
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $sales=$_POST['sales'];
    $paid=$_POST['paid'];
    $dates=$_POST['date'];
    $rester=$sales - $paid;

    $start=$conn->query("INSERT INTO sales VALUES('','$id','$sales','$name','$phone','$rester') ");
    $end=$conn->query("INSERT INTO s_hist VALUES ('','$id','$paid','$dates' ) ");
    $stat=$conn->query("UPDATE cars set status='3' where id='3' ");
    header("location:index.php");
}

if (isset($_POST['complete'])) {
    $payy=$_POST['payy'];
    $dates=$_POST['dates'];
    $init=$conn->query("INSERT INTO s_hist VALUES('','$id','$payy','$dates') ");

    $b=$conn->query("SELECT sum(pay) as sum from s_hist where car_id='$id'  ");
    $br=mysqli_fetch_array($b);
    $su=$br['sum'];

    $bro=$conn->query("SELECT sales from sales where  car_id='$id' ");
    $br=mysqli_fetch_array($bro);
    $hist=$br['sales'];

    $rem= $hist - $su;
    $change=$conn->query("UPDATE sales set reste='$rem' where car_id='$id' ");
    header("location:sold.php ");


} 


?>