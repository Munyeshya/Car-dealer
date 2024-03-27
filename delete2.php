<?php 
include 'conn.php';
$id=$_GET['id'];

$select=$conn->query("SELECT * from p_hist where id='$id' ");
$fetch=mysqli_fetch_array($select);
$pay=$fetch['paid'];
$car_id=$fetch['car_id'];

$select_reste=$conn->query("SELECT reste from purcase_history where car_id='$car_id'");
$selected=mysqli_fetch_array($select_reste);
$reste=$selected['reste'];
$new_reste = $pay + $reste;

// echo $car_id."<br>";
// echo $pay."<br>";
// echo $reste."<br>";
// echo $new_reste."<br>";

$update=$conn->query("UPDATE purcase_history set reste='$new_reste' ");
$delete=$conn->query("DELETE from p_hist where id='$id' ");

header("location:history.php");
?>