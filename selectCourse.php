
<?php
include 'mainheader.php';
session_start();
if (!isset($_SESSION["University_ID"])) {
  header("Location: /index.php");
  die();
}
//Required for post to getCourseList (needed for SQL statement)
$University_ID = $_SESSION["University_ID"];
//Required for table (University:)
$University_Name = $_SESSION["University_Name"];
//error 1
if (isset($_SESSION["More_Than_One_Course_Found"])) {
  echo "<script>alert('Multiple Courses found, please specify')</script>";
  unset($_SESSION["More_Than_One_Course_Found"]);
}
//error 2
if (isset($_SESSION["Course_Not_Found"])) {
  echo "<script>alert('Course Not Found')</script>";
  unset($_SESSION["Course_Not_Found"]);
}
//error 3
if (isset($_SESSION["Blank_Field_Course"])) {
  echo "<script>alert('Please enter the name of your Course')</script>";
  unset($_SESSION["Blank_Field_Course"]);
}
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
      <div class="col-3 col-sm-3  TitleContent"> </div>
      <div class="col-3 col-sm-3  TitleContent"> </div>
      <div class="col-3 col-sm-3  TitleContent "> </div>
    </div>
    <div class="row titleRow">
        <div class="col-3 col-sm-3  TitleButton"><form action="index.php" method="post"><input type="submit" value="Change" name="changeUniversity" class="TitleButtonButton"></form></div>
        <div class="col-3 col-sm-3  TitleButton"> </div>
        <div class="col-3 col-sm-3  TitleButton "> </div>
        <div class="col-3 col-sm-3  TitleButton "> </div>
    </div>
  </div>

  <div class="row">
      <div class="col-md-12">
          <div class="space"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-auto">
        <div class="loading" id="loading">loading...</div>
    </div>
    <div class="col-md-3">
    </div>
  </div>

  <div class="row searchRow">
    <div class="col-3">
    </div>
  	 <div class="col-md-auto">
        <form action="checkCourse.php" method="post" id="Course_Form">
          <input type="text" name="CourseNameFORM" placeholder="Enter the name of your Course" class="SearchBox" id="SearchBox_ID" autocomplete="off" autofocus>
          <input type="submit" value="Next" name="CourseNameSubmitFORM" class="NextButton">
        </form>
        <div class="CourseList" id="CourseList"></div>
      </div>
    <div class="col-3">
    </div>
  </div>

  <div class="row">
    <div class="col-3">
    </div>
     <div class="col-md-auto">
          <div class="CourseList" id="CourseList"></div>
      </div>
    <div class="col-3">
    </div>
  </div>




</div>

<!-- <img src="ad2.jpeg" class="ad2 img-fluid pull-right" alt="right ad"> -->

</section>
</div>
<!-- ____________________________________________________________________________________________________________ -->

<!-- ____________________________________________________JQUERY________________________________________________________ -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!-- ____________________________________________________JQUERY________________________________________________________ -->

<script>
$(document).ready(function(){

  $(document).ajaxStart(function(){
    $('#loading').css("display", "inline");
   });

   $(document).ajaxComplete(function(){
     $('#loading').css("display", "none");
   });

   var ListItemFocus; //outside for mouse events accessibility

    $("#SearchBox_ID").keyup(function(keyUp) {

      if ((keyUp.keyCode != 40) && (keyUp.keyCode != 39) && (keyUp.keyCode != 38) && (keyUp.keyCode != 37)) {
        var query = $(this).val(); //reset the query value when a character may be entered
        // THE KEY IS TO START AT -1!! NOT 0!! Thus to change css of listitem AFTER increment not before thus allowing
        // the current index stored in memory to be equivalent to the actual listitem index that currently has the
        // "focus"
        ListItemFocus = -1; //reset the focus when a character may be entered

        if (query != '') {
          $.ajax({
            url: "getCourseList.php",
            method:"POST",
            data:{query:query, University_ID_Second_Post:<?php echo $University_ID; ?>},
            success:function(data){
                $("#CourseList").fadeIn();
                $("#CourseList").html(data);
            }
          })
        } else {
          $("#CourseList").fadeOut();
        }
      } else {
        //down arrow key
        if (keyUp.keyCode == 40) {
          //see if any li exist
          if ($("#0").length != 0) {
          //if the first li is NOT "Course Not Found"
            if (($("#0").text() != "Course Not Found")) {
              //get size of list for max value
              var ListItemSize = $("li").size();
              var ListItemMAX = ListItemSize-1;
              if (ListItemFocus < ListItemMAX) {
                  //move down
                  ListItemFocus++;
                  $("#"+(ListItemFocus-1)).css("font-weight", "normal");
                  $("#"+ListItemFocus).css("font-weight", "bold");
                  $('#SearchBox_ID').val($("#"+(ListItemFocus)).text());
                } else {
                  $("#"+ListItemFocus).css("font-weight", "normal");
                  ListItemFocus = 0;
                  $("#"+ListItemFocus).css("font-weight", "bold");
                  $('#SearchBox_ID').val($("#"+(ListItemFocus)).text());
              }
            }
          }
        }

      //up arrow key
      if (keyUp.keyCode == 38) {
        //see if any li exist
        if ($("#0").length != 0) {
        //if the first li is NOT "Course Not Found"
          if (($("#0").text() != "Course Not Found")) {
            //get size of list for max value
            var ListItemSize = $("li").size();
            var ListItemMAX = ListItemSize-1;
            if (ListItemFocus > 0) {
                //move up
                $("#"+ListItemFocus).css("font-weight", "normal");
                ListItemFocus--;
                $("#"+ListItemFocus).css("font-weight", "bold");
                $('#SearchBox_ID').val($("#"+(ListItemFocus)).text());
              } else {
                $("#"+ListItemFocus).css("font-weight", "normal");
                ListItemFocus = (ListItemMAX);
                $("#"+(ListItemFocus)).css("font-weight", "bold");
                $('#SearchBox_ID').val($("#"+(ListItemFocus)).text());
            }
          }
        }
      }

    } //end of else statement
}); //end of searchbox keypress

      //mouse click on any listitem
      $(document).on('click', 'li', function(){
        if (($(this).text()) != "Course Not Found") {
           $(this).css("font-weight", "bold");
           $('#SearchBox_ID').val($(this).text());
           $('#SearchBox_ID').focus();
           $('#CourseList').fadeOut();
         }
      });

      //mouse over on any listitem
      $(document).on('mouseover', 'li', function(){
        if (($(this).text()) != "Course Not Found") {
            //make all listitems normal text
            $("li").each(function(){
              $(this).css("font-weight", "normal");
            });
            //set the text of the one being hovered over to bold
            $(this).css("font-weight", "bold");
            //get the id of the one being hovered over and pass it to the global variable ListItemFocus for the arrow keys functionality
            ListItemFocus = $(this).attr("id");
          } else {
            $(this).css("cursor", "default");
          }
        });

      //mouse leave on any listitem
      $(document).on('mouseleave', 'li', function(){
        $(this).css("font-weight", "normal");
        //set the ListItemFocus to original value of -1 so that arrow keys start control at beginning
        ListItemFocus = -1;
      });

});
</script>


<?php
include 'mainfooter.php';
?>
