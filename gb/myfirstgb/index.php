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
				@$nowtime = date("D-F-d H:i:s");
				$idc = $_SESSION['idc'];
				$user1 = "select * from member where level = '0' and id = '$idc'";
				$user2 = pg_query($user1);
				$user3 = pg_fetch_row($user2);
				$admin1 = "select * from member where level = '1' and id = '$idc'";
				$admin2 = pg_query($admin1);
				$admin3 = pg_fetch_row($admin2);
				//ud 搜尋發文(reply)中名字(id)欄位=登入中帳號
				$ud1 = "select * from reply where id = '$idc'";
				$ud2 = pg_query($ud1);
				$ud3 = pg_fetch_row($ud2);
				//udd 搜尋回覆(reply2)中名字(id)欄位=登入中帳號
				$udd1 = "select * from reply2 where id = '$idc'";
				$udd2 = pg_query($udd1);
				$udd3 = pg_fetch_row($udd2);
				$page=isset($_GET['page'])?intval($_GET['page']):1;
				$num=5;
				$total1 = "select count(*) from reply";
				$total2 = pg_query($total1);
				$total3 = pg_fetch_row($total2);
				$pagenum=ceil($total3[0]/$num);
				if($page>$pagenum || $page == 0)
				{
				   echo "Error : Can Not Found The page .";
				   exit;
				}
				$offset=($page-1)*$num;
				echo '<form name="form1" method="GET" action="process.php">';
				echo '<table name="table1" align="center" class="gb_table">';
				echo '<tr>';
				echo '<td>';
				echo '留言人：<input type="text" name="name" />';
				echo '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>';
					echo "留言時間：$nowtime";
				echo '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td colspan="2" align="center">';
					echo '訊息';
				echo '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td colspan="2" align="center">';
					echo '<textarea name="message_c" cols="55" rows="20" class="gb_textarea"></textarea>';
				echo '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td colspan="2" align="center">';
					echo '<input type="submit" value="送出" />';
				echo '</td>';
				echo '</tr>';
				echo '</table>';	
				echo "<input type=\"hidden\" name=\"time\" value=\"$nowtime\" />";
				echo '<input type="hidden" name="a1" value="1">';
				echo '</form>';
				$select1 = "select * from reply order by no desc limit $num offset $offset";
				$select2 = pg_query($select1);
				while($select3 = pg_fetch_row($select2))
				{
					if($select3[0] != 0)
					{
						echo '<table name="table1" align="center" width="50%" class="gb_table">';
						echo '<tr>';
						echo '<td>';
							echo "留言人：$select3[1]";
							echo "<a href=\"recon.php?no=$select3[0]\">【回覆此人】</a><br />";
							if($_SESSION['idc'] != null && $_SESSION['idc'] == $admin3[2])
							{
								echo "<form name=\"form2\" method=\"GET\" action=\"process.php\">";
								echo "<input type=\"hidden\" name=\"delful\" value=\"$select3[0]\" />";
								echo "<input type=\"hidden\" name=\"a1\" value=\"8\" />";
								echo "<input type=\"submit\" value=\"刪除\" style=\"background-color:white;\"/>";
								echo "</form>";
							}
						echo '</td>';
							echo '<td>';
							echo "留言時間：$select3[4]<br/>";
						echo '</td>';
						echo '<tr>';
						echo '<td width="300" height="200" valign="top" colspan="2">';
							echo "留言內容：$select3[3]<br/>";
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td colspan="2">';
							$showgood1 = "select count(*) from good where no2 = '$select3[0]'";
							$showgood2 = pg_query($showgood1);
							$showgood3 = pg_fetch_row($showgood2);
							echo 'GP';	echo $showgood3[0];
							echo "<form name=\"form2\" method=\"GET\" action=\"process.php\">";
							echo "<input type=\"hidden\" name=\"good\" value=\"$select3[0]\" />";
							if($_SESSION['idc'] == $admin3[2])
							{
								echo "<input type=\"hidden\" name=\"name\" value=\"$admin3[1]\" />";
							}
							elseif($_SESSION['idc'] == $user3[2])
							{
								echo "<input type=\"hidden\" name=\"name\" value=\"$user3[1]\" />";
							}
							echo "<input type=\"hidden\" name=\"time\" value=\"$nowtime\" />";
							echo "<input type=\"hidden\" name=\"a1\" value=\"12\" />";
							echo "<input type=\"submit\" value=\"讚\" style=\"background-color:white;\"/>";
							echo "</form>";
							$showgood4 = "select * from good where no2 = '$select3[0]'";
							$showgood5 = pg_query($showgood4);
							while($showgood6 = pg_fetch_row($showgood5))
							{
								echo "$showgood6[2]($showgood6[3])按過讚！";
								echo '<br/>';
							}
						echo '</td>';
						echo '</tr>';
						if($_SESSION['idc'] != null && $_SESSION['idc'] == $admin3[2])
						{
							echo '<tr>';
							echo '<td colspan="2" bgcolor="#EBFFFF">';
								echo "<center><a href=\"update.php?no=$select3[0]\">修改留言</a></center>";
							echo '</td>';
							echo '</tr>';
						}
						$select4 = "select * from reply2 where no2 = $select3[0]";
						$select5 = pg_query($select4);
						while($select6 = pg_fetch_row($select5))
						{
							echo '<tr>';
							echo '<td bgcolor="#AFFEFF" colspan="2">';
							echo $select6[2];
							echo "($select6[3])";
							echo '說：';
							echo "$select6[4]";
							if($_SESSION['idc'] != null && $_SESSION['idc'] == $admin3[2])
							{
								echo "<form name=\"form2\" method=\"GET\" action=\"process.php\">";
								echo "<input type=\"hidden\" name=\"del\" value=\"$select6[0]\" />";
								echo "<input type=\"hidden\" name=\"a1\" value=\"5\" />";
								echo "<input type=\"submit\" value=\"刪除\" style=\"background-color:white;\"/>";
								echo "</form>";
							}
							echo '</td>';
							echo '</tr>';
						}
						echo '</table>';
						echo '<br />';
					}
				}
				echo '<center>';
				for($i=1;$i<=$pagenum;$i++)
				{   
				   $show=($i!=$page)?"<a href='?page=".$i."'>$i</a>":"<b>$i</b>";
				   echo $show." ";
				}
				echo '</center>';
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