<?php
include 'dbconnection.php';
session_start();
if (!isset($_SESSION["Set_ID"])) {
  header("Location: /selectSet.php");
  die();
}
//Required for table (University:)
$University_Name = $_SESSION["University_Name"];
//Required for table (Course:)
$Course_Name_Concatenated = $_SESSION["Course_Name_Concatenated"];
// Required for table (Professor:)
$Professor_Full_Name = $_SESSION["Professor_Full_Name"];
// Required for table (Set:)
$Set_Name = $_SESSION["Set_Name"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>mystudycards</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="maincss.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">

  </head>


<body style="background-image:url('dust_scratches.png');">


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
<section id="UniversityInput" class="jumbotron">
  <div class="container container-fluid">

    <div class="container container-fluid termContainer">
      <div class="row titleRow">
        <div class="col-3 col-sm-3  TitleName">University: </div>
        <div class="col-3 col-sm-3  TitleName">Course: </div>
        <div class="col-3 col-sm-3  TitleName ">Professor: </div>
        <div class="col-3 col-sm-3  TitleName ">Set </div>
      </div>
      <div class="row titleRow">
        <div class="col-3 col-sm-3  TitleContent"> <?php echo $University_Name ?></div>
        <div class="col-3 col-sm-3  TitleContent"><?php echo $Course_Name_Concatenated ?> </div>
        <div class="col-3 col-sm-3  TitleContent"> <?php echo $Professor_Full_Name ?></div>
        <div class="col-3 col-sm-3  TitleContent "><?php echo $Set_Name ?> </div>
      </div>
      <div class="row titleRow">
        <div class="col-3 col-sm-3  TitleButton"><form action="index.php" method="post"><input type="submit" value="Change" name="changeUniversity" class="TitleButtonButton"></form></div>
        <div class="col-3 col-sm-3  TitleButton"><form action="selectCourse.php" method="post"><input type="submit" value="Change" name="changeCourse" class="TitleButtonButton"></form> </div>
        <div class="col-3 col-sm-3  TitleButton "> <form action="professorSearch.php" method="post"><input type="submit" value="Change" name="changeProfessor" class="TitleButtonButton"></form></div>
        <div class="col-3 col-sm-3  TitleButton "><form action="selectSet.php" method="post"><input type="submit" value="Change" name="changeSet" class="TitleButtonButton"></form> </div>
      </div>
  </div>



<div class="row">
   <div class="col-12">
       <p class="termSpace" style="height:20px;"></p>
   </div>
</div>


<div class="container termwrapper">
  <div class="row termRow">
    <div class="col-12 ">

      <center>
        <div class="TermCard">
            <div class="terms front termFront" id="questionterm" onclick="Flip()"></div>
            <div class="terms back termBack" id ="answerterm" onclick="Flip()"></div>
        </div>
        <div class="ListCard">
            <div class="terms front" id="questionlist"></div>
            <hr style="height:2px; color:#333; background-color:#333;"/>
            <div class="terms back" id ="answerlist"></div>
        </div>
      </center>

    </div>
  </div>

  <div class="row">

    <div class="col-sx-3 col-sm-3 col-md-3 col-lg-3">
    </div>

    <div class="col-xs-auto col-sm-auto col-md-auto col-lg-auto buttonWrap">
        <center>
      <button id="btnBack"  onclick="BackTerm()">
        <
      </button>
        <button id="btnSwitch" onclick="SwitchTerm()">View Flashcard</button>
        <!-- <button id="btnFlip" onclick="Flip()">Flip</button> -->
       <button id="btnNext" onclick="NextTerm()">
        >
      </button>
        </center>
    </div>

    <div class="col-sx-4 col-sm-4 col-md-4 col-lg-4">
    </div>

  </div>

</div>

</div>
</section>
</div>
<!-- ____________________________________________________UNIVERSITY INPUT________________________________________________________ -->


<!-- ____________________________________________________JQUERY________________________________________________________ -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!-- ____________________________________________________JQUERY________________________________________________________ -->

<script>
var card_flipped = false;
function Flip() {
  // if ($('#btnFlip').is(":visible")) {
    $('.TermCard').toggleClass('flipped');
    if (card_flipped == false) {
      card_flipped = true;
    } else {
      card_flipped = false;
    }
  // }
};


$(function Switch(){
  $('#btnSwitch').click(function (){
    $(this).text(function (i, text){
      return text ===  "View Flashcard" ? "View List" : "View Flashcard";
    })
     $('.ListCard').toggle('hide');
     $('.TermCard').toggle('hide');
     $('#btnFlip').toggle('hide');
  })

});




// Term List brought in from getTerm.php
 <?php
if (isset($_SESSION["Term_List"])) {
$Term_List_JSON_ENCODED = $_SESSION["Term_List"];
} else {
  header("Location: /set.php");
}
 ?>

var termqa = <?php echo $Term_List_JSON_ENCODED; ?>;
var CurrentTermAndDefINDEX = 0;
var random = false;
//termqa_rand = [];

/*
function MakeRandomArray() {
  loop1: for (var i = 0; i < termqa.length; i++) {
    randNum = Math.floor(Math.random() * (termqa.length));
    if (termqa_rand.length < termqa.length) {
      if (termqa_rand.length != 0) {
      loop2: for (var i = 0; i < termqa_rand.length; i++) {
        loop3: while (termqa_rand[i] == randNum) {
            //re-roll
            randNum = Math.floor(Math.random() * (termqa.length));
            if (termqa_rand[i] != randNum) {
              termqa_rand.push(randNum);
              break loop1;
            }
          }
        }
      } else {
        termqa_rand.push(randNum);
      }
    }
  }
}
*/

// Random
function Randomize(){
  if (document.getElementById("btnRandom").innerHTML == "Random On") {
    random = false;
  } else {
    document.getElementById("btnRandom").innerHTML = "Random Off";
    random = true;
  }
};

  // Initiates values given to cards on page load
  document.getElementById('questionterm').innerHTML = termqa[CurrentTermAndDefINDEX][1];
  document.getElementById('answerterm').innerHTML = termqa[CurrentTermAndDefINDEX][2];
  document.getElementById('questionlist').innerHTML = termqa[CurrentTermAndDefINDEX][1];
  document.getElementById('answerlist').innerHTML = termqa[CurrentTermAndDefINDEX][2];

function NextTerm(){
  // checks if card is flipped (thus showing definition), if so flip it back to Term side before moving to next term
  if (card_flipped) {
    Flip();
  }
  if (random) {
    CurrentTermAndDefINDEX = Math.floor(Math.random() * (termqa.length));
    document.getElementById('questionterm').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerterm').innerHTML = termqa[CurrentTermAndDefINDEX][2];
    document.getElementById('questionlist').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerlist').innerHTML = termqa[CurrentTermAndDefINDEX][2];

  } else {
  if (CurrentTermAndDefINDEX == termqa.length -1) {
    CurrentTermAndDefINDEX = 0;
    document.getElementById('questionterm').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerterm').innerHTML = termqa[CurrentTermAndDefINDEX][2];
    document.getElementById('questionlist').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerlist').innerHTML = termqa[CurrentTermAndDefINDEX][2];
  } else {
    CurrentTermAndDefINDEX++;
    document.getElementById('questionterm').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerterm').innerHTML = termqa[CurrentTermAndDefINDEX][2];
    document.getElementById('questionlist').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerlist').innerHTML = termqa[CurrentTermAndDefINDEX][2];

    }
  }
};

function BackTerm(){
  // checks if card is flipped (thus showing definition), if so flip it back to Term side before moving to previous term
  if (card_flipped) {
    Flip();
  }
  if (CurrentTermAndDefINDEX == 0) {
    CurrentTermAndDefINDEX = (termqa.length - 1);
    document.getElementById('questionterm').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerterm').innerHTML = termqa[CurrentTermAndDefINDEX][2];
    document.getElementById('questionlist').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerlist').innerHTML = termqa[CurrentTermAndDefINDEX][2];
  } else {
    CurrentTermAndDefINDEX--;
    document.getElementById('questionterm').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerterm').innerHTML = termqa[CurrentTermAndDefINDEX][2];
    document.getElementById('questionlist').innerHTML = termqa[CurrentTermAndDefINDEX][1];
    document.getElementById('answerlist').innerHTML = termqa[CurrentTermAndDefINDEX][2];

  }
};

$(document).keydown(function (e){
  e = e || window.event;
  switch (e.which || e.keyCode){
    case 32:
    /*
       $('.ListCard').toggle('hide');
       $('.TermCard').toggle('hide');
       $('#btnFlip').toggle('hide');
    */
    e.preventDefault();
    Flip();
    break;

    case 37:
    BackTerm();
    break;

    case 38:
    break;

    case 39:
    NextTerm();
    break;

    case 40:
    break;

    default: return;
  }
  e.preventDefault();
});

</script>
<?php include 'mainfooter.php' ?>
