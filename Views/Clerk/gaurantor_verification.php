<?php

include '../superadmin-session.php';
error_reporting(0);
/* $select=mysql_fetch_array(mysql_query("Select CustomerID from goldloanapplication where goldloanapplication.GoldLoanStatus='pending' and CustomerID ='".$_POST['val']."' UNION
  select CustomerID from loanapplication where (CustomerID='".$_POST['val']."' OR Gaurantor1Id='".$_POST['val']."'  and Gaurantor1Id='".$_POST['val']."') and loanapplication.LoanStatus='pending' UNION
  select CustomerID from loan where (CustomerID='".$_POST['val']."' OR Gaurantor1Id='".$_POST['val']."' and Gaurantor1Id='".$_POST['val']."' ) and status='Active' UNION
  select CustomerID from customer where  (memactive='1')  UNION
  select CustomerID from bankaccount group by CustomerID having count(CustomerID) = 1 "));

  if($select > 1)
  {
  echo "0";
  }
  else
  { */

$selectcustomer = mysql_fetch_array(mysql_query("select CustomerID,CustomerName,memactive from customer where (CustomerID='" . $_POST['val'] . "') and memactive=1"));
$response['CustomerName'] = $selectcustomer['CustomerName'];
$response['CustomerID'] = $selectcustomer['CustomerID'];

echo json_encode($response);

//}
?>