<?
  // connect to my SQL
  require('./db/conn.php');

  $session = $_COOKIE['week5'];
  $removeSession = "DELETE FROM `users_certificate` WHERE `users_certificate`.`session` = '{$session}' ";
  
  // remove session from mySQL
  // ? 要怎麼知道 query 有成功？然後可用 if 判斷
  $conn->query($removeSession);

  // set Client's cookie expired right now
    setcookie("week5", "", time() - 3600);
    header("Location: ./index.php");
  
?>