
<!-- main comment -->
<?php
  //conncet to mySQL
  require '../db/conn.php';

  // find a user according to Cookies.
  $session = $_COOKIE["week5"];
  $findUser = "SELECT username FROM users_certificate WHERE `session` = '{$session}'";
  $user = $conn->query($findUser)->fetch_assoc()['username'];

  $findNickname = "SELECT nickname FROM users WHERE username = '{$user}'";
  $nickname = $conn->query($findNickname)->fetch_assoc()['nickname'];
  
  $raw_comment = $_POST['main_comment'];
  // 預防 XSS 腳本寫入攻擊
  $comment = htmlspecialchars($raw_comment, ENT_QUOTES);
  $writeAcomment = "INSERT INTO `comments` (`id`, `nickname`, `content`) VALUES (NULL, '$nickname', '$comment' )";

  if ($conn->query($writeAcomment)) {

  // INSERT INTO success
  header("Location: ../board.php");
  } else {
  echo " Error: {$conn->error} :
            sql: {$sql}  ";
  }
?>
