<?php
include 'dbconnection.php';

session_start();
//Variable Declarations
$universityName = $_POST["universityName"];
$courseName = $_POST["courseName"];
$courseCode = $_POST["courseCode"];
$setName = $_POST["setName"];

//$file_1 = $_POST["file_1"]; //user has ability to not upload even a single set so each file needs to be checked for null
/*
$file_2 = $_POST["file_2"];
$file_3 = $_POST["file_3"];
$file_4 = $_POST["file_4"];
$file_5 = $_POST["file_5"];
*/
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$comment = $_POST["comment"];


//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
//The file must be checked for size and type, uploaded (copied) to the EC2, referenced within the EC2 in order to be sent via SMTP to us.
// Each textbox needs to be stripped with mysqli()
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------------------------------
//SEND EMAIL
//------------------------------------------------------------------------------------------------------------------------------------------------
use PHPMailer\PHPMailer\PHPMailer;
require_once('PHPMailer-master/src/PHPMailer.php');
require_once('PHPMailer-master/src/SMTP.php');
require_once('PHPMailer-master/src/Exception.php');

$email = new PHPMailer();
$email->isSMTP();
$email->Host = "smtp.gmail.com";
$email->port = 465;
$email->SMTPSecure = 'ssl';
$email->SMTPAuth = true;
$email->Username = "mystudycardsllc@gmail.com";  // SMTP username
$email->Password = "Xx918e#2"; // SMTP password
$email->setFrom = 'mystudycardsllc@gmail.com';
$email->FromName = 'My Name';
$email->Subject = 'This is the subject';
$email->Body = 'this is the body';
$email->addAddress('mystudycardsllc@gmail.com');
$email->AddAttachment($_FILES['file_1']['tmp_name'],$_FILES['file_1']['name']);
return $email->Send();





/*
$to ='mystudycardsllc@gmail.com';
$subject = "mystudycards_material" . "\n";
$message =
"University: " . $universityName
."\n\n".
"Course: " . $courseName
."\n\n".
"Set: " . $setName
."\n\n".
"File 1: "
*/
/*.$file_1*/
/*
."\n\n".
"First Name: " . $firstName
."\n\n".
"Last Name: " . $lastName
."\n\n".
"User Email: " . $email;
$header = 'From: ' . $email . "\n" . 'Reply-To: ' . $email . "\n" . 'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $header);
*/
?>
