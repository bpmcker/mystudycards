<?php
include 'dbconnection.php';
//The purpose of this page is to assign Sessions to the Posted variables from professor.php but more importantly to avoid Confirm Form Resubmission Error
if (isset($_POST["Professor_ID"])) {
  session_start();
  // Required for sql statement to get C_h_P_ID
  $_SESSION["Professor_ID"] = $_POST["Professor_ID"];
  // Required for table (Professor:)
  $_SESSION["Professor_Full_Name"] = $_POST["Professor_Full_Name"];
  $Professor_ID = $_SESSION["Professor_ID"];
  $Course_ID = $_SESSION["Course_ID"];
  //get Course_has_Professor_ID from Course_has_Professor where Course_Course_ID = Course Selected and Professor_Professor_ID = Professor Selected
  $sqlGetCourse_has_Professor_ID = "SELECT Course_has_Professor_ID FROM Course_has_Professor WHERE Course_Course_ID = '$Course_ID' and Professor_Professor_ID = '$Professor_ID'";
  $sqlGetCourse_has_Professor_ID_Result = $conn->query($sqlGetCourse_has_Professor_ID);
  if ($sqlGetCourse_has_Professor_ID_Result->num_rows === 1) {
    while ($sqlGetCourse_has_Professor_ID_Var = $sqlGetCourse_has_Professor_ID_Result->fetch_assoc()) {
      $_SESSION["Course_has_Professor_ID"] = $sqlGetCourse_has_Professor_ID_Var["Course_has_Professor_ID"];
    }
    header("Location: /selectSet.php");
  } else if ($sqlGetCourse_has_Professor_ID_Result->num_rows > 1) {
    // Error a professor is teaching a specific course multiple times
  } else if ($sqlGetCourse_has_Professor_ID_Result->num_rows === 0) {
    // Error Course Professor Mismatch
  }
} else {
    header("Location: /professorSearch.php");
}
?>
