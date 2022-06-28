<?php
//接收id作為撈取資料的依據

include_once("conn.php");
//如果是action以及值是update做更新資料
if(isset($_POST["action"]) && $_POST["action"]=="update"){
//	echo "有提交表單";
	//可以進行update
	$sql_query = "UPDATE account_info SET aAccount=?, aName=?, aSex=?, aBirthday=?, aMail=?,  aNote=? WHERE aId=?";
	$stmt=$db_link->prepare($sql_query);
	$stmt->bind_param("ssssssi",$_POST["aAccount"], $_POST["aName"], $_POST["aSex"] , $_POST["aBirthday"], $_POST["aMail"], $_POST["aNote"],  $_POST["cID"]);
	$stmt->execute();
	$stmt->close();
	$db_link->close();
	header("location:list.php");
}

//如果是id撈取資料
if( isset($_GET["id"]) && $_GET["id"] !="" ){
//	echo "找id資料";
	$sql_select = "SELECT aId, aAccount, aName, aSex, aBirthday, aMail, aNote FROM account_info WHERE aId =?";
	$stmt = $db_link -> prepare($sql_select);
	$stmt->bind_param("i",$_GET["id"]);
	$stmt->execute();
	$stmt->bind_result($aid,$aaccount,$aname,$asex,$abirthday,$amail,$anote);
	$stmt->fetch();
	
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
<title>更新資料</title>
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
	<div class="container">
		<div>
	<h1 class="text-center">更新資料</h1>
		
			
			<form action="update.php" method="post">

			<p>
					<label class="form-label" for="aAccount">帳號</label>
					<input class="form-control" name="aAccount" type="text" required="required" id="aName" value="<?php echo $aaccount; ?>"></input>
				</p>
				<p>
					<label class="form-label" for="aName">姓名</label>
					<input class="form-control" name="aName" type="text" required="required" id="aName" value="<?php echo $aname; ?>"></input>
				</p>
				<p>
			<label class="form-label">性別</label>
				<input class="form-check-input" name="aSex" type="radio" id="aSexM"  value="1" value="1" <?php if ($asex=="1"){ echo "checked='checked'";} ?>></input>
				<label class="form-check-label" for="aSex">男</label>
				
				<input class="form-check-input" name="aSex" type="radio" id="aSexF"  value="0" value="0" <?php if ($asex=="0"){ echo "checked='checked'";} ?>>
				<label class="form-check-label" for="aSex">女</label>
					</p>
				<p>
					<label class="form-label" for="aBirthday">生日</label>
					<input class="form-control" type="date" name="aBirthday"
						   id="aBirthday" value="<?php echo $abirthday; ?>">
				</p>
				<p>
				<label class="form-label" for="aMail">信箱</label>
					<input class="form-control" type="email" name="aMail" id="aMail" value="<?php echo $amail; ?>">
				</p>

				<p>
				<label class="form-label" for="cAddr">備註</label>
					<input class="form-control" type="text" name="aNote" id="aNote" value="<?php echo $anote; ?>">
				</p>
				
				<p>
<!--					提供更新查詢的cid key-->
					<input name="cID" type="hidden" value="<?php echo $aid; ?>">
					<input name="action" type="hidden" value="update">
					<input class="btn btn-primary" type="submit" name="submit" id="submit" value="更新資料" onclick="return confirm('是否確認更新這筆資料');">
					<input class="btn btn-warning" type="button" name="back" id="back" value="回上一頁" onclick="history.back()">
				</p>
			</form>
				</div>
		
		</div>
<body>
</body>
</html>
<?php 
$stmt->close();
$db_link->close();
?>