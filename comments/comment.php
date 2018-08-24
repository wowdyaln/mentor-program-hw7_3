
    <!-- main comment -->
      <?php
      //conncet to mySQL
      require '../db/conn.php';

      // find a user according to Cookies.
      $id = $_COOKIE["week5"];
      $findNickname = "SELECT * FROM users WHERE id = '{$id}'";
      $nickname = $conn->query($findNickname)->fetch_assoc()['nickname'];
      // 
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
  