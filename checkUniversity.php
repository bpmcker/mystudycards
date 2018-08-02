<?php
include 'dbconnection.php';
if (isset($_POST["UniversityNameSubmitFORM"])) {
  session_start();
  $UniversitySubmitted = $_POST["UniversityNameFORM"];
  if ($UniversitySubmitted != '') {
  $UniversitySubmitted = mysqli_real_escape_string($conn, $UniversitySubmitted);
  // Check if UniversityCharEntered is in it of itself an actual University, if not, prevent form submission
  $checkUniversity = "SELECT * FROM University WHERE University_Name_1 = '$UniversitySubmitted' OR University_Name_2 =
  '$UniversitySubmitted' OR University_Name_3 = '$UniversitySubmitted' OR University_Name_4 = '$UniversitySubmitted'";

  $checkUniversity_Result = $conn->query($checkUniversity);
  if ($checkUniversity_Result->num_rows > 1) {
    // error 1
    /* Characters entered are not enough to specify a University, prevent form submission and return with error: Please specify University
    This event is unlikely as it would require the name entered to be identical for 2 or more Universities*/
    $_SESSION["More_Than_One_University_Found"] = "More_Than_One_University_Found";
    header("Location: /index.php");
  } else if ($checkUniversity_Result->num_rows === 0) {
    //error 2
    $_SESSION["University_Not_Found"] = "University_Not_Found";
    header("Location: /index.php");
  } else if ($checkUniversity_Result->num_rows === 1) {
    while ($checkUniversity_Var = $checkUniversity_Result->fetch_assoc()) {
      // Success!
      $_SESSION["University_ID"] = $checkUniversity_Var["University_ID"];
      $_SESSION["University_Name"] = $checkUniversity_Var["University_Name_1"];
      header("Location: /selectCourse.php");
      }
    }
  } else {
    //error 3
    $_SESSION["Blank_Field_University"] = "Blank_Field";
    header("Location: /index.php");
  }
} else {
  header("Location: /index.php");
}
?>
