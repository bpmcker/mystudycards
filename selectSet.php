<?php
//Necessary for data inflation
include 'dbconnection.php';
include 'mainheader.php';
session_start();
if (!isset($_SESSION["Course_has_Professor_ID"])) {
  header("Location: /professorSearch.php");
  die();
}
//Required for table (University:)
$University_Name = $_SESSION["University_Name"];
//Required for table (Course:)
$Course_Name_Concatenated = $_SESSION["Course_Name_Concatenated"];
// Required for table (Professor:)
$Professor_Full_Name = $_SESSION["Professor_Full_Name"];
// Required for sql statement to get set
$Course_has_Professor_ID = $_SESSION["Course_has_Professor_ID"];
?>

<!-- ____________________________________________________NAVBAR________________________________________________________ -->
<nav class="navbar navbar-light navbar-toggleable-md py-0">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="http://mystudycards.com/">MY   <img src="MyStudyCards.png" class="MyStudyCardsImg img-fluid" alt="MyStudyCards"></a>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link py-0" href="http://mystudycards.com/">Home<span class="sr-only">(current)</span></a>
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
        <div class="col-3 col-sm-3  TitleContent"> <?php echo $Professor_Full_Name ?></div>
        <div class="col-3 col-sm-3  TitleContent "></div>
      </div>
      <div class="row titleRow">
          <div class="col-3 col-sm-3  TitleButton"><form action="index.php" method="post"><input type="submit" value="Change" name="changeUniversity" class="TitleButtonButton"></form></div>
          <div class="col-3 col-sm-3  TitleButton"><form action="selectCourse.php" method="post"><input type="submit" value="Change" name="changeCourse" class="TitleButtonButton"></form></div>
          <div class="col-3 col-sm-3  TitleButton "><form action="professorSearch.php" method="post"><input type="submit" value="Change" name="changeProfessor" class="TitleButtonButton"></form></div>
          <div class="col-3 col-sm-3  TitleButton "></div>
      </div>
    </div>



  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-auto">
      <div class='grid' align="center">
        <table class='tablegrid' align="center">
          <?php
          $countX = -1;

          $sqlGetSet = "SELECT Set_ID, Set_Name FROM mystudycards_schema.Set WHERE Course_has_Professor_Course_has_Professor_ID = '$Course_has_Professor_ID'";

          $sqlGetSet_Result = $conn->query($sqlGetSet);
          if ($sqlGetSet_Result->num_rows > 0) {
            while ($sqlGetSet_Var = $sqlGetSet_Result->fetch_assoc()) {

                     $countX++;

                     if ($countX % 4 == 0) {
                       echo "<tr>";
                     }

                     $Set_ID = $sqlGetSet_Var["Set_ID"];
                     $Set_Name = $sqlGetSet_Var["Set_Name"];

                     echo "
                     <td>
                     <form action='checkSet.php' method='post'>
                     <input type='hidden' value='$Set_ID' name='Set_ID'>
                     <input type='submit' value='$Set_Name' name='Set_Name' class='Professor_Set_Inflation_Button'>
                     </form>
                     </td>";
                  }
               }
               else {
                   echo "<br>
                   <h2 style='margin-top: 100px;text-indent:20px; font-weight: bold;color: white;'>No Sets were found</h2>";
               }
          ?>
        </table>
      </div>
    </div>
  </div>

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
