<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />

  <title>message board</title>
</head>
<body>
  <div class="container">
    <!-- write a main comment -->
    <form action="./comments/comment.php" method="post">
    <!-- <form action="./showBoard.php" method="post"> -->
      <div class="container__input">
      <h2>輸入主留言</h2>
          <label for="nickname">Nickname</label>
          <input type="text" name="nickname" id="nickname" required>
          <label for="main_comment">Comment</label>
          <textarea rows="5" cols="30" name="main_comment" id="main_comment" required></textarea>
          <button type="submit">submit</button>
      </div>
    </form>

<?php

//conncet to mySQL
require './db/conn.php';
//
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
      $nickname = $row["nickname"];
      $content = $row["content"];
      $created_at = $row["created_at"];

echo "<div class=container__box>main comment {$id}。 at : {$created_at}
          <div class=box__nickname>暱稱：{$nickname}</div>
          <div class=box__content>留言：<p>{$content}</p></div>";


// read all sub_comments from mySQL
$read_subAll = "SELECT * FROM `sub_comments` WHERE comment_id = $id ORDER BY created_at DESC";
$sub_result = $conn->query($read_subAll);

if ($sub_result->num_rows > 0) {
    while ($sub_row = $sub_result->fetch_assoc()) {
        $sub_id = $sub_row["id"];
        $sub_nickname = $sub_row["nickname"];
        $sub_content = $sub_row["sub_content"];
        $created_at = $sub_row["created_at"];
        echo "<!-- sub comment -->
          <div class=box__reply>
            <div class=reply__nickname>{$sub_nickname}  at: {$created_at}</div>
            <div class=reply__content>{$sub_content}</div>
          </div>";
    }
}
          echo"
          <!-- write a sub comment here -->
          <form action=./comments/sub_comment.php method=post>
            <div class=container__input>
              <h2>子留言</h2>
              <label for=nickname>Nickname</label>
              <input type=text name=nickname id=nickname required>
              <label for=sub_comment>Comment</label>
              <textarea rows=5 cols=30 name=sub_comment id=sub_comment required></textarea>
              <input type=hidden name=comment_id value={$id}>
              <button type=submit>submit</button>
            </div>
          </form>
        </div>";
        }
      }

  ?>
  </div>

  <div class="page">
        <? // pages
          for ($i=1; $i <= $pages_count; $i++){
            if($i === $current_page){
              echo "<b>{$i}</b>";
              // echo "<span><b>{$i}</b></span>";
            } else {
              echo "<a href=board.php?page={$i}>{$i}</a>";
              // echo "<span><a href=board.php?page={$i}>{$i}</a></span>";
            }
          }

        ?>
  
  </div> 
</body>
</html>