<?php
include 'dbconnection.php';
//The purpose of this page is to assign Sessions to the Posted variables from Set.php but more importantly to avoid Confirm Form Resubmission Error
if (isset($_POST["Set_Name"])) {
  session_start();
  // Required for sql statement to get Term
  $_SESSION["Set_ID"] = $_POST["Set_ID"];
  // Required for table (Set:)
  $_SESSION["Set_Name"] = $_POST["Set_Name"];
  header("Location: /getTerm.php");
} else {
    header("Location: /selectSet.php");
}
?>
