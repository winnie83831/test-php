<?php
include_once("conn.php");
//刪除確認判斷與執行
if(isset($_POST["action"]) && $_POST["action"]=="delete"){
//	echo "有按下刪除紐";
	//執行刪除
	$sql_query = "DELETE FROM account_info WHERE aId=?";
	$stmt = $db_link->prepare($sql_query);
	$stmt -> bind_param("i",$_POST["aId"]);
	$stmt -> execute();
	$stmt -> close();
	$db_link -> close();
	header("location:list.php");
}
//顯示資料
//如果是id撈取資料
if( isset($_GET["id"]) && $_GET["id"] !="" ){
//	echo "找id資料";
	$sql_select = "SELECT aId, aAccount, aName, aSex, aBirthday, aMail, aNote FROM account_info WHERE aId =?";
	$stmt = $db_link ->prepare($sql_select);
	$stmt->bind_param("i",$_GET["id"]);
	$stmt->execute();
	$stmt -> bind_result($aid,$aaccount,$aname,$asex,$abirthday,$amail,$anote);
	$stmt->fetch();
	if($asex=="1"){
		$asex="男";
	}else{
		$asex="女";
	}
}else{
//	echo "導回到data.php";
	//header("location:data.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>刪除資料</title>
<link rel="stylesheet" href="CSS/bootstrap.min.css">
<script src="JS/bootstrap.min.js"></script>
<script src="JS/popper.min.js"></script>
</head>
<style>
	body{
		font-size:0.8rem;
		}
	</style>
<body>
	<div class-"container">
		<div>
		<h1 class="text-center">是否確認刪除資料</h1>
			<div class="offset-5">

				<p>帳號: <?php echo $aaccount; ?></p>
				<p>姓名: <?php echo $aname; ?></p>
				<p>性別: <?php echo $asex; ?></p>
				<p>生日: <?php echo $abirthday; ?></p>
				<p>信箱: <?php echo $amail; ?></p>
				<p>備註: <?php echo $anote; ?></p>
				
				<form action="delete.php" method="post">
				<p>
					<input class="btn btn-warning" type="button" name="back" id="back" value="回上一頁" onclick="history.back()">
					
					<input name="action" type="hidden" value="delete">
					<input name="aId" type="hidden" value="<?php echo $aid; ?>">
					<input class="btn btn-danger" type="submit" name="submit" id="submit" value="確認刪除" onclick="return confirm('是否確認刪除這筆資料');">
					
					
			</p>
					</form>
				</div>
		</div>
		</div>
</body>
</html>
<?php 
$stmt->close();
$db_link->close();
?>