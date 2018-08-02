<?php
//Necessary for data inflation
include 'dbconnection.php';
include 'mainheader.php';
session_start();
if (!isset($_SESSION["Course_ID"])) {
  header("Location: /selectCourse.php");
  die();
}
//Required for table (University:)
$University_Name = $_SESSION["University_Name"];
//Required for table (Course:)
$Course_Name_Concatenated = $_SESSION["Course_Name_Concatenated"];
// Required for fetching Professors who teach this Course
$Course_ID = $_SESSION["Course_ID"] ;
?>

<!-- ____________________________________________________NAVBAR________________________________________________________ -->
<nav class="navbar navbar-light navbar-toggleable-md py-0">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="http://mystudycards.com/">MY   <img src="MyStudyCards.png" class="MyStudyCardsImg img-fluid" alt="MyStudyCards"></a>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link py-0" href="http://mystudycards.com">Home<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link py-0" href="http://mystudycards.com/about.html">About Us</a>
        <a class="nav-item nav-link py-0" href="http://mystudycards.com/contact.html">Upload StudyCards</a>
  </div>
</div>
</nav>
<!-- ____________________________________________________NAVBAR________________________________________________________ -->

<div>
  <section class="jumbotron">
    <div class="container container-fluid indexContainer">
      <div class="container container-fluid titleContainer">
      <div class="row titleRow">
        <div class="col-3 col-sm-3  TitleName">University: </div>
        <div class="col-3 col-sm-3  TitleName">Course: </div>
        <div class="col-3 col-sm-3  TitleName ">Professor: </div>
        <div class="col-3 col-sm-3  TitleName ">Set </div>
      </div>
      <div class="row titleRow">
        <div class="col-3 col-sm-3  TitleContent"><?php echo $University_Name ?></div>
        <div class="col-3 col-sm-3  TitleContent"><?php echo $Course_Name_Concatenated ?></div>
        <div class="col-3 col-sm-3  TitleContent"></div>
        <div class="col-3 col-sm-3  TitleContent "></div>
      </div>
      <div class="row titleRow">
          <div class="col-3 col-sm-3  TitleButton"><form action="index.php" method="post"><input type="submit" value="Change" name="changeUniversity" class="TitleButtonButton"></form></div>
          <div class="col-3 col-sm-3  TitleButton"><form action="selectCourse.php" method="post"><input type="submit" value="Change" name="changeCourse" class="TitleButtonButton"></form></div>
          <div class="col-3 col-sm-3  TitleButton "></div>
          <div class="col-3 col-sm-3  TitleButton "></div>
      </div>
    </div>


  <div class="row">
      <div class="col-2">
      </div>
    <div class="col-md-auto">
      <div class='grid' align="center">
        <table class='tablegrid' align="center">
          <?php
          $countX = -1;
          //gets all professors who teach this course (don't need to specify University because is CourseID)
          $sqlGetProfessor = "SELECT Professor_ID, Professor_First_Name, Professor_Last_Name FROM Course INNER JOIN
          Course_has_Professor ON Course.Course_ID = Course_has_Professor.Course_Course_ID INNER JOIN Professor ON
          Course_has_Professor.Professor_Professor_ID = Professor.Professor_ID WHERE Course.Course_ID = '$Course_ID'";

          $sqlGetProfessor_Result = $conn->query($sqlGetProfessor);
          if ($sqlGetProfessor_Result->num_rows > 0) {
            while ($sqlGetProfessor_Var = $sqlGetProfessor_Result->fetch_assoc()) {

                     $countX++;

                     //echo "<table class='tablegrid'>";

                     if ($countX % 4 == 0) {
                      echo "<tr>";
                     }

                     $Professor_ID = $sqlGetProfessor_Var["Professor_ID"];
                     $Professor_Full_Name = mb_substr($sqlGetProfessor_Var['Professor_First_Name'], 0, 1).". ".$sqlGetProfessor_Var['Professor_Last_Name'];

                     echo "
                     <td>
                     <form action = 'checkProfessor.php' method='post'>
                     <input type='hidden' value='$Professor_ID' name='Professor_ID'>
                     <input type='submit' value='$Professor_Full_Name' name='Professor_Full_Name' class='Professor_Set_Inflation_Button'>
                     </form>
                    </td>
                    ";
                  }
                //  echo" </table>";
               } else {
                   echo "
                   <br>
                   <h2 style='margin-top: 100px;text-indent:20px; font-weight: bold;color: white;'>No Professors were found for this Course</h2>
                   ";
               }
          ?>
        </table>
      </div>
    </div>
  </div>

  <!-- <div class="row">
    <div class="col-md-12">
      <div class="extraspace"></div>
    </div>
  </div> -->
</div>
</section>
</div>


<!-- ____________________________________________________________________________________________________________ -->

<!-- ____________________________________________________JQUERY________________________________________________________ -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!-- ____________________________________________________JQUERY________________________________________________________ -->

<?php include 'mainfooter.php' ?>
