<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" media="screen" href="./css/minty.min.css">
  <title>verify page</title>
</head>
<body class="mt-5">

  <div class="container col-8">
    <a class="btn btn-outline-primary btn-lg" href="./boots_layout.php" role="button">留言板</a>
    <div class='card border-primary mt-3'>
      <div class=card-header>
        <h1>登入</h1>
      </div>
      <form action="./login.php" method="post">
        <div class=card-body>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="username">username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="使用者" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="password">password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="密碼" required>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Log in</button>
        </div>
      </form>
    </div>

    <div class='card border-warning mt-3'>
      <div class=card-header>
        <h1>註冊</h1>
      </div>
      <form action="./signup.php" method="post">
        <div class=card-body>
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="username">username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="使用者" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="nickname">nickname</label>
              <input type="text" class="form-control" id="nickname" name="nickname" placeholder="暱稱" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="password">password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="密碼" required>
            </div>
          </div>
          <button class="btn btn-warning btn-block" type="submit">sign up</button>
        </div>
      </form>
    </div>
    
  </div> <!--  container -->

</body>
</html>