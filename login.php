<?
// conncet to mySQL
require('./db/conn.php');

// get data from index.php/form
$raw_username = $_POST['username'];
$raw_password = $_POST['password'];
// 預防 XSS 腳本寫入攻擊
$username = htmlspecialchars($raw_username, ENT_QUOTES);
$password = htmlspecialchars($raw_password, ENT_QUOTES);
// todo: 使用 php 的 $_SESSION['week'] ，不用資料庫存取。(目前全部自行寫邏輯去操作)
// password 要經過 hash function ，然後去對比 hash
$findUser = "SELECT * FROM users WHERE username = '$username' ";
$hash = $conn->query($findUser)->fetch_assoc()['password'];
$findSession = "SELECT * FROM `users_certificate` WHERE `username` = '{$username}'";

// 前端的 password 經過hash 之後，跟 後端 hash 比對看看有沒有相同。
if ( password_verify($password, $hash)){

$user = $conn->query($findUser)->fetch_assoc()['username'];
$newSession = session_create_id();

if ($conn->query($findSession)->num_rows === 1){
  $oldSession = $conn->query($findSession)->fetch_assoc()['session'];
  $updateSession = "UPDATE `users_certificate` SET `session` = '{$newSession}' WHERE `users_certificate`.`session` = '{$oldSession}' ";
  $conn->query($updateSession);
} else {
  $saveSession = "INSERT INTO `users_certificate` (`session`, `username`) VALUES ('{$newSession}', '{$user}')";
  $conn->query($saveSession);
}
// setcookie($name, $value, $expire)
$cookie = $newSession;
setcookie("week5", $cookie, time() + 60 * 3);

echo "<h2>登入成功</h2>  {$username}  你好！";

} else {
  echo 'login failed !';
}

  echo "<br> <a href=./index.php> index page </a>";

?>