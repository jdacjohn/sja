<?php $pagetitle = "Announcements"; include 'core/base.php'; include $head;





echo '<h1>'.$pagetitle.'</h1>';
$getcount = mysql_query ("SELECT COUNT(*) FROM announce");
$postnum = mysql_result($getcount,0);
$limit = 10;
if($postnum > $limit)
	{
	$tagend = round($postnum % $limit,0); $splits = round(($postnum - $tagend)/$limit,0);
	if($tagend == 0){$num_pages = $splits;} else{$num_pages = $splits + 1;}
	if(isset($_GET['pg'])){$pg = $_GET['pg'];} else{$pg = '1';}
	$startpos = ($pg*$limit)-$limit;
	$limstring = "LIMIT $startpos,$limit";
	}
	else {$limstring = "LIMIT 0,$limit";}
if($postnum > $limit)
	{
	echo '<div class="pages" id="top">'; $m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
	if($pg > 1){echo '<a href="/wip/?pg=1">&laquo;</a> <a href="/wip/?pg='.$p.'">&lsaquo;</a> ';} else{}
	if($q > 0) {echo '<a href="/wip/?pg='.$q.'">'.$q.'</a> ';} else {}
	if($p > 0) {echo '<a href="/wip/?pg='.$p.'">'.$p.'</a> ';} else {}
	echo "<span>$pg</span> ";
	if($n <= $num_pages) {echo '<a href="/wip/?pg='.$n.'">'.$n.'</a> ';} else {}
	if($m <= $num_pages) {echo '<a href="/wip/?pg='.$m.'">'.$m.'</a> ';} else {}
	if($pg < $num_pages){echo '<a href="/wip/?pg='.$n.'">&rsaquo;</a> <a href="/wip/?pg='.$num_pages.'">&raquo;</a>';} else {}
	echo '</div>';
	} else {}
$result = mysql_query("SELECT announce_id, announce_name, announce_full, announce_date FROM announce ORDER BY announce_date DESC $limstring") or die(mysql_error());
if(mysql_num_rows($result)==0)
	{
	echo '<p>This page is coming soon.</p>';
	}
else
	{
	while($row = mysql_fetch_array($result))
		{ $announce_id=$row['announce_id']; $announce_name=$row['announce_name']; $announce_date=convert_date($row['announce_date']);
		
		$announce_full = cleanHTML(strip_tags(html_entity_decode($row['announce_full'], ENT_QUOTES, 'utf-8'),$allowed_html));
		
			echo '<hr><p><strong>'.$announce_name.'</strong> &middot; <em>'.$announce_date.'</em><br>';
			echo ''.$announce_full.'</p>';					
		}
	}
if($postnum > $limit)
	{
	echo '<div class="pages">'; $m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
	if($pg > 1){echo '<a href="/wip/?pg=1">&laquo;</a> <a href="/wip/?pg='.$p.'">&lsaquo;</a> ';} else{}
	if($q > 0) {echo '<a href="/wip/?pg='.$q.'">'.$q.'</a> ';} else {}
	if($p > 0) {echo '<a href="/wip/?pg='.$p.'">'.$p.'</a> ';} else {}
	echo "<span>$pg</span> ";
	if($n <= $num_pages) {echo '<a href="/wip/?pg='.$n.'">'.$n.'</a> ';} else {}
	if($m <= $num_pages) {echo '<a href="/wip/?pg='.$m.'">'.$m.'</a> ';} else {}
	if($pg < $num_pages){echo '<a href="/wip/?pg='.$n.'">&rsaquo;</a> <a href="/wip/?pg='.$num_pages.'">&raquo;</a>';} else {}
	echo '</div>';
	} else {}





include $foot; ?>