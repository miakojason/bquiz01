<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">最新消息資料管理</p>
    <form method="post" action="./api/edit.php">
        <table width="100%" style="text-align: center">
            <tbody>
                <tr class="yel">
                    <td width="80%">最新消息資料內容</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                </tr>
                <?php
                $total=$DB->count();//獲取數據庫中記錄的總數
                $div=5;//設定每頁顯示的記錄條數，這裡是5條。
                $pages=ceil($total/$div);//計算總頁數，通過將總記錄數除以每頁的記錄條數取上限得到。
                $now=$_GET['p']??1;//從 GET 獲取當前頁數（p ），如果沒有，給他默認為1
                $start=($now-1)*$div;//計算當前頁的起始位置，用於數據庫查詢時的 LIMIT 子句。
                $rows=$DB->all(" limit $start,$div");//用 $DB 的 all 方法，用 LIMIT 子句來限制返回的記錄條數和起始位置。
                foreach($rows as $row){
                ?>
                <tr>
                    <td>
                        <textarea type="text" name="text[]" style="width:90%;height:60px"><?=$row['text'];?></textarea>
                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                    </td>
                    <td>
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="cent">
            
            <?php
                if($now>1){//檢查當前頁是否大於1，如果是，則顯示一個包含向前箭頭的連結。點擊這個連結將使頁面跳轉到前一頁。
                    $prev=$now-1;//計算前一頁的頁碼
                    echo "<a href='?do=$do&p=$prev'> < </a>";//顯示包含向前箭頭的連結，該連結將重新加載頁面並顯示前一頁的內容。
                }

                for($i=1;$i<=$pages;$i++){//for 迴圈，用於生成所有頁碼的連結。
                    $fontsize=($now==$i)?'24px':'16px';//根據當前頁碼是否等於循環變量 $i，動態設置字體大小，如果相等，字體大小為24px，否則為16px。
                    echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>";//顯示包含頁碼的連結，並根據前面計算的字體大小應用樣式。
                }

                if($now<$pages){//這部分代碼檢查當前頁是否小於總頁數，如果是，則顯示一個包含向後箭頭的連結。點擊這個連結將使頁面跳轉到下一頁。
                    $next=$now+1;//計算下一頁的頁碼。
                    echo "<a href='?do=$do&p=$next'> > </a>";//顯示包含向後箭頭的連結，該連結將重新加載頁面並顯示下一頁的內容。
                }
            ?>
        </div>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <input type="hidden" name="table" value="<?=$do;?>">
                    <td width="200px"><input type="button" onclick="op('#cover','#cvr','./modal/<?=$do;?>.php?table=<?=$do;?>')" value="新增最新消息資料"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>

    </form>
</div>