<?php include_once "./db.php" ;
$table=$_POST['table'];
$DB=${ucfirst($table)};
unset($_POST['table']);//移除post 陣列中hidden的table字串，db運作查詢才會正常

foreach($_POST['text'] as $id => $text){
if(isset($_POST['del']) && in_array($id,$_POST['del'])){
    $DB->del($id);
}else{
    $row=$DB->find($id);
    $row['text']=$text;
    $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
    $DB->save($row);
}
}
to("../back.php?do=$table");
?>