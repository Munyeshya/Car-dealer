<?php 
include 'conn.php';
$id=$_GET['id'];

$select=$conn->query("SELECT * from s_hist where id='$id' ");
$fetch=mysqli_fetch_array($select);
$pay=$fetch['pay'];
$car_id=$fetch['car_id'];

$select_reste=$conn->query("SELECT reste from sales where car_id='$car_id'");
$selected=mysqli_fetch_array($select_reste);
$reste=$selected['reste'];
$new_reste = $pay + $reste;

$update=$conn->query("UPDATE sales set reste='$new_reste' ");
$delete=$conn->query("DELETE from s_hist where id='$id' ");

header("location:sold.php");
?>