<?php

require_once('config.php');
require_once('functions.php');

session_start();
$dbh = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $password = $_POST['password'];

  $errors = array();

  // バリデーション
  if ($name == '')
  {
    $errors['name'] = 'ユーザネームが未入力です';
  }

  if ($password == '')
  {
    $errors['password'] = 'パスワードが未入力です';
  }

  //---------------------
  //重複チェック
  //---------------------

  $stmt = $dbh -> query("select * from users");
  while($item = $stmt->fetch()) {
    if($item['name'] == $name){
      $errors['name'] = '既に登録されているユーザーネームなので変更してください。';
    }else{
      $name = $name;
    }
  }

  // バリデーション突破後
  if (empty($errors))
  {

    //------------SALT作成-----------
    $salt1 = pack('H*', $dsnsalt1);
    $salt = $id . $salt1;
    //------------STRETCHING--------
    $hash ='';
    for($i = 0; $i < $dsnsalt2; $i++) { $hash = hash('sha256', $hash.$pass.$salt); }
    //------------INSERT-------------

    $sql = "insert into users (name, password, created_at) values (:name, :password, now());";
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":password", $hash, PDO::PARAM_STR);

    $stmt->execute();

    var_dump($_POST);
    echo '<hr>';
    var_dump($errors);

    header('Location: signup.php');
    exit;

  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規登録画面</title>
</head>
<body>
<h1>新規登録画面です</h1>
<form action="" method="post">
  ユーザネーム: <input type="text" name="name">
  <?php if ($errors['name']) : ?>
    <?php echo h($errors['name']) ?>
  <?php endif; ?>
  <br>
  パスワード: <input type="text" name="password">
  <?php if ($errors['password']) : ?>
    <?php echo h($errors['password']) ?>
  <?php endif; ?>
  <br>
  <input type="submit" value="新規登録">
</form>
<a href="login.php">ログインはこちら</a>
</body>
</html>