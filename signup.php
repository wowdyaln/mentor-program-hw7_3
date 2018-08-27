<?
  //conncet to mySQL
require('./db/conn.php');



// get data from index.php/form
  $raw_username = $_POST['username'];
  $raw_nickname = $_POST['nickname'];
  $raw_password = $_POST['password'];

  // 預防 XSS 腳本寫入攻擊
  $username = htmlspecialchars($raw_username, ENT_QUOTES);
  $nickname = htmlspecialchars($raw_nickname, ENT_QUOTES);
  $password = htmlspecialchars($raw_password, ENT_QUOTES);

 
  $sql = "INSERT INTO `users` (`id`, `username`,nickname, `password`) VALUES (NULL, '{$username}','{$nickname}', '{$password}') ";

  if ( $conn->query($sql) ) {
    echo "New user created successfully 
    {$username}  你好！
    ";
} else {
    echo " Error: {$conn->error} :

sql: {$sql}  ";
}

echo "<br> <a href=./board.php> 留言板 </a>";
?>