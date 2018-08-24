  <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />


<div class="container">
  <a href=./board.php> 留言板 </a>

  <div class="container__input">
  
    <h1 class>登入</h1>
    <form action="./login.php" method="post">
    <label for="username">username:</label>
    <input type="text"  name="username" required/> <br>
    <label for="password">password:</label>
    <input type="password"  name="password" required/> <br>
      <button type="submit">log in</button>
    </form>
  </div>
  
  
  <div class="container__input">
  
    <h1>註冊</h1>
    <form action="./signup.php" method="post">
      <label for="username">username:</label>
      <input type="text"  name="username" required/> <br>
      <label for="nickname">nickname:</label>
      <input type="text"  name="nickname" required/> <br>
      <label for="password">password:</label>
      <input type="password"  name="password" required/> <br>
      <button type="submit">sign up</button>
    </form>
  
  </div>

</div>

