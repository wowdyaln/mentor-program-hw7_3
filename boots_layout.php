<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css"> -->
  <link rel="stylesheet" type="text/css" media="screen" href="./css/minty.min.css">
  <title>Minty board</title>
</head>
<body>
  <span class="loginStatus"> 
    <?php
    //conncet to mySQL
    require './db/conn.php';

    $un = false;   //current user's name
    $unId = false; //current user's id

    if ( isset($_COOKIE["week5"])){
            // find a user according to Cookies.
      $session = $_COOKIE["week5"];
      $findUsername = "SELECT * FROM users_certificate WHERE `session` = '{$session}'";
      $un = $conn->query($findUsername)->fetch_assoc()['username'];
      
      $findUserInfo = "SELECT * FROM `users` WHERE `username` = '{$un}'";
      $unId = $conn->query($findUserInfo)->fetch_assoc()['id'];
      $nk = $conn->query($findUserInfo)->fetch_assoc()['nickname'];

      echo "login ✅ <br>
            Hi ! $un <br>
            ($nk) <br>
      <a href=./logout.php>登出</a>";
    } else {
      echo "login ❌
      <br>
      要登入才能留言
      <br>
      <a href=./verify.php>登入頁面</a>
      ";
    }
    
    ?>
  </span>
    


<div class="container">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">留言板</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./verify.php">verify</a>
          </li>
        </ul>
      </div>
    </nav>    
    <!-- you can send main comment if login -->
    <?php
      if ( $un ){
          echo "
            <form action=./action/create_comment.php method=post>
              <fieldset>
                <legend>輸入主留言</legend>
                <div class=form-group>
                      <label for=main_comment>Comment</label>
                      <textarea class=form-control rows=5 cols=30 name=main_comment id=main_comment required></textarea>
                </div>
                <div class=form-group>
                      <input type=hidden name=user_id value={$unId}>
                      <button type=submit class='btn btn-primary'>submit</button>
                </div>
              </fieldset>
            </form>";
      }
      //conncet to mySQL
      // require './db/conn.php';
      $howManyComments = "SELECT COUNT(id) AS comment_count FROM comments";
      $res = $conn->query($howManyComments);
      $comments_count = $res->fetch_assoc();
      // how many pages ?
      $pages_count = ceil( $comments_count['comment_count'] / 10);

      // 設定目前頁數
      if (!isset($_GET['page'])){
        $current_page = 1; 
      } else {
        $current_page = $_GET['page'];
      }
      $from = ($current_page-1)*10;
        // read 10 main comments depend on current page.
      $readAll = "SELECT * FROM `comments` ORDER BY created_at DESC LIMIT 10 OFFSET {$from} ";
      $result = $conn->query($readAll);
        
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row["id"];
          $main_user_id = $row["user_id"];
          $content = $row["content"];
          $created_at = $row["created_at"];

          $findAuthorInfo = "SELECT * FROM `users` WHERE `id` = '{$main_user_id}'";
          $nickname = $conn->query($findAuthorInfo)->fetch_assoc()['nickname'];        

          echo "<div class=card border-primary>
                  <div class=card-header>main comment {$id}。 at : {$created_at}</div>
                  <div class=card-body>
                    <h4 class=card-title>暱稱：{$nickname}</h4>
                    <p>{$content}</p>
                  </div>
                ";

          if ( $unId === $main_user_id) {
                  echo "
                  <div class=card-body>
                    <form action=./edit.php method=post>
                      <input type=hidden name=comment_id value={$id}>
                      <input type=hidden name=comment_content value={$content}>
                      <button type=submit class='btn btn-outline-warning'>EDIT</button>
                    </form>

                    <form action=./action/delete_comment.php method=post >
                      <input type=hidden name=comment_id value={$id}>
                      <button type=submit class='btn btn-outline-danger'>DELETE</button>
                    </form>
                  </div>
                  ";
                }

            // read all sub_comments from mySQL
            $read_subAll = "SELECT * FROM `sub_comments` WHERE comment_id = $id ORDER BY created_at DESC";
            $sub_result = $conn->query($read_subAll);
        }
      }
    ?>

<div class="card border-primary " >
  <div class="card-header">Header</div>
  <div class="card-body">
    <h4 class="card-title">Primary card title</h4>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>



</div><!-- container -->





</div>




    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./script/jquery.js"></script>
    <script src="./script/popper.min.js"></script>
    <script src="./script/bootstrap.min.js"></script>
  </body>
</html>