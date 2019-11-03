<!doctype html>
<html dir="ltr" lang="zh-TW">
<head>
<title>★箱坊~化妝箱、美甲箱、美髮箱~</title>
<script type="text/javascript" src="js/p7mobile.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="../../styles/site.css" rel="stylesheet" type="text/css" />
<link href="../../styles/site-print.css" rel="stylesheet" type="text/css" media="print" />
</head>
<body>
<div class="content-wrapper">
	<div class="masthead">
		<div class="banner">
		</div>
	</div>
	<div class="menutop-wrapper">
		<ul class="menutop">
			<?php require('menu.html'); ?>
		</ul>
	</div>
	<div class="columns-wrapper">
		<div class="main-content">
			<div class="content">
				<?php
				session_start();
				include('indb.php');
				$no = $_REQUEST['no'];
				@$nowtime = date("D-F-d H:i:s");
				$idc = $_SESSION['idc'];
				$user1 = "select * from member where level = '0' and id = '$idc'";
				$user2 = pg_query($user1);
				$user3 = pg_fetch_row($user2);
				$admin1 = "select * from member where level = '1' and id = '$idc'";
				$admin2 = pg_query($admin1);
				$admin3 = pg_fetch_row($admin2);
				echo '<a href="logout.php">登出</a>';
				echo '　　';
				echo '<a href="index.php">回上頁</a>';
				//列出要回覆的該留言
				$select1 = "select * from reply where no='$no'";
				$select2 = pg_query($select1);
				$select3 = pg_fetch_row($select2);
				echo '<table name="table1" border="1" align="center" class="gb_table">';
				echo '<tr>';
				echo '<td colspan="2">';
					echo "留言人：$select3[1]($select3[2])";
				echo '</td>';
				echo '<tr>';
				echo '<td width="300" height="200" valign="top">';
					echo "留言內容：$select3[3]<br/>";
				echo '</td>';
				echo '<td>';
					echo "留言時間：$select3[4]<br/>";
				echo '</td>';
					$select4 = "select * from reply2 where no2 = $select3[0]";
					$select5 = pg_query($select4);
					while($select6 = pg_fetch_row($select5))
						{
							echo '<tr>';
							echo '<td bgcolor="#AFFEFF" colspan="2">';
							echo "$select6[2]";
							echo '說：';
							echo "$select6[3]";
							echo '</td>';
							echo '</tr>';
						}
				echo '</table>';
				//找詢回覆no
				$select1 = "select * from reply where no =$no";
				$select2 = pg_query($select1);
				$select3 = pg_fetch_row($select2);

				echo '<form name="form1" method="GET" action="process.php">';
				echo '<table name="table1" border="0" align="center">';
					echo '<tr>';
					echo '<td>';
						echo '回覆人：<input type="text" name="name" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>';
						echo "回覆：$select3[1]($select3[2])";
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>';
						echo "回覆時間：$nowtime";	
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>';
						echo '回覆訊息';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>';
						echo '<textarea name="message_c" rows="10" cols="55" class="gb_textarea"></textarea>';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>';
						echo '<input type="submit" value="送出" />';
					echo '</td>';
					echo '</tr>';
				echo '</table>';
					echo "<input type=\"hidden\" name=\"time\" value=\"$nowtime\" />";
					echo '<input type="hidden" name="a1" value="2">';
					echo "<input type=\"hidden\" name=\"no\" value=\"$select3[0]\" />";
				echo '</form>';
				?>
			</div>
		</div>
	<div class="footer">
    <table width="100%">
	<tr>
		<td width="25%">
		</td>
		<td width="50%">
			最佳瀏覽解析度為1280*1024<br />
			GoogleChrome, FireFox, or IE6以上版本<br />
			台南市永康區　0931-198917蔡小姐<br />
			☆(星期一～星期五  10：00～21：00)<br />
			箱坊 版權所有 2012 Taiwan All Rights Reserved.<br/>
		</td>
		<td width="25%">
			<br/><br/><br/>
			<div align="right"><script src="http://www.dreamhome.com.tw/escounter/counter.asp?name=a4679123&dir=1"></script></div>
		</td>
	</tr>
	</table>
	</div>
	</div>
</div>
</body>
</html>