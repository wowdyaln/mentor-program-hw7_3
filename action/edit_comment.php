<!-- main comment -->
<?php
  //conncet to mySQL
  require '../db/conn.php';
  // find a user according to Cookies.
  $session = $_COOKIE["week5"];
  $findUser = "SELECT * FROM users_certificate WHERE `session` = '{$session}'";
  $user = $conn->query($findUser)->fetch_assoc()['username'];

  $findUserId = "SELECT id FROM users WHERE username = '{$user}'";
  $userId = $conn->query($findUserId)->fetch_assoc()['id'];

  $id = $_POST['comment_id'];
  $raw_comment = $_POST['main_comment'];

  $findComment_userId = "SELECT `user_id` FROM comments WHERE id = '{$id}' ";
  $comment_userId = $conn->query($findComment_userId)->fetch_assoc()['user_id'];

  // verify user id.
  if ($comment_userId === $userId){
    // 預防 XSS 腳本寫入攻擊
    $comment = htmlspecialchars($raw_comment, ENT_QUOTES);
    $updateComment = "UPDATE `comments` SET `content` = '{$comment}' WHERE `comments`.`id` = {$id} ";
    if ($conn->query($updateComment)) {
    // INSERT INTO success
    header("Location: ../boots_layout.php");
    } else {
    echo " Error: {$conn->error} :
              sql: {$updateComment}  ";
    }
  } else {
    var_dump ($comment_userId);
    var_dump ($userId);
    // header("Location: ../index.php");
  }

?>
