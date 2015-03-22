<?php
include 'include/connect.php';
function getProduct($tex)
   {
    // mengambil detail product berdasarkan id
    $query = sprintf("select * from msproduct where productID = '%s'", mysql_real_escape_string($tex));            
    $result = mysql_query($query, $GLOBALS['db']);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }    
    return $result;
   }
   
   function getNextTransId()
   {
      // ambil data terakhir transaksi id
      $query = sprintf("select max(transactionID) from headertransaction");    
      $result = mysql_query($query, $GLOBALS['db']);
      if (!$result) {
      	die('Invalid query: ' . mysql_error());
      }                
      $idStr = mysql_result($result, 0, 0);
      // generate transaksi id baru
      $nextId = intval(mysql_result($result, 0, 0)) + 1;
      
      return $nextId;
   }   
   
   function insertTransactionDetail($transid, $prodid, $qty)
   {
     // insert transaksi detail
    $query = sprintf("insert into detailtransaction values (%d, %d, %d)", mysql_real_escape_string($transid)
    ,mysql_real_escape_string($prodid)
    ,mysql_real_escape_string($qty)
    );    
    $result = mysql_query($query, $GLOBALS['db']);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    } 
	$up=sprintf("update msproduct set productStock= productStock-%d where productID= %d"
	,mysql_real_escape_string($qty)
	,mysql_real_escape_string($prodid)
	);
	
	$update=mysql_query($up, $GLOBALS['db']);   
    return mysql_affected_rows();
	
   }    
   
   function insertTransactionHeader($id,$user,$status)
   {
    // insert transaksi header
    $query = sprintf("insert into headertransaction (transactionID,username,status) values (%d, '%s', '%s')", mysql_real_escape_string($id)
    ,mysql_real_escape_string($user)
    ,mysql_real_escape_string($status));    
    $result = mysql_query($query, $GLOBALS['db']);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }    
    return mysql_affected_rows();
   }   
?>