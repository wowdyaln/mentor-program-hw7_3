// 刪除之後也要把子留言都刪除。
// 要有確定刪除？的提示
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

  $findComment_userId = "SELECT `user_id` FROM comments WHERE id = '{$id}' ";
  $comment_userId = $conn->query($findComment_userId)->fetch_assoc()['user_id'];

  // verify user id.
  if ($comment_userId === $userId){
  $deleteComment = "DELETE FROM `comments` WHERE `comments`.`id` = {$id}";
  $delete_subComment = "DELETE FROM `sub_comments` WHERE `sub_comments`.`comment_id` = {$id}";
    if ($conn->query($deleteComment) && $conn->query($delete_subComment)) {
    // DELETE success
    header("Location: ../board.php");
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
