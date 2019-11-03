<?php @session_start();
include('indb.php');
$idc = $_SESSION['idc'];
$pid = $_REQUEST['pid'];
$pid2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $pid);
$tid = $_REQUEST['tid'];
$tid2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $tid);
//搜尋所有的商品總和
$count_cart_1 = "select count(*) from product;";
$count_cart_2 = $db->db_query($count_cart_1);
$count_cart_3 = $db->db_fetch($count_cart_2);
$num=4; //每排幾個
$sum=0; //初始設0
if($pid2 != null && $tid2 != null)
{
	//搜尋所有商品中的指定商品
	$select_cart_product_1 = "select product.pid,product_type.tid,product_type.tname,product.pmodel,product.size,product.weight,product.price,product.imgurl,product.click from product,product_type where product.tid=product_type.tid and product.pid='$pid2';";
	$select_cart_product_2 = $db->db_query($select_cart_product_1);
	$select_cart_product_3 = $db->db_fetch($select_cart_product_2);
	//更新瀏覽次數
	$update_product_record_click_1 = "update product set click=(select click from product where pid='$pid2')+1 where pid='$pid2';";
	$update_product_record_click_2 = $db->db_query($update_product_record_click_1);
}
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
				<td class="my_fullcontent">
				<?php
				if($pid2 != null && $tid2 != null && $pid2 == $select_cart_product_3[0] && $tid2 == $select_cart_product_3[1])
				{
				echo '<table style="border-spacing:0;border:0px solid #999;box-shadow: 0 0 0px #999;width:100%;"><tr><td>';
				echo '● <a href="product.php">產品資訊</a> > <a href="type.php?tid='.$select_cart_product_3[1].'">'.$select_cart_product_3[2].'</a> > '.$select_cart_product_3[3];
				echo '</td><td align="right">';
				echo '<a href="search.php"><img src="_images/magniferlogo.png" width="20" height="20"/>進階搜尋</a><a href="cart.php"><img src="_images/cartlogo.png" width="20" height="20"/>購物車</a></td></tr></table>';
				echo '<center><font size="+3">'.$select_cart_product_3[3].'</font></center><br/>';
				echo '<br />';
				echo '<table class="product_table">';
				echo '<tr>';
					echo '<td class="product_img" align="right">';
					echo "<div id=\"photoeffect\"><br /><img src=\"_images/$select_cart_product_3[7]\" width=\"200\" height=\"200\"/></div>";
					echo '</td>';
					echo '<td class="product_information">類別：'.$select_cart_product_3[2].'<br/>';
					echo '型號：'.$select_cart_product_3[3].'<br/>';
					echo '尺寸：'.$select_cart_product_3[4].'cm<br/>';
					echo '重量：'.$select_cart_product_3[5].'kg<br/>';
					echo '價格：$'.$select_cart_product_3[6].'元<br/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="2">';
						echo '<br/><br/>';
						echo '<b>詳細介紹</b><br/><hr/>';
						echo '<div align="right">';
						echo '<form method="POST" action="proc.php">';
						echo '<input type="submit" value="加入購物車">';
						echo '<input type="hidden" name="type" value="1">';
						echo "<input type=\"hidden\" name=\"b1\" value=\"$pid2\">";
						echo "<input type=\"hidden\" name=\"b11\" value=\"$tid2\">";
						echo '</form>';
						echo '</div>';
						echo '<table class="scoretable" align="right">';
						echo '<tr>';
						echo '<td>';
							echo '瀏覽次數：'.$select_cart_product_3[8];
						echo '</td>';
						echo '</tr>';
						echo '</table>';
					echo '</td>';
				echo '</tr>';
				echo '</table>';
				echo '<br/>';
				}
				else
				{
					echo '<center><font color="red">錯誤頁面！</font></center><br/>';
				}
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