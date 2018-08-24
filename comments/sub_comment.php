
    <!-- main comment -->
      <?php
      //conncet to mySQL
      require '../db/conn.php';
      $nickname = $_POST['nickname'];
      $comment = $_POST['sub_comment'];
      $comment_id = $_POST['comment_id'];
      $write_subComment = "INSERT INTO `sub_comments` (`id`, `comment_id`, `nickname`, `sub_content`, `created_at`) VALUES (NULL, '{$comment_id}', '{$nickname}', '{$comment}', CURRENT_TIMESTAMP)";

      if ($conn->query($write_subComment)) {

        // INSERT INTO success
        header("Location: ../board.php");
      } else {
          echo " Error: {$conn->error} :
                    sql: {$sql}  ";
      }
      ?>
  