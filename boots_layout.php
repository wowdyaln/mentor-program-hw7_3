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
<?php
  //conncet to mySQL
  require './db/conn.php';

  $un = false;   //current user's name
  $unId = false; //current user's id

  if ( isset($_COOKIE["week5"])){ // find a user according to Cookies.
    $session = $_COOKIE["week5"];
    $findUsername = "SELECT * FROM users_certificate WHERE `session` = '{$session}'";
    $un = $conn->query($findUsername)->fetch_assoc()['username'];
    
    $findUserInfo = "SELECT * FROM `users` WHERE `username` = '{$un}'";
    $unId = $conn->query($findUserInfo)->fetch_assoc()['id'];
    $nk = $conn->query($findUserInfo)->fetch_assoc()['nickname'];
  }
?>
<body class="mt-5">
  <!-- navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="./boots_layout.php">留言板</a>
    <span class="navbar-text">
        <?
        if ($un) {
          echo "login ✅  Hello! $un ( $nk )";
        } else {
          echo "login ❌  要登入才能留言 ";
        }
        ?>
    </span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <?
        if (!$un) {
          echo "
          <li class=nav-item>
            <a class=nav-link href=./verify.php>登入</a>
          </li>
          ";
        }
        if ($un) {
          echo "
          <li class=nav-item>
          <a class=nav-link href=./logout.php>登出</a>
          </li>";
        }
        ?>
      </ul>
    </div>
  </nav> 

<div class="container">
    <!-- you can send main comment if login -->
    <?php
      if ( $un ){
          echo "
            <div class='card border-primary row justify-content-center sticky-top'>
              <div class='card-header'>
                <h4 class='text-center'>輸入主留言</h4>
              </div>
              <div class='card-body'>
                  <form action=./action/create_comment.php method=post>
                    <label for=main_comment>Main Comment</label>
                    <textarea class=form-control rows=2 name=main_comment id=main_comment placeholder='type comment here' required></textarea>
                    <input type=hidden name=user_id value={$unId}>
                    <button type=submit class='btn btn-outline-primary btn-lg btn-block mt-3'>送出</button>
                  </form>
              </div>
            </div>
            ";
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

          echo "<div class='card border-success mt-3'>
                  <div class=card-header>
                    main comment {$id}。Post at : {$created_at}
                  </div>
                  <div class=card-body>
                    <h4 class=card-title>暱稱：{$nickname}</h4>
                    <h5>{$content}</h5>
                  </div>
                ";

          if ( $unId === $main_user_id) {
                  echo "
                  <div class='d-flex justify-content-around'>
                    <div>
                      <form action=./edit.php method=post>
                        <input type=hidden name=comment_id value={$id}>
                        <input type=hidden name=comment_content value={$content}>
                        <button type=submit class='btn btn-outline-warning'>EDIT</button>
                      </form>
                    </div>

                    <div>
                      <form action=./action/delete_comment.php method=post >
                        <input type=hidden name=comment_id value={$id}>
                        <button type=submit class='btn btn-outline-danger'>DELETE</button>
                      </form>
                    </div>
                  </div>
                  ";
          }

            // read all sub_comments from mySQL
            $read_subAll = "SELECT * FROM `sub_comments` WHERE comment_id = $id ORDER BY created_at DESC";
            $sub_result = $conn->query($read_subAll);

            if ($sub_result->num_rows > 0) {
                while ($sub_row = $sub_result->fetch_assoc()) {
                    $sub_id = $sub_row["id"];
                    $sub_user_id = $sub_row["user_id"];
                    $sub_content = $sub_row["sub_content"];
                    $created_at = $sub_row["created_at"];

                    $findAuthorInfo = "SELECT * FROM `users` WHERE `id` = '{$sub_user_id}'";
                    $sub_nickname = $conn->query($findAuthorInfo)->fetch_assoc()['nickname'];


                    echo "
                          <div class='row justify-content-center'>
                    ";
                    // 原作者在自己的留言底下回覆的話，背景會顯示不同的顏色
                    if ($sub_user_id === $main_user_id) {
                        echo "<!--author's sub comment -->
                                <div class='card border-danger col-8'>
                                  <div class=card-body>
                                    <h4 class='card-title text-center'>Author: {$sub_nickname} </h4>

                                    <p class=card-text>reply at: {$created_at}</p>
                                    <p class=card-text>{$sub_content}</p>
                                  </div>
                                </div>
                          ";
                    } else {
                        echo "<!-- sub comment -->
                              <div class='card border-warning col-10'>
                                <div class=card-body>
                                  <p class=card-text>reply at: {$created_at}</p>
                                  <h6 class=card-title>{$sub_nickname} :</h6>
                                  <p class=card-text>{$sub_content}</p>
                                </div>
                              </div>
                        ";
                    }
                    echo "
                      </div>
                    ";
                }
            }
            if ($un) {
                echo "
                    <!-- write a sub comment here -->
                    <div class='row justify-content-center'>
                      <div class='card bg-light col-10 mb-3'>
                        <form action=./action/create_sub_comment.php method=post>
                          <fieldset>
                            <h4 class='text-center font-weight-light mt-3 mb-0'>子留言</h4>
                              <div class=form-group>
                                <label for=sub_comment class=mb-0>reply</label>
                                <textarea class=form-control rows=5 cols=30 name=sub_comment id=sub_comment required></textarea>
                              </div>

                              <div class=form-group>
                                <input type=hidden name=comment_id value={$id}>
                                <input type=hidden name=user_id value={$unId}>
                                <button type=submit class='btn btn-primary'>送出</button>
                              </div>

                          </fieldset>
                        </form>
                      </div>
                    </div>
                        ";
            }

            echo "</div>";
        }
      }
    ?>

  <div class='fixed-bottom'>
    <ul class="pagination justify-content-start">
    <? // pages
      for ($i=1; $i <= $pages_count; $i++){
        if($current_page == $i){    // !: [疑問] 不能使用 '===' 
          echo "
          <li class='page-item active'>
            <a class=page-link href=boots_layout.php?page={$i}>{$i}</a>
          </li>";

        } else {
          echo "
          <li class=page-item>
            <a class=page-link href=boots_layout.php?page={$i}>{$i}</a>
          </li>
          ";
        }
      }
    ?>
    </ul>
  </div> 
</div><!-- container -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./script/jquery.js"></script>
    <script src="./script/popper.min.js"></script>
    <script src="./script/bootstrap.min.js"></script>
    <script src="./script/main.js"></script>
  </body>
</html>