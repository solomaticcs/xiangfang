
/* 
 ================================================
 PVII Mobile scripts
 Copyright (c) 2011 Project Seven Development
 www.projectseven.com
 Version: 1.0.1 -build 3
 ================================================
 
	To exclude a device from the mobile detector:

	Enter comma separated list of strings to exclude from mobile filter (in all lower case)
	The exclusion string must appear in the device's UserAgent string
 
	Example, to exclude iPad & Android tablet:
  
	var p7MBLexclude=['ipad','android 3'];
  
*/

var p7MBLexclude=[];

var p7MBLi=false,p7MBLa=false,p7MBLmobile=false;
function P7_MBLaddLoad(){
	if(!document.getElementById||typeof document.createElement=='undefined'){
		return;
	}
	if(window.addEventListener){
		document.addEventListener("DOMContentLoaded",P7_initMBL,false);
	}
	else if(window.attachEvent){
		document.write("<script id=p7ie_MBL defer src=\"//:\"><\/script>");
		document.getElementById("p7ie_MBL").onreadystatechange=function(){
			if (this.readyState=="complete"){
				P7_initMBL();
			}
		};
	}
}
P7_MBLaddLoad();
function P7_initMBL(){
	var mb;
	if(p7MBLi){
		return;
	}
	p7MBLi=true;
	mb=P7_MBLisMobile();
	if(mb){
		P7_MBLsetClass(document.getElementsByTagName('BODY')[0],'p7mobile');
		p7MBLmobile=true;
	}
	else{
		P7_MBLsetClass(document.getElementsByTagName('BODY')[0],'p7desktop');
	}
}
function P7_MBLsetClass(ob,cl){
	if(ob){
		var cc,nc,r=/\s+/g;
		cc=ob.className;
		nc=cl;
		if(cc&&cc.length>0){
			if(cc.indexOf(cl)==-1){
				nc=cc+' '+cl;
			}
			else{
				nc=cc;
			}
		}
		nc=nc.replace(r,' ');
		ob.className=nc;
	}
}
function P7_MBLisMobile(){
	var i,m=false,ua=navigator.userAgent.toLowerCase();
	var dv=['iphone','ipad','ipod','android','windows ce','iemobile','windowsce','blackberry','palm','symbian','series60',
	'armv','arm7tdmi','opera mobi','opera mini','polaris','kindle','midp','mmp/','portalmmm','smm-mms','sonyericsson'];
	for(i=0;i<dv.length;i++){
		if(ua.search(dv[i])>-1){
			m=dv[i];
			break;
		}
	}
	if(m&&p7MBLexclude.length){
		for(i=0;i<p7MBLexclude.length;i++){
			if(ua.search(p7MBLexclude[i])>-1){
				m=false;
			}
		}
	}
	return m;
}