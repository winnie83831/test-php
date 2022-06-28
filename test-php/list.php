<?php
include_once("conn.php");
$sql_query = "SELECT * FROM `account_info` ORDER BY `aId` ASC";
//沒有透過表單接收資料,所以沒有使用prepare語法
$result = $db_link->query($sql_query);
$total_records = $result->num_rows;

$per = 5; //每頁顯示項目數量
$pages = ceil($total_records / $per); //取得不小於值的下一個整數
if (!isset($_GET["page"])) { //假如$_GET["page"]未設置
	$page = 1; //則在此設定起始頁數
} else {
	$page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page - 1) * $per; //每一頁開始的資料序號
$result = $db_link->query($sql_query . ' LIMIT ' . $start . ', ' . $per) or die("Error");

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>資料讀取顯示</title>
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
	<script src="JS/bootstrap.min.js"></script>
	<script src="JS/popper.min.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
</head>
<style>
	body {
		font-size: 0.8rem;
	}
</style>

<body>
	<div class="container">
		<div>
			<h1 class="text-center">資料讀取顯示</h1>
			<p class="text-center"><?php echo "資料總比數: {$total_records}"; ?>


				<a class='btn btn-primary btn-sm' href='add.php' onclick="pop_up(this);">新增資料</a>
			</p>

			<table class="table table-hover" width="100%" border="1" cellspacing="5" id="mytable">
				<tbody>
					<!--		表格表頭-->
					<tr id="theader">
						<th scope="col">#</th>
						<th scope="col">序號</th>
						<th scope="col">帳號<a class='btn btn-light btn-sm' onclick="sortTable()">A-Z排序</a></th>
						<th scope="col">姓名</th>
						<th scope="col">性別</th>
						<th scope="col">生日</th>
						<th scope="col">信箱</th>

						<th scope="col">備註</th>

						<th scope="col">編輯</th>
					</tr>
					<!--		資料內容-->
					<?php
					$i = 1;

					while ($row_result = $result->fetch_assoc()) {
						if ($row_result['aSex'] == "1") {
							$row_result['aSex'] = "男";
						} else {
							$row_result['aSex'] = "女";
						}
						echo "<tr>";
						echo "<td>{$i}</td>";
						echo "<td>{$row_result['aId']}</td>";
						echo "<td>{$row_result['aAccount']}</td>";
						echo "<td>{$row_result['aName']}</td>";
						echo "<td>{$row_result['aSex']}</td>";
						echo "<td>{$row_result['aBirthday']}</td>";
						echo "<td>{$row_result['aMail']}</td>";
						echo "<td>{$row_result['aNote']}</td>";

						//			echo"<td><a href='update.php?id={$row_result['cID']}'>修改</a> | <a href='delete.php?id={$row_result['cID']}'>刪除</a></td>";
						echo "<td><a class='btn btn-primary btn-sm' href='update.php?id={$row_result['aId']}'>修改</a> | <a class='btn btn-danger btn-sm' href='delete.php?id={$row_result['aId']}'>刪除</a></td>";
						echo "</tr>";

						$i++;
					}
					?>
					<input type="text"></input>
					<input type="button" value="搜尋"></input>


				</tbody>
			</table>
		</div>

	</div>
	<script type="text/javascript">
		$(function() {
			$("input[type=button]").click(function() {
				var txt = $("input[type=text]").val();
				if ($.trim(txt) != "") {
					$("table tr:not('#theader')").hide().filter(':contains(' + txt + ')').show().css("background", "pink");
				} else {
					$("table tr:not('#theader')").css("background", "#fff").show();
				}
			});
		})


		function pop_up(url) {
			window.open(url, 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no')
		}
		
		function sortTable() {
			var table, rows, switching, i, x, y, shouldSwitch;
			table = document.getElementById("mytable");
			switching = true;
			/* 设置一个循环语句 */
			while (switching) {
				// 设置循环结束标记
				switching = false;
				rows = table.rows;
				/* 循环表格的行 */
				for (i = 1; i < (rows.length - 1); i++) {
					// 设置元素是否调换位置
					shouldSwitch = false;
					/* 获取要比较的元素 */
					x = rows[i].getElementsByTagName("td")[2];
					y = rows[i + 1].getElementsByTagName("td")[2];
					// 判断是否将下一个元素与当前元素进行切换
					if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
						// 设置调换元素标记，并结束当前循环
						shouldSwitch = true;
						break;
					}
				}
				if (shouldSwitch) {
					/* 如果元素调换位置设置为 true，则进行对调操作 */
					rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
					switching = true;
				}
			}
		}
	</script>

	<?php
	//分頁頁碼
	echo '<p class="text-center"> 共 ' . $total_records . ' 筆-第 ' . $page . ' 頁-共 ' . $pages . ' 頁</p>';
	echo "<p class='text-center'><a  href=?page=1>首頁</a> ";
	echo "第 ";
	for ($i = 1; $i <= $pages; $i++) {
		if ($page - 3 < $i && $i < $page + 3) {
			echo "<a href=?page=" . $i . ">" . $i . "</a> ";
		}
	}
	echo " 頁 <a href=?page=" . $pages . ">末頁</a><br /><br /></p>";
	?>
</body>

</html>