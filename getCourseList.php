<?php
include 'dbconnection.php';

if (isset($_POST["query"])) {
  $CourseCharEntered = $_POST["query"];
  $CourseCharEntered = mysqli_real_escape_string($conn, $CourseCharEntered);
  $University_ID = $_POST["University_ID_Second_Post"];
  // Shows Courses from University selected
  $GetCourseList = "SELECT Course_ID, Course_Name_1, Course_Name_2 FROM Course WHERE
  (University_University_ID = '$University_ID') AND ((Course_Name_1 LIKE '$CourseCharEntered%') OR
  (Course_Name_2 LIKE '$CourseCharEntered%') OR ((concat(Course_Name_1, ' ', Course_Name_2)) LIKE '$CourseCharEntered%'))";
  $output = '<ul class="list-unstyled">';
  $maxOutput = 0;
  $li_index = 0;

  $GetCourseList_Result = $conn->query($GetCourseList);
  if ($GetCourseList_Result->num_rows > 0) {
    while ($GetCourseList_Var = $GetCourseList_Result->fetch_assoc()) {
        $maxOutput++;
        if ($maxOutput <= 5) {
          $output .= '<li id="'.$li_index.'">'.$GetCourseList_Var["Course_Name_1"]." ".$GetCourseList_Var["Course_Name_2"].'</li>';
          $li_index++;
        }
    }
  } else {
    $output .= '<li id="'.$li_index.'">Course Not Found</li>';
  }
  $output .= '</ul>';
  echo $output;
}
?>
