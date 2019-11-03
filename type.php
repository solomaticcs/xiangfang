<?php session_start();
include('indb.php');
$idc = $_SESSION['idc'];
$tid = $_REQUEST['tid'];
$tid2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $tid);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$page2 = str_replace(array("\n","\t","\r","<javascript","<LINK","<br />","<br>","<br/>","<b>","<i>","<u>","'"), array("","","","","","","","","","","",""), $page);
//搜尋所有的商品總和
$count_cart_1 = "select * from product,product_type where product.tid=product_type.tid and product_type.tid='$tid2';";
$count_cart_2 = @pg_query($count_cart_1);
$count_cart_3 = @pg_fetch_row($count_cart_2);
$total = $count_cart_3[0]; 
$pagesize=3; //每頁幾排
$num=4; //每排幾個
$pageall = $pagesize * $num;
$sum=0; //初始設0
$pagenum=ceil($total/($pageall)); //共有幾頁
$offset=($page2-1)*$pageall;
if($tid2 != null)
{
	$select_cart_type_tid_1 = "select * from product_type where tid='$tid2';";
	$select_cart_type_tid_2 = pg_query($select_cart_type_tid_1);
	$select_cart_type_tid_3 = pg_fetch_row($select_cart_type_tid_2);
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
					<td class="my_menuleft">
					<?php
						echo '<br/><font size="3">產品類別</font><br/><br/>';
						$select_cart_type_1 = "select * from product_type order by tid desc;";
						$select_cart_type_2 = pg_query($select_cart_type_1);
						while($select_cart_type_3 = pg_fetch_row($select_cart_type_2))
						{
							echo "<a href=\"type.php?tid=$select_cart_type_3[0]\">".$select_cart_type_3[1].'<br/>';
						}
					?>
					</td>
					<td class="my_content">
						<?php
						if($tid2 != null && $tid2 == $select_cart_type_tid_3[0] && $offset >= 0 && $page<=$pagenum)
						{
							echo '<table style="border-spacing:0;border:0px solid #999;box-shadow: 0 0 0px #999;width:100%;"><tr><td>';
							echo '● <a href="product.php">產品資訊</a> > '.$select_cart_type_tid_3[1];
							echo '</td><td align="right">';
							echo '<a href="search.php"><img src="_images/magniferlogo.png" width="20" height="20"/>進階搜尋</a><a href="cart.php"><img src="_images/cartlogo.png" width="20" height="20"/>購物車</a></td></tr></table>';
							echo '<center><font size="+3">'.$select_cart_type_tid_3[1].'</font></center><br/>';
							echo '<center>';
							echo '第 ';
							for($i=1;$i<=$pagenum;$i++)
							{   
								$show=($i!=$page2)?"<a href='?tid=".$tid2."&page=".$i."'>$i</a>":"<b>$i</b>";
								echo $show." ";
							}
							echo '頁';
							echo '</center><br/>';
							echo '<table class="carttable">';
							echo '<tr>';
							//搜尋所有商品中的指定分類（【產品編號】、【類別編號】、【產品型號】、【圖片連結】、【瀏覽次數】）
							$select_cart_type_product_1 = "select * from product,product_type where product.tid=product_type.tid and product_type.tid='$tid2' order by pid desc limit $pageall offset $offset;";
							$select_cart_type_product_2 = pg_query($select_cart_type_product_1);
							while($select_cart_type_product_3 = pg_fetch_row($select_cart_type_product_2))
							{ //列出所有的物品清單
								$sum=$sum+1;
								if($sum > $num)
								{
									$sum=1;
								}
								if($num - $sum != 0)
								{
									echo '<td>';
									echo '<table class="stable">';
									echo '<tr>';
										echo '<td class="img">';
										echo "<a href=\"product_info.php?tid=$select_cart_type_product_3[1]&pid=$select_cart_type_product_3[0]\"><img src=\"_images/$select_cart_type_product_3[6]\" width=\"200\" height=\"200\"/></a>";
										echo '</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="sname">';
										echo '型號：'.$select_cart_type_product_3[2];
										echo '</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="sname">';
										echo '價格：'.$select_cart_type_product_3[5];
										echo '</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="record">';
										echo '<font size="1">瀏覽人數：'.$select_cart_type_product_3[7].'</font>';
										echo '</td>';
									echo '</tr>';
									echo '</table>';
									echo '</td>';
								}
								else if($num - $sum == 0)
								{
									echo '<td>';
									echo '<table class="stable">';
									echo '<tr>';
										echo '<td class="img">';
										echo "<a href=\"product_info.php?tid=$select_cart_type_product_3[1]&pid=$select_cart_type_product_3[0]\"><img src=\"_images/$select_cart_type_product_3[6]\" width=\"200\" height=\"200\"/></a>";
										echo '</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="sname">';
										echo '型號：'.$select_cart_type_product_3[2];
										echo '</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="sname">';
										echo '價格：'.$select_cart_type_product_3[5];
										echo '</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td class="record">';
										echo '<font size="1">瀏覽人數：'.$select_cart_type_product_3[7].'</font>';
										echo '</td>';
									echo '</tr>';
									echo '</table>';
									echo '</td>';
									echo '</tr>';
									echo '<tr>';
								}
							}
							echo '</tr>';
							echo '</table>';
							echo '<br/>';
							echo '<center>';
							echo '第 ';
							for($i=1;$i<=$pagenum;$i++)
							{   
								$show=($i!=$page2)?"<a href='?tid=".$tid2."&page=".$i."'>$i</a>":"<b>$i</b>";
								echo $show." ";
							}
							echo '頁';
							echo '</center><br/>';
						}
						else
						{
							echo '<center><font color="red">錯誤頁面！</font></center>';
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