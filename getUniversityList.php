<?php
include 'dbconnection.php';

if (isset($_POST["query"])) {
  $UniversityCharEntered = $_POST["query"];
  // Following is to inflate list
  $UniversityCharEntered = mysqli_real_escape_string($conn, $UniversityCharEntered);
  $GetUniversityList = "SELECT * FROM University WHERE University_Name_1 LIKE '$UniversityCharEntered%' OR University_Name_2
  LIKE '$UniversityCharEntered%' OR University_Name_3 LIKE '$UniversityCharEntered%' OR University_Name_4 LIKE
  '$UniversityCharEntered%'";

  $output = '<ul class="list-unstyled">';
  $maxOutput = 0;
  $li_index = 0;

  $GetUniversityList_Result = $conn->query($GetUniversityList);
  if ($GetUniversityList_Result->num_rows > 0) {
    while ($GetUniversityList_Var = $GetUniversityList_Result->fetch_assoc()) {
        $maxOutput++;
        if ($maxOutput <= 5) {
          $output .= '</div><li id="'.$li_index.'">'.$GetUniversityList_Var["University_Name_1"].'</li>';
          $li_index++;
        }
    }
  } else {
    $output .= '<li id="'.$li_index.'">University Not Found</li>';
  }
  $output .= '</ul>';
  echo $output;
}
?>
