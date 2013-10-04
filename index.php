<?//$db=new PDO('mysql:dbname=itfa;host=localhost','folkos.com','5F4DCC3B5AA765D61D8327DEB882CF99');?>
<html>
	<head>
		<title>Web Topology Editor</title>
		<link rel="stylesheet" type="text/css" href="index.css">
		<script src="/core/elemlib.js"></script>
		<script src="/core/crossbrowse.js"></script>
		<script src="/core/node_pro.js"></script>
		<script src="/itfa/script.js"></script>
	</head>
	<body>
		<script>
			var mouse={};
			setX=function(x){mouse.taken.style.left=x+'px'}
			setY=function(y){mouse.taken.style.top=y+'px'}
			function createtoolbar(params){
				var retobj={};
				var toolform=retobj.form=$n('div',document.body,{className:'toolform'});
				var tab=$n('div',toolform,{className:'tab'});
				var labelnode=$n('b',tab);
				var tr=$n('div',toolform,{className:'taber'});
				$n('div',tr,{className:'in'});
				var toolarea=retobj.area=$n('div',toolform,{className:'toolarea'});
				var closer=$n('sup',tab,{innerHTML:'X'});
				var minimizer=$n('sub',tab,{innerHTML:'_'});
				retobj.label=labelnode.innerHTML;
				retobj.setlabel=function(text){labelnode.innerHTML=text;}
				if(params){
					if(params.label) labelnode.innerHTML=params.label;
					if(params.x) toolform.style.left=params.x+'px';
					if(params.y) toolform.style.top=params.y+'px';
					if(params.h) toolform.style.height=params.h+'px';
					if(params.w) toolform.style.width=params.w+'px';
				}
				Event.add(closer,'click',function(){toolform.parentNode.removeChild(toolform)});
				Event.add(toolform,'mousedown',function(event){mouse={down:true,taken:toolform,startX:event.pageX,startY:event.pageY,wasX:toolform.offsetLeft,wasY:toolform.offsetTop}});
				Event.add(toolarea,'mousedown',function(){return false});
				Event.add(document.body,'mouseup',function(){mouse={}});
				return retobj;
			}
			
			var lsd=$n('div',document.body,{id:'leftside'});
			var cnt=$n('div',document.body,{id:'center'});
			var rsd=$n('div',document.body,{id:'rightside'});
			
			var dev1=$n('div',document.body,{className:'device',innerHTML:'TestDevice 1'});
			Event.add(dev1,'mousedown',function(event){mouse={down:true,taken:this,startX:event.pageX,startY:event.pageY,wasX:this.offsetLeft,wasY:this.offsetTop}});
			var dev2=$n('div',document.body,{className:'device',innerHTML:'TestDevice 2'});
			Event.add(dev2,'mousedown',function(event){mouse={down:true,taken:this,startX:event.pageX,startY:event.pageY,wasX:this.offsetLeft,wasY:this.offsetTop}});
			
			dev1p1=$n('div',dev1,{className:'linepoint'});
			dev2p1=$n('div',dev2,{className:'linepoint'});
			
			var hor,ver,ver2;
			
			function makeline(point1,point2){
				if(hor) $d(hor);
				if(ver) $d(ver);
				if(ver2) $d(ver2);
				hor=$n('div',document.body,{className:'line hor'});
				ver=$n('div',document.body,{className:'line hor'});
				ver2=$n('div',document.body,{className:'line ver'});
				point1[0]=parseInt(point1[0]);
				point1[1]=parseInt(point1[1]);
				point2[0]=parseInt(point2[0]);
				point2[1]=parseInt(point2[1]);
				var x1=Math.min(point1[0],point2[0]);
				var x2=Math.max(point1[0],point2[0]);
				var y1=Math.min(point1[1],point2[1]);
				var y2=Math.max(point1[1],point2[1]);
				hor.style.top=Math.round((y1+y2)/2)+'px';
				hor.style.left=x1+'px';
				hor.style.width=x2-x1+'px';
				ver.style.left=point1[0]+'px';
				ver2.style.left=point2[0]+'px';
				ver.style.height=ver2.style.height=Math.round((y2-y1)/2)+'px';
				if(point1[1]>point2[1]){
					ver.style.top=hor.style.top;
					ver2.style.top=y1+'px';
				}else{
					ver.style.top=y1+'px';
					ver2.style.top=hor.style.top;
				}
			}
			Event.add(document.body,'mousemove',function(event){
				if(!mouse.down) return true;
				setX(event.pageX-mouse.startX+mouse.wasX);
				setY(event.pageY-mouse.startY+mouse.wasY);
				var br1=dev1p1.getBoundingClientRect();
				var br2=dev2p1.getBoundingClientRect();
				makeline([br1.left,br1.top],[br2.left,br2.top]);
			});
			var testtab=createtoolbar({label:'TestTab',x:100,y:150,h:200,w:300});
			Event.add(document.body,'click',function(){testtab.setlabel('Clicked!')});
		</script>
	</body>
</html>