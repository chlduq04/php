
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script src="jquery.js">
        </script>
</head>
<body>
	<?
	include "./connect_sql.php";
	include "./setup.php";
	$table_name = "board_free";
	$search= $_GET['search'];
	$order_by = $_GET['order'];
	if($search== null)
		$search= "";
	if($order_by == null)
		$order_by = "register_date";
	//click title -> read mode
	if($_GET['mode']=="read") {
		$read_id = $_GET['read_id'];
		$query = "update $table_name set hit = hit + 1 where board_id =" .$read_id;
		$result = mysql_query($query, $dbconn);
		$query = "select name, title, content from $table_name where board_id = ".$read_id;
		$result = mysql_query($query, $dbconn);
		$name = mysql_result($result, 0, 0);
		$title = mysql_result($result, 0, 1);
		$content = mysql_result($result, 0, 2);
		$title = htmlspecialchars($title);//delete html tag
		$title = stripslashes($title);//delete '\' from title
		if(strcmp($html_tag, "on"))
			$content = htmlspecialchars($content);

		$content = stripslashes($content);
		$content = nl2br($content);//'new line' charge <BR> tag
		?>

	<table width="750" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100">글 쓴이</td>
			<td width="650"><?echo("$name");?></td>
		</tr>
		<tr>
			<td width="100">글 제목</td>
			<td width="650"><?echo("$title");?></td>
		</tr>
		<tr>
			<td width="100">글 내용</td>
			<td width="650"><?echo("$content");?></td>
		</tr>
	</table>
	<br>
	<table width="750" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="375"><a href="./board.php">[글 목록]</a> <a
				href="./write.html?mode=form">[글 쓰기]</a></td>
			<td width="375" align="right"><a
				href="./comment.php?mode=reply&reply_id=<?echo("$read_id");?>">[답글쓰기]</a>
				<a href="./write.html?mode=modify&modify_id=<?echo("$read_id");?>">[글수정]</a>
				<a href="./delete.php?&delete_id=<?echo("$read_id");?>">[글삭제]</a></td>
		</tr>
	</table>
	<?
	$query = "select name, comments, register_date from $comment_name where board_id=".$read_id ." order by register_date";
	$result = mysql_query($query, $dbconn);
	$total_record = mysql_num_rows($result);

	?>
	<table width="750" border="1" cellspacing="0" cellpadding="0">
		<td width="100">글쓴이</td>
		<td width="100">글 내용</td>
	</table>
	<?
	for($i = 0; $i < $total_record; $i++)
	{
		$names = mysql_result($result, $i, 0);
		$comments = mysql_result($result, $i, 1);
		$register_date = mysql_result($result, $i, 2);
		$names = htmlspecialchars($names);
		$names = stripslashes($names);
		$register_date = date("Y-m-d", $register_date);
		?>
	<table width="750" border="1" cellspacing="0" cellpadding="0">

		<td width="650"><?echo("$names");?>
		</td>
		<td width="650"><?echo("$comments");?>
		</td>
	</table>
	<?
	}
	?>
	<br>
	<?
	}
	?>

	<table width="750" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td width="50" align="center">번호</td>
			<td width="420" align="center"><a href="./board.php?order=title&search=<?echo($search);?>">글 제목</a>
			</td>
			<td width="100" align="center"><a href="./board.php?order=name&search=<?echo($search);?>">글 쓴이</a>
			</td>
			<td width="100" align="center"><a
				href="./board.php?order=register_date&search=<?echo($search);?>">등록 일자</a>
			</td>
			<td width="80" align="center"><a href="./board.php?order=hit&search=<?echo($search);?>">조회수</a>
			</td>
		</tr>
		<?	
		
		$query = "select board_id, comment, name, title, register_date, hit from $table_name where title and content and name like CONCAT('%','$search','%') order by ".$order_by;
		$result = mysql_query($query, $dbconn);
		$total_record = mysql_num_rows($result);
		$article_no = $total_record;
		$page = $_GET['page'];
		if(!$page){
			$page = 0;
		}
		for($i = $total_record-$pagenation*$page; ($i >$total_record-($page+1)*$pagenation)&&($i>0); $i--) {
			$id = mysql_result($result, $i-1, 0);
			$comment = mysql_result($result, $i-1, 1);
			$name = mysql_result($result, $i-1, 2);
			$title = mysql_result($result, $i-1, 3);
			$register_date = mysql_result($result, $i-1, 4);
			$hit = mysql_result($result, $i-1, 5);
			$title = htmlspecialchars($title);
			$title = stripslashes($title);
			$register_date = date("Y-m-d", $register_date);
			$pagenum = $article_no-$pagenation*($page);
			?>
		<tr>
			<td align="center"><?echo("$pagenum");?>
			</td>
			<td><a href="./board.php?mode=read&read_id=<?echo("$id");?>"><?echo("$title");?>
			</a>
			</td>
			<td align="center"><?echo("$name");?>
			</td>
			<td align="center"><?echo("$register_date");?>
			</td>
			<td align="center"><?echo("$hit");?>
			</td>
		</tr>
		<?	
		$article_no--;
		}
		if(!$total_record) {
			?>
		<tr>
			<td align="center" colspan="5">등록된 글이 없습니다.</td>
		</tr>
		<?
		}
		?>
	</table>
	<br>
	<table width="750" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left"><?
			
			$total_record = mysql_num_rows($result);
			for($i = 0; $i < $total_record/$pagenation; $i++)
			{?> <a
				href="./board.php?&page=<?echo($i);?>&search=<?echo($search)?>"><?echo($i+1);?>
			</a> <?} 
			?></td>
			<td align="right">
				<form name = "myform">
					<input name="search" id="search_field"></input>
					<button>search</button>
					<a href="./board.php">[글 목록]</a> <a href="./write.html?mode=form">[글
						쓰기]</a>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
