function preventSelection(element){
	function removeSelection(event){
		if(!event.target) event.target=event.srcElement;
		if(event.target.tagName.match(/INPUT|TEXTAREA/i)) return true;
		if(event.preventDefault) event.preventDefault(); else event.returnValue=false;
		if(window.getSelection) window.getSelection().removeAllRanges();
		else if(document.selection&&document.selection.clear) document.selection.clear();
	}

	function killCtrlA(event){
		if(!event.target) event.target=event.srcElement;
		if(event.target.tagName.match(/INPUT|TEXTAREA/i)) return true;
		var key=event.keyCode||event.which;
		if(event.ctrlKey&&key==65){
			removeSelection(event);
			if(event.preventDefault) event.preventDefault(); else event.returnValue=false;
		}
	}

	Event.add(element,'mousemove',removeSelection);
	Event.add(element,'mousedown',removeSelection);
	Event.add(element,'mouseup',removeSelection);
	Event.add(element,'keydown',killCtrlA);
	Event.add(element,'keyup',killCtrlA);
}
preventSelection(document);

function drawline(LnNode,v,x,y,l){//Node of line, vertical (true/false), x, y, length
	LnNode.style.left=x+'px';
	LnNode.style.top=y+'px';
	LnNode.style[v?'height':'width']=l+'px';
	
	
	
	
	
}