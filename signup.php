<?php
session_start();
require "connectDB.php";
$array_message = array();
//array_message['message'] = -1 : Check đúng . Ví dụ kiểm tra email có trùng hay không nếu không trùng nghĩa là đúng , dùng để thực thi câu lệnh insert

$name = $_POST['name'];
$email =$_POST['email'];
$username = $_POST['username'];
$phone =$_POST['phone'];
$pass = $_POST['pass'];
$checkpass =$_POST['checkpass'];
$makh =$_POST['makh'];
$create_at =$_POST['create_at'];


if (isset($_POST['name']) && isset($_POST['email']) &&  isset($_POST['phone']) &&  isset($_POST['username']) && isset($_POST['pass']) &&  isset($_POST['checkpass'])) {
     
     $array_message['message'] = $_POST['name'].$_POST['email'].$_POST['phone'].$_POST['username'].$_POST['pass'].$_POST['checkpass'].$_POST['makh'].$_POST['create_at'] ;
     //Username k có khoảng trắng và có trùng không
     if ((str_contains($username, " ")) == false) {
          // truy vấn tồn tại username trong db
          $sql = "SELECT * FROM customers WHERE UserName='" .$username . "'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) != 0)
               // $sqlUserName = "And UserName='" .$username . "'";
               $array_message['message'] = -1;
          else
               $array_message['message'] = 1;
     }
     else{
           // Email có trùng không
     $sql = "SELECT * FROM customers WHERE Email='" . $email . "'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) != 0)
          $array_message['message'] = -1;
     else
          $array_message['message'] = 3;

     // Check pass trùng với pass  
     if(!($pass == $checkpass))
     {
          $array_message['message'] = 4;
     }
     else
          $array_message['message'] = -1;
     }
     /////////////////////////
     if($array_message['message'] == -1)
     {
          $sql =" INSERT INTO customers(`ID_Customer`, `First_Name`, `Last_Name`, `Phone`, `Email`, `UserName`, `Password`, `Address`, `Create_At`, `ID_Role`)
          VALUES ('$makh','$name','$name','$phone','$email','$username','$pass','Nha Trang','$create_at','User')" ;
          $result = mysqli_query($conn, $sql);
           $array_message['message'] = 0;
           $array_message['success'] = 'home.php';
     }
echo json_encode($array_message);
