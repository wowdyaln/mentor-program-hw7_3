
    <!-- main comment -->
      <?php
      //conncet to mySQL
      require '../db/conn.php';
      $nickname = $_POST['nickname'];
      $comment = $_POST['main_comment'];
      $writeAcomment = "INSERT INTO `comments` (`id`, `nickname`, `content`) VALUES (NULL, '$nickname', '$comment' )";

      if ($conn->query($writeAcomment)) {

        // INSERT INTO success
        header("Location: ../board.php");
      } else {
          echo " Error: {$conn->error} :
                    sql: {$sql}  ";
      }
      ?>
  