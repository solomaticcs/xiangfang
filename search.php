<?php @session_start();
include('indb.php');
$idc = $_SESSION['idc'];
$page=isset($_GET['page'])?intval($_GET['page']):1;
$search_count = $_SESSION["search_count"]; //搜尋到的數量
$total = $search_count; 
$pagesize=2; //每頁幾排
$num=4; //每排幾個
$pageall = $pagesize * $num;
$sum=0; //初始設0
$pagenum=ceil($total/($pageall)); //共有幾頁
$offset=($page-1)*$pageall;

//接收來自proc.php的Session
$search_product_type2 = $_SESSION['search_product_type2'];
$search_product_pmodel2 = $_SESSION['search_product_pmodel2'];
$search_product_weight_s2 = $_SESSION['search_product_weight_s2'];
$search_product_weight_b2 = $_SESSION['search_product_weight_b2'];
$search_product_price_s2 = $_SESSION['search_product_price_s2'];
$search_product_price_b2 = $_SESSION['search_product_price_b2'];

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
						echo '● <a href="product.php">產品資訊</a> > 進階搜尋';
						echo '</td><td align="right">';
						echo '<a href="search.php"><img src="_images/magniferlogo.png" width="20" height="20"/>進階搜尋</a><a href="cart.php"><img src="_images/cartlogo.png" width="20" height="20"/>購物車</a></td></tr></table>';
						echo '<center><font size="+3">進階搜尋</font><center><br/>';
						echo '<table class="search_table">';
						echo '<form method="POST" action="proc.php">';
						echo '<tr>';
						echo '<td>';
						echo '類別：';
						echo '</td>';
						echo '<td>';
						echo '<select name="search_product_type">';
						echo '<option value="%">全部</option>';
						//搜尋產品類別
						$seltype1 = "select tname from product_type;";
						$seltype2 = $db->db_query($seltype1);
						while($seltype3 = $db->db_fetch($seltype2))
						{
							echo "<option value=\"$seltype3[0]\">$seltype3[0]</option>";
						}
						echo '</select>';
						echo '</td>';
						echo '<tr>';
						echo '<td>';
						echo '型號：';
						echo '</td>';
						echo '<td>';
						echo '<input type="text" name="search_product_pmodel">';
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td>';
						echo '重量：';
						echo '</td>';
						echo '<td>';
						echo '<input type="text" name="search_product_weight_s" size="2">';
						echo '到';
						echo '<input type="text" name="search_product_weight_b" size="2">';
						echo '公斤';		
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td>';
						echo '價格：';
						echo '</td>';
						echo '<td>';
						echo '<input type="text" name="search_product_price_s" size="2">';
						echo '到';
						echo '<input type="text" name="search_product_price_b" size="2">';
						echo '元';		
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td align="right" colspan="2">';
						echo '<input type="submit" value="送出">';
						echo '<input type="hidden" name="type" value="4" />';
						echo '</td>';
						echo '</tr>';
						echo '</form>';
						echo '</table>';
						$havenot=0; //是否有搜尋產品在session
						$select_cart_4 = "select * from product;";
						$select_cart_5 = $db->db_query($select_cart_4);
						while($select_cart_6 = $db->db_fetch($select_cart_5))
						{
							$producthavenot = $_SESSION["search1_$select_cart_6[0]"];
							if($producthavenot != null)
							{
								$havenot=$havenot+1;
							}
						}
						if($havenot == 0)
						{
							echo '<font color="red">請搜尋商品</font>';
						}
						else
						{
							echo '<center>';
							echo '第 ';
							for($i=1;$i<=$pagenum;$i++)
							{   
								$show=($i!=$page)?"<a href='?page=".$i."'>$i</a>":"<b>$i</b>";
								echo $show." ";
							}
							echo '頁';
							echo '</center><br/>';
							echo '<table class="search_table">';
							echo '<tr>';
							$select_cart_1 = "select product.pid,product.tid,product.pmodel,product.price,product.imgurl,product.click from product,product_type
				where product.tid=product_type.tid
				and product_type.tname like '%$search_product_type2%' and product.pmodel like '%$search_product_pmodel2%'
				and product.weight >= $search_product_weight_s2 and product.weight <= $search_product_weight_b2
				and product.price >= $search_product_price_s2 and product.price <= $search_product_price_b2
				order by pid asc limit $pageall offset $offset;";
							$select_cart_2 = $db->db_query($select_cart_1);
							while($select_cart_3 = $db->db_fetch($select_cart_2))
							{
								$product_pid = $_SESSION["search1_$select_cart_3[0]"];
								$product_pmodel = $_SESSION["search2_$select_cart_3[0]"];
								$product_imgurl = $_SESSION["search3_$select_cart_3[0]"];
								$product_tid = $_SESSION["search4_$select_cart_3[0]"];
								if($_SESSION["search1_$select_cart_3[0]"] != null)
								{
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
											echo "<a href=\"product_info.php?tid=$select_cart_3[1]&pid=$select_cart_3[0]\"><img src=\"_images/$select_cart_3[4]\" width=\"200\" height=\"200\"/></a>";
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td class="sname">';
											echo '型號：'.$select_cart_3[2];
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td class="sname">';
											echo '價格：'.$select_cart_3[3];
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td class="record">';
											echo '<font size="1">瀏覽人數：'.$select_cart_3[5].'</font>';
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
											echo "<a href=\"product_info.php?tid=$select_cart_3[1]&pid=$select_cart_3[0]\"><img src=\"_images/$select_cart_3[4]\" width=\"200\" height=\"200\"/></a>";
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td class="sname">';
											echo '型號：'.$select_cart_3[2];
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td class="sname">';
											echo '價格：'.$select_cart_3[3];
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td class="record">';
											echo '<font size="1">瀏覽人數：'.$select_cart_3[5].'</font>';
											echo '</td>';
										echo '</tr>';
										echo '</table>';
										echo '</td>';
										echo '</tr>';
										echo '<tr>';
									}
								}
							}
							echo '</tr>';
							echo '</table>';
							echo '<br/>';
							echo '<center>';
							echo '第 ';
							for($i=1;$i<=$pagenum;$i++)
							{   
								$show=($i!=$page)?"<a href='?page=".$i."'>$i</a>":"<b>$i</b>";
								echo $show." ";
							}
							echo '頁';
							echo '</center><br/>';
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