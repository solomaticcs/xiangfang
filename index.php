<?php @session_start();
include('indb.php');
$idc = $_SESSION['idc'];
?>
<!doctype html>
<html dir="ltr" lang="zh-TW">
<head>
<title>★箱坊~化妝箱、美甲箱、美髮箱~</title>
<script type="text/javascript" src="js/p7mobile.js"></script>
<link href="styles/site.css" rel="stylesheet" type="text/css" />
<link href="styles/site-print.css" rel="stylesheet" type="text/css" media="print" />
<!--imageflow效果開始-->
<link href="imageflow/imageflow.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="imageflow/jquery1.4.2.js"></script> 
<script type="text/javascript" src="imageflow/imageflow.js"></script>	
<script type="text/javascript" defer="defer"> 
	domReady(function() {
		var instance1 = new ImageFlow();
		instance1.init({
		ImageFlowID:'minwtImageFlow'              //imageflow的ID名稱
			, startID: 0                          //啟始ID
			, startAnimation: true                //一開始動態效果
			, imageFocusMax: 3                    //顯示張數
			, imageFocusM: 1                      //主圖的顯示比例
			, xStep: 150                          //圖片x軸間距
			, opacity: true                       //透明效果
			, opacityArray: [10,5,3,1]            //透明效果設定10~1
			, buttons: true                       //上下張的按鈕圖示
			, imagesHeight: 0.57                  //圖片高度位置
			, preloadImagesText: '圖片載入中...'  //圖片載入的提示文字
			, reflectionP: 0.3                    //圖片y軸座標
			,onClick: function() {window.open(this.url, '_self');} //連結另開視窗
		});
	});
</script> 
<!--imageflow效果結束-->
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
					echo '<table style="border-spacing:0;border:0px solid #999;box-shadow: 0 0 0px #999;width:100%;"><tr><td>';
					echo '</td><td align="right">';
					echo '<a href="search.php"><img src="_images/magniferlogo.png" width="20" height="20"/>進階搜尋</a><a href="cart.php"><img src="_images/cartlogo.png" width="20" height="20"/>購物車</a></td></tr></table>';
					?>
					<h2>您好～<br />
					歡迎您光臨箱坊<br />
					這裡介紹各式各樣.物超所值的化妝箱.美甲箱.珠寶箱...<br />
					歡迎看看喔^___^</h2>
					<div id="minwtImageFlow" class="imageflow"> 
						<img src="imageflow/2625-1.jpg" longdesc="#"  alt="型號2625-1" title="型號2625" /> 
						<img src="imageflow/2625-2.jpg" longdesc="#"  alt="型號2625-2" title="型號2625" /> 
						<img src="imageflow/2625-3.jpg" longdesc="#"  alt="型號2625-3" title="型號2625" /> 
						<img src="imageflow/2625-4.jpg" longdesc="#"  alt="型號2625-4" title="型號2625" /> 
						<img src="imageflow/2625-5.jpg" longdesc="#"  alt="型號2625-5" title="型號2625" /> 
						<img src="imageflow/2625-6.jpg" longdesc="#"  alt="型號2625-6" title="型號2625" />
						<img src="imageflow/2892-1.jpg" longdesc="#"  alt="型號2892-1" title="型號2892" />
						<img src="imageflow/2892-2.jpg" longdesc="#"  alt="型號2892-2" title="型號2892" />  
						<img src="imageflow/2892-3.jpg" longdesc="#"  alt="型號2892-3" title="型號2892" /> 
						<img src="imageflow/2892-4.jpg" longdesc="#"  alt="型號2892-4" title="型號2892" />
						<img src="imageflow/2892-5.jpg" longdesc="#"  alt="型號2892-5" title="型號2892" />
						<img src="imageflow/2892-6.jpg" longdesc="#"  alt="型號2892-6" title="型號2892" />
						<img src="imageflow/2894-1.jpg" longdesc="#"  alt="型號2894-1" title="型號2894" />
						<img src="imageflow/2894-2.jpg" longdesc="#"  alt="型號2894-2" title="型號2894" />
						<img src="imageflow/2894-3.jpg" longdesc="#"  alt="型號2894-3" title="型號2894" />
						<img src="imageflow/9001-1.jpg" longdesc="#"  alt="型號9001-1" title="型號9001" />
						<img src="imageflow/9001-2.jpg" longdesc="#"  alt="型號9001-2" title="型號9001" />
						<img src="imageflow/9006-1.jpg" longdesc="#"  alt="型號9006-1" title="型號9006" />
						<img src="imageflow/9006-2.jpg" longdesc="#"  alt="型號9006-2" title="型號9006" />
						<img src="imageflow/9006-3.jpg" longdesc="#"  alt="型號9006-3" title="型號9006" />
						<img src="imageflow/9006-4.jpg" longdesc="#"  alt="型號9006-4" title="型號9006" />
						<img src="imageflow/9008-1.jpg" longdesc="#"  alt="型號9008-1" title="型號9008" />
						<img src="imageflow/9008-2.jpg" longdesc="#"  alt="型號9008-2" title="型號9008" />
						<img src="imageflow/9008-3.jpg" longdesc="#"  alt="型號9008-3" title="型號9008" />
						<img src="imageflow/9013-1.jpg" longdesc="#"  alt="型號9013-1" title="型號9013" />
						<img src="imageflow/9013-2.jpg" longdesc="#"  alt="型號9013-2" title="型號9013" />
						<img src="imageflow/9013-3.jpg" longdesc="#"  alt="型號9013-3" title="型號9013" />
						<img src="imageflow/9013-4.jpg" longdesc="#"  alt="型號9013-4" title="型號9013" />
						<img src="imageflow/9013-5.jpg" longdesc="#"  alt="型號9013-5" title="型號9013" />
						<img src="imageflow/9013-6.jpg" longdesc="#"  alt="型號9013-6" title="型號9013" />
						<img src="imageflow/9013-7.jpg" longdesc="#"  alt="型號9013-7" title="型號9013" />
						<img src="imageflow/9016-1.jpg" longdesc="#"  alt="型號9016-1" title="型號9016" />
						<img src="imageflow/9016-2.jpg" longdesc="#"  alt="型號9016-2" title="型號9016" />
						<img src="imageflow/9016-3.jpg" longdesc="#"  alt="型號9016-3" title="型號9016" />
						<img src="imageflow/9016-4.jpg" longdesc="#"  alt="型號9016-4" title="型號9016" />
						<img src="imageflow/9016-5.jpg" longdesc="#"  alt="型號9016-5" title="型號9016" />
					</div>
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