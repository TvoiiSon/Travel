<?php
session_start();
require_once("../../db/db.php");

var_dump($_POST);

$idcountry = $_POST['2'];
$title = $_POST['title'];
$price = $_POST['price'];
$descr = $_POST['descr-tour'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

$path = 'upload/tour/' . time() . $_FILES['imageproduct']['name'];
move_uploaded_file($_FILES['imageproduct']['tmp_name'], '../../' . $path);

$sel_tour = mysqli_query($link, "SELECT * FROM `tours` WHERE `title` = '$title'");
$sel_tour = mysqli_fetch_assoc($sel_tour);

if(empty($sel_tour)) {
    mysqli_query($link, "INSERT INTO `tours`(`idcountry`, `title`, `price`, `pathimg`, `descrip`, `startdate`, `finishdate`) VALUES ('$idcountry','$title','$price','$path','$descr','$startdate','$enddate')");
    header("Location: ../view_country/view_all.php");
} else {
    $_SESSION["errMes"] = 'Такой тур уже существует!';
    header("Location: ../add-tour.php");
    session_destroy();
}

?>