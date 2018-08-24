<?
// conncet to mySQL
require('./db/conn.php');

// get data from index.php/form
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id FROM `users` WHERE `username` = '{$username}' AND `password` = '{$password}' ";

if ( $conn->query($sql)->num_rows === 1) 
{
  //find the user's id
$userId = $conn->query($sql)->num_rows;
$cookie = $userId;
// setcookie($name, $value, $expire)
setcookie("week5", $cookie, time()+60*3);

  echo "<h2>登入成功</h2>  {$username}  你好！";
} else {
  echo "login failed !";
}



  echo "<br> <a href=./index.php> index page </a>";


?>