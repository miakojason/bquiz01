<?php
include_once "./db.php";
//' OR 1=1; <=SQL注入 隱碼攻擊
//過濾表單資料
// $acc=htmlspecialchars($_POST['acc']);
// $pw=htmlspecialchars($_POST['pw']);
//改為從源頭DB解決
if($Admin->count(['acc'=>$_POST['acc'],'pw'=>md5($_POST['pw'])])>0){
    $_SESSION['login']=$_POST['acc'];
    to("../back.php?do=title");
}else{
    to("../index.php?do=login&error=帳號密碼或錯誤");
}

?>