<?php
include 'dbconnection.php';
session_start();
if (isset($_SESSION["Term_List"])) {
$Term_List_Raw = $_SESSION["Term_List"];
$Term_List = json_decode($Term_List_Raw);
foreach($Term_List as $Term) {
    echo "Term ID: " . $Term[0] . "<br>";
    echo "Term Name : " . $Term[1] . "<br>";
    echo "Term Definition : " . $Term[2] . "<br>";
    echo "<br><br>";
  }
} else {
  header("Location: /set.php");
}

?>
