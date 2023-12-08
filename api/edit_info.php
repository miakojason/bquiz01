<?php
include_once "./db.php";
$table=$_POST['table'];//取得資料表名稱
$DB=${ucfirst($table)};//將資料表名稱轉為首字大寫物件變數$$可變變數
$data=$DB->find(1);//取得id為1的資料
$data[$table]=$_POST[$table];//將資料對應欄位的資料修改為post過來的值
$DB->save($data);//使用save更新資料
to("../back.php?do=$table");
?>