<?
// conncet to mySQL
require('./db/conn.php');

// get data from index.php/form
$raw_username = $_POST['username'];
$raw_password = $_POST['password'];
// 預防 XSS 腳本寫入攻擊
$username = htmlspecialchars($raw_username, ENT_QUOTES);
$password = htmlspecialchars($raw_password, ENT_QUOTES);

// password 要經過 hash function ，然後去對比 hash
$findUser = "SELECT * FROM users WHERE username = '$username' ";
$hash = $conn->query($findUser)->fetch_assoc()['password'];


if ( password_verify($password, $hash)){
  //find the user's id
$userId = $conn->query($findUser)->fetch_assoc()['id'];
$cookie = $userId;
// setcookie($name, $value, $expire)
setcookie("week5", $cookie, time() + 60 * 3);

echo "<h2>登入成功</h2>  {$username}  你好！";

} else {
  echo 'login failed !';
}

  echo "<br> <a href=./index.php> index page </a>";


?>