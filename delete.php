<?
$id = $_GET['delete_id'];
include "./setup.php";

$query = "delete from $comment_name where board_id=".$id;
echo($query);
$result = mysql_query($query, $dbconn);
$query = "delete from $table_name where board_id=" .$id;
$result = mysql_query($query, $dbconn);

?>
	<script language = "javascript">
        document.location.href = './board.php';
    </script>