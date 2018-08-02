<?php
include 'dbconnection.php';
if (isset($_POST["CourseNameSubmitFORM"])) {
  session_start();
  //needed for SQL statement
  $University_ID = $_SESSION["University_ID"];
  //needed for SQL statement
  $CourseSubmitted = $_POST["CourseNameFORM"];
  if ($CourseSubmitted != '') {
  $CourseSubmitted = mysqli_real_escape_string($conn, $CourseSubmitted);
  $checkCourse = "SELECT Course.Course_ID, (concat(Course_Name_1, ' ', Course_Name_2)) FROM Course WHERE (University_University_ID = '$University_ID') AND
  ((concat(Course_Name_1, ' ', Course_Name_2) = '$CourseSubmitted') OR (Course_Name_1 = '$CourseSubmitted') OR
  (Course_Name_2 = '$CourseSubmitted'))";

  $checkCourse_Result = $conn->query($checkCourse);
  if ($checkCourse_Result->num_rows > 1) {
    // error 1
    /* Characters entered are not enough to specify a Course, prevent form submission and return with error: Please specify Course
    This event is unlikely as it would require the name entered to be identical for 2 or more Universities*/
    $_SESSION["More_Than_One_Course_Found"] = "More_Than_One_Course_Found";
    header("Location: /selectCourse.php");
  } else if ($checkCourse_Result->num_rows === 0) {
    //error 2
    $_SESSION["Course_Not_Found"] = "Course_Not_Found";
    header("Location: /selectCourse.php");
  } else if ($checkCourse_Result->num_rows === 1) {
    while ($checkCourse_Var = $checkCourse_Result->fetch_assoc()) {
      // Success!
      $_SESSION["Course_ID"] = $checkCourse_Var["Course_ID"];
      $_SESSION["Course_Name_Concatenated"] = $checkCourse_Var["(concat(Course_Name_1, ' ', Course_Name_2))"];
      header("Location: /professorSearch.php");
      }
    }
  } else {
    //error 3
    $_SESSION["Blank_Field_Course"] = "Blank_Field";
    header("Location: /selectCourse.php");
  }
} else {
  header("Location: /selectCourse.php");
}
?>
