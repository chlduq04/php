<?session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insert title here</title>
<script type="text/javascript">

</script>
</head>
<body>
	<?
	if($_SESSION['userid']="")
	{
		?>
	<form name="write_form_modify" method="post" action="./login_check.php">
		<table width="400" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td width="200">아이디</td>
				<td width="200"><input name="id" id="id"></input></td>
			</tr>
			<tr>
				<td width="200">비밀번호</td>
				<td width="200"><input name="password" id="password"></input></td>
			</tr>
		</table>
		<td><Button type="submit">확 인</Button> <a
			href="http://localhost/startphp/join.php">회원가입 </a>
		</td>
	</form>

	<?}
	else{
		$userid = $_SESSION['userid'];
		$username = $_SESSION['username'];
		echo $userid."님 안녕하세요";
		?>
	<?}

	?>
</body>
</html>
