window.onload=function(){
	alert('');
	// var center_wrap=document.getElementsByClassName('center_wrap');
	var div44=document.getElementById('div44');
	var current=div44.getElementsByTagName('li');
	for( var i=0;i<current.length;i++){
		current[i].onmouseover=function(){
			for( var i=0;i<current.length;i++){
				current[i].className='';
			}
		this.className='current';
		}
	}
}