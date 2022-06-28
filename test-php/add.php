<?php
//判斷是否有傳送新增資料
if( isset($_POST["action"]) && $_POST["action"]=="add" ){
//	echo "有Action";

//有資料就做插入動作, 為資料是外部提送 基於安全考量採用prepare方式
include_once("conn.php");
$sql_query = "INSERT INTO `account_info` (`aAccount`, `aName`, `aSex`, `aBirthday`, `aMail`, `aNote`) VALUES (?,?,?,?,?,?)";
$stmt = $db_link->prepare($sql_query);
//	兩個整數兩個i
$stmt-> bind_param("ssssss",$_POST["aAccount"],$_POST["aName"],$_POST["aSex"],$_POST["aBirthday"],$_POST["aMail"],$_POST["aNote"]);
$stmt->execute();
$stmt->close();
$db_link->close();
//完成後 將頁面導回data.php
	header("location:list.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>新增資料</title>
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
	<h1 class="text-center">新增資料</h1>
		
			
			<form action="add.php" method="post">
			<p>
					<label class="form-label" for="aAccount">帳號</label>
					<input class="form-control" name="aAccount" type="text" required="required" id="aAccount">
				</p>
				<p>
					<label class="form-label" for="aName">姓名</label>
					<input class="form-control" name="aName" type="text" required="required" id="aName">
				</p>
				<p>
			<label class="form-label">性別</label>
				<input class="form-check-input" name="aSex" type="radio" id="aSex"  value="1" checked="checked">
				<label class="form-check-label" for="aSex">男</label>
				
				<input class="form-check-input" name="aSex" type="radio" id="aSex"  value="0">
				<label class="form-check-label" for="aSex">女</label>
					</p>
				<p>
					<label class="form-label" for="aBirthday">生日</label>
					<input class="form-control" type="date" name="aBirthday"  id="aBirthday" required="required">
				</p>
				<p>
				<label class="form-label" for="aMail">信箱</label>
					<input class="form-control" type="email" name="aMail" id="aMail" required="required">
				</p>
				
				<p>
				<label class="form-label" for="aNote">備註</label>
					<input class="form-control" type="text" name="aNote" id="aNote">
				</p>
				
				<p>
					<input name="action" type="hidden" value="add">
					<input class="btn btn-primary" type="submit" name="submit" id="submit" value="送出" onclick="return confirm('是否確認新增這筆資料');">
					<input class="btn btn-warning" type="reset" name="reset" id="reset" value="重設">
				</p>
			</form>
				</div>
		
		</div>
<body>
</body>
</html>