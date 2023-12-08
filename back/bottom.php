<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">頁尾版權資料管理</p>
    <form method="post"  action="./api/edit_info.php">
 <!--現在被include到back.php所以是以back.php位子當前./的位子去找api資料夾。不是從back資料夾../上層去找到api/edit_total.php -->
        <table style="width:50%; margin:auto;">
            <tbody>
                <tr class="yel">
                    <td width="50%">頁尾版權資料:</td>                         <!-- find()查找id為1的total -->
                    <td width="50%"><input type="text" name="bottom" value="<?=$Bottom->find(1)['bottom']?>"></td>
                    <input type="hidden" name="table"  value="<?=$do?>">
                </tr>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
