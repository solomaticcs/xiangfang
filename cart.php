<?php @session_start();
include('indb.php');
$idc = $_SESSION['idc'];
$t=time();
@$nowtime = date("Y-m-d H:i:s",$t);
?>
<!doctype html>
<html dir="ltr" lang="zh-TW">
<head>
<title>★箱坊~化妝箱、美甲箱、美髮箱~</title>
<script type="text/javascript" src="js/p7mobile.js"></script>
<link href="styles/site.css" rel="stylesheet" type="text/css" />
<link href="styles/site-print.css" rel="stylesheet" type="text/css" media="print" />
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
				<table>
					<td class="my_menuleft">
					<?php
						echo '<br/><font size="3">產品類別</font><br/><br/>';
						$select_cart_type_1 = "select * from product_type order by tid desc;";
						$select_cart_type_2 = $db->db_query($select_cart_type_1);
						while($select_cart_type_3 = $db->db_fetch($select_cart_type_2))
						{
							echo "<a href=\"type.php?tid=$select_cart_type_3[0]\">".$select_cart_type_3[1].'<br/>';
						}
					?>
					</td>
					<td class="my_content">
						<?php
						echo '<table style="border-spacing:0;border:0px solid #999;box-shadow: 0 0 0px #999;width:100%;"><tr><td>';
						echo '● <a href="product.php">產品資訊</a> > 購物車';
						echo '</td><td align="right">';
						echo '<a href="search.php"><img src="_images/magniferlogo.png" width="20" height="20"/>進階搜尋</a><a href="cart.php"><img src="_images/cartlogo.png" width="20" height="20"/>購物車</a></td></tr></table>';
						echo '<center><font size="+3">購物車</font><center><br/>';
						echo '<table class="stable" width="800">';
						echo '<tr style="text-align:center; background-color:yellow;">';
						echo '<td>編號</td><td>類別</td><td>型號</td><td>尺寸</td><td>重量</td><td>價格</td><td>操作</td><td>數量</td><td>執行</td>';
						echo '</tr>';
						//搜尋購物車內有的物品
						$select_cart_1 = "select product.pid,product_type.tid,product_type.tname,product.pmodel,product.size,product.weight,product.price,product.imgurl,product.click from product,product_type where product.tid=product_type.tid order by pid desc;";
						$select_cart_2 = $db->db_query($select_cart_1);
						while($select_cart_3 = $db->db_fetch($select_cart_2))
						{
							$cart_pid = $_SESSION["cart_pid_$select_cart_3[0]"];//Session中的商品編號
							$cart_tid = $_SESSION["cart_tid_$select_cart_3[0]"];//Session中的類別編號
							$cart_tname = $_SESSION["cart_tname_$select_cart_3[0]"];//Session中的種類
							$cart_pmodel = $_SESSION["cart_pmodel_$select_cart_3[0]"];//Session中的型號
							$cart_size = $_SESSION["cart_size_$select_cart_3[0]"];//Session中的尺寸
							$cart_weight = $_SESSION["cart_weight_$select_cart_3[0]"];//Session中的重量
							$cart_price = $_SESSION["cart_price_$select_cart_3[0]"];//Session中的價格
							$cart_imgurl = $_SESSION["cart_imgurl_$select_cart_3[0]"];//Session中的圖片網址
							if($_SESSION["cart_pid_$select_cart_3[0]"] != null)
							{
								echo '<tr>';
									echo '<td>'.$cart_pid.'</td>';
									echo '<td>'.$cart_tname.'</td>';
									echo '<td>'.$cart_pmodel.'</td>';
									echo '<td>'.$cart_size.'cm</td>';
									echo '<td>'.$cart_weight.'kg</td>';
									echo '<td>$'.$cart_price.'元</td>';
									echo '<td style="vertical-align:middle; height:50px;">';
										echo '<form method="POST" action="proc.php">';
										echo '<center><input type="submit" value="刪除" style="height:20px;font-size:12px; width:55px" /></center>';
										echo '<input type="hidden" name="type" value="2" />';
										echo "<input type=\"hidden\" name=\"b2\" value=\"$select_cart_3[0]\" />";
										echo '</form>';
									echo '</td>';
									echo '<form method="POST" action="proc.php">';
									echo '<td><input type="text" name="pidnum" size="2" style="ime-mode:disabled" onkeyup="return ValidateNumber($(this),value)"></td>';
									echo '<td style="vertical-align:middle; height:50px;">';
										echo '<center><input type="submit" value="購買" style="height:20px;font-size:12px; width:55px" /></center>';
										echo '<input type="hidden" name="type" value="3" />';
										echo "<input type=\"hidden\" name=\"product_pid\" value=\"$cart_pid\" />";
										echo "<input type=\"hidden\" name=\"time\" value=\"$nowtime\" />";
									echo '</td>';
									echo '</form>';
								echo '</tr>';
							}
						}
						echo '</table>';
						echo '<br/>';
						?>
					</td>
				</table>
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