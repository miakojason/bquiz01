<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "./front/marquee.php"; ?>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<h3>更多最新消息區</h3>
	<hr>
	<?php
	$total = $DB->count(['sh' => 1]);
	$div = 5;
	$pages = ceil($total / $div);
	$now = $_GET['p'] ?? 1;
	$start = ($now - 1) * $div;
	$news = $News->all(['sh' => 1], " limit $start,$div");
	?>
	<ol start="<?= $start + 1; ?>">
		<?php
		foreach ($news as $n) {
			echo "<li class='ssww>";
			echo mb_substr($n['text'], 0, 20);
			echo "<div class='all'>";
			echo $n['text'];
			echo "</div>";
			echo "...</li>";
		}
		?>
		<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
		</div>
	</ol>
	<div class="cent">
		<?php
		if ($now > 1) {
			$prev = $now - 1;
			echo "<a href='?do=$do&p=$prev'> < </a>";
		}
		for ($i = 1; $i <= $pages; $i++) {
			$fontsize = ($now == $i) ? '24px' : '16px';
			echo "<a href='?do=$do&p=$i' style='cont-size:$fonsize>$i</a>";
		}
		if ($now < $pages) {
			$pages = $now + 1;
			echo "<a href='?do=$do&p=$pages'> > </a>";
		}
		?>
	</div>
</div>
<script>
	$(".sswww").hover(
		function() {
			$("#alt").html("" + $(this).children(".all").html() + "").css({
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