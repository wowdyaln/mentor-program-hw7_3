
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

      $raw_comment = $_POST['sub_comment'];
      // 預防 XSS 腳本寫入攻擊
      $comment = htmlspecialchars($raw_comment, ENT_QUOTES);

      $user_id = $_POST['user_id'];
      $comment_id = $_POST['comment_id'];
      $write_subComment = "INSERT INTO `sub_comments` (`id`, `comment_id`, `sub_content`, `created_at`, `user_id`) VALUES (NULL, '{$comment_id}', '{$comment}', CURRENT_TIMESTAMP, '{$user_id}')";

      if ($conn->query($write_subComment)) {
        // INSERT INTO success
        header("Location: ../board.php");
      } else {
          echo " Error: {$conn->error} :
                    sql: {$write_subComment}  ";
      }
      ?>
  