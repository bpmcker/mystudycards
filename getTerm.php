<?php
include 'dbconnection.php';
// purpose of this page is to get Terms from specific Set and pass in JSON format to Term.php
session_start();
if (isset($_SESSION["Set_ID"])) {
  //for sql statement to fetch terms
  $Set_ID = $_SESSION["Set_ID"];
  $Term_List = array();
  $sqlGetTerm = "SELECT Term_ID, Term_Name, Term_Definition FROM Term WHERE Set_Set_ID = '$Set_ID'";
  $sqlGetTerm_Result = $conn->query($sqlGetTerm);
  if ($sqlGetTerm_Result->num_rows > 0) {
    while ($sqlGetTerm_Var = $sqlGetTerm_Result->fetch_assoc()) {
        $Term_ID = $sqlGetTerm_Var["Term_ID"];
        $Term_Name = $sqlGetTerm_Var["Term_Name"];
        $Term_Definition = $sqlGetTerm_Var["Term_Definition"];
        $Term = array($Term_ID, $Term_Name, $Term_Definition);
        array_push($Term_List, $Term);
    }
    $_SESSION["Term_List"] = json_encode($Term_List);
    header("Location: /terms.php");
  } else {
    //need No Terms Found for this Set Exception!!!
    header("Location: /selectSet.php");
  }
} else {
  header("Location: /selectSet.php");
}
?>
