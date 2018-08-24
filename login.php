<?
// conncet to mySQL
require('conn.php');

// get data from index.php/form
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM `users` WHERE `username` LIKE '{$username}' AND `password` LIKE '{$password}' ";

if ( $conn->query($sql) ) 
{
  echo "<h2>登入成功</h2>  {$username}  你好！";
} else {
  echo "login failed !";
  
}

  echo "<br> <a href=./index.php> index page </a>";


?>