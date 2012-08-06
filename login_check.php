<?session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insert title here</title>
</head>

<?

include './connect_sql.php';
$id = $_POST['id'];
$pass = $_POST['password'];
if($id||$pass)
{
	echo"<script>
	alert('아이디와 비밀번호를 올바르게 입력하세요');
	history.back();
	<script>";
}
$query = "select count(id) from user where id = "."'".$id."'";
$result = mysql_query($query, $dbconn);
if(mysql_result($result,0,0)==0){
	echo"<script>
	alert('등록된 사용자가 없습니다');
	history.back();
	<script>";
}
else{
	$query = "select password name from user where id = "."'".$id."'";
	$result = mysql_query($query, $dbconn);
	if(mysql_result($result,0,0)==$_POST['password']){
		$_SESSION['userid']=$id;
		$_SESSION['username']=mysql_result($result,0,1);
		?>
<body>
	<script language="javascript">
        document.location.href = './board.php';
   		 </script>
</body>
<?
	}
	else
	{
		?>
<body>땡
</body>
<?
	}
}
?>