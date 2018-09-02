<link rel="stylesheet" type="text/css" media="screen" href="./css/minty.min.css">

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

  // password 要經過 hash function，存 hash 進資料庫。
  $hash = password_hash($password, PASSWORD_DEFAULT);
 
  $sql = "INSERT INTO `users` (`id`, `username`,nickname, `password`) VALUES (NULL, '{$username}','{$nickname}', '{$hash}') ";

  if ( $conn->query($sql) ) {
    echo "
    <div class='alert alert-success text-center' role=alert>
      <strong>{$username}  你好!</strong> New user created successfully.
    </div>

    <a class='btn btn-primary btn-block' href=./board.php role=button>往留言板 </a>
    ";
    } else {
        echo " Error: {$conn->error} :
    sql: {$sql}  ";
    }

?>