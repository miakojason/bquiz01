<?php
include_once "./db.php";
//' OR 1=1; <=SQL注入 隱碼攻擊
//過濾表單資料
$acc=htmlspecialchars($_POST['acc']);
$pw=htmlspecialchars($_POST['pw']);
if($Admin->count(['acc'=>$acc,'pw'=>$pw])>0){
    $_SESSION['login']=$acc;
    to("../back.php?do=title");
}else{
    to("../index.php?do=login&error=帳號密碼或錯誤");
}

?>