<?php
$id = $_POST['comment_id'];
// $unId = $_POST['author'];
$content = $_POST['comment_content'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
  <title>更改主留言</title>
</head>
<body>
  <!-- write a main comment -->
    <form action=./action/edit_comment.php method=post>
    <!-- <form action=./action/edit_comment.php method=post> -->
      <div class=container__input>
      <h2>更改主留言</h2>
          <label for=main_comment>Comment</label>
          <textarea rows=5 cols=30 name=main_comment id=main_comment required><?php echo $content ?></textarea>

          <?
          echo "
          <input type=hidden name=comment_id value= {$id} >
          ";
          // * 帶出去資料： cookie / comment_id / content
          ?>
          
          <button type=submit>submit</button>
      </div>
</body>
</html>