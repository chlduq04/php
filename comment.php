<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<title>Insert title here</title>
<script language="javascript">
            function check_form(form){
                if (!reply_form.name.value) {
                    alert('이름을 입력하세요.');
                    reply_form.name.focus();
                    return;
                }
                
                if (!reply_form.content.value) {
                    alert('글 내용을 입력하세요.');
                    reply_form.content.focus();
                    return;
                }
                reply_form.submit();
            }
            
            function check_form_modify(form){
                if (!reply_form_modify.name.value) {
                    alert('이름을 입력하세요.');
                    reply_form.name.focus();
                    return;
                }               
                
                if (!reply_form_modify.content.value) {
                    alert('글 내용을 입력하세요.');
                    reply_form.content.focus();
                    return;
                }
                reply_form_modify.submit();
            }
        </script>
</head>
<?
$mode = $_GET['mode'];
$reply_id = $_GET['reply_id'];

if($mode=="reply"){
	?>
<body>
	<form name="reply_form" method="post" action="./comment.php?&mode=post&r_id=<?echo("$reply_id");?>">
		<table width="750" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100">이름</td>
				<td width="650"><input type="text" name="name" size="20">
				</td>
			</tr>

			<tr>
				<td>글 내용</td>
				<td><br> <textarea name="content" cols="88" rows="10">
                        </textarea>
				</td>
			</tr>
		</table>
		<br>
		<table width="750" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center"><input type="button" onclick="check_form();"
					value="입력 확인"><input type="button" onclick="form.reset();"
					value="다시 쓰기">
				</td>
			</tr>
		</table>
	</form>
</body>
<?
} else if($mode=="post"){
	
	$name = $_POST['name'];
	$id = $_GET['r_id'];
	$content = $_POST['content'];

	include "./connect_sql.php";
	$query = "update $table_name set comment = comment+1 where board_id =" .$id;	
	$result = mysql_query($query, $dbconn);
	
	$title = addslashes($title);
	$content = addslashes($content);
	$register_date = time();
	$query = "insert into $comment_name (name,comments,board_id,register_date) values ('".$name."','" .$content."','".$id."','".$register_date ."')";
	$result = mysql_query($query, $dbconn);

	?>
	<script language = "javascript">
        document.location.href = './board.php';
    </script>
<?
}
?>
</html>

