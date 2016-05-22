<?php

// DB接続に重要な情報

define("DNS", 'mysql:host=localhost;dbname=nowall_login;charset=utf8');
define(USER, 'testuser');
define(PASSWORD, 'testuser');

// エラーレベルの設定

error_reporting(E_ALL & ~E_NOTICE);
