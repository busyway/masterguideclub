<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "mgapp";
    $conn=mysqli_connect($servername,$username,$password,"$dbname", 3308);
      if(!$conn)
      {
          die('Could not Connect MySql Server:' .mysqli_error());
      }
      
?>