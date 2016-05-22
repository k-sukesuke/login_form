<?php

// DB接続
function connectDatabase()
{
  try
  {
    return new PDO('mysql:host=localhost;dbname=nowall_login;charset=utf8', USER, PASSWORD);
  }
  catch (PDOException $e)
  {
    echo $e->getMessage();
    exit;
  }
}

// エスケープ処理
function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
