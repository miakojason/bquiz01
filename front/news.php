<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "./front/marquee.php"; ?>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<h3>更多消息顯示區</h3>
	<hr>
	<ol class="ssaa" style="list-style-type:decimal;">
		<?php
		$total = $DB->count(['sh' => 1]); //獲取數據庫中記錄的總數
		$div = 5; //設定每頁顯示的記錄條數，這裡是5條。
		$pages = ceil($total / $div); //計算總頁數，通過將總記錄數除以每頁的記錄條數取上限得到。
		$now = $_GET['p'] ?? 1; //從 GET 獲取當前頁數（p ），如果沒有，給他默認為1
		$start = ($now - 1) * $div; //計算當前頁的起始位置，用於數據庫查詢時的 LIMIT 子句。
		$rows = $News->all(['sh' => 1](" limit $start,$div")); //用 $DB 的 all 方法，用 LIMIT 子句來限制返回的記錄條數和起始位置。
		foreach ($news as $n) {
			echo "<li class='sswww'>";
			echo mb_substr($n['text'],0,20);
			echo "<div class='all' style='display:none'>";
			echo $n['text'];
			echo "</div>";
			echo "...</li>";
		}
		?>
	</ol>
	<div class="cent">

		<?php
		if ($now > 1) { //檢查當前頁是否大於1，如果是，則顯示一個包含向前箭頭的連結。點擊這個連結將使頁面跳轉到前一頁。
			$prev = $now - 1; //計算前一頁的頁碼
			echo "<a href='?do=$do&p=$prev'> < </a>"; //顯示包含向前箭頭的連結，該連結將重新加載頁面並顯示前一頁的內容。
		}
		for ($i = 1; $i <= $pages; $i++) { //for 迴圈，用於生成所有頁碼的連結。
			$fontsize = ($now == $i) ? '24px' : '16px'; //根據當前頁碼是否等於循環變量 $i，動態設置字體大小，如果相等，字體大小為24px，否則為16px。
			echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>"; //顯示包含頁碼的連結，並根據前面計算的字體大小應用樣式。
		}
		if ($now < $pages) { //這部分代碼檢查當前頁是否小於總頁數，如果是，則顯示一個包含向後箭頭的連結。點擊這個連結將使頁面跳轉到下一頁。
			$next = $now + 1; //計算下一頁的頁碼。
			echo "<a href='?do=$do&p=$next'> > </a>"; //顯示包含向後箭頭的連結，該連結將重新加載頁面並顯示下一頁的內容。
		}
		?>
	</div>
	<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
	<script>
		$(".sswww").hover(
			function() {
				$("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({
					"top": $(this).offset().top - 50
				})
				$("#alt").show()
			}
		)
		$(".sswww").mouseout(
			function() {
				$("#alt").hide()
			}
		)
	</script>
</div>