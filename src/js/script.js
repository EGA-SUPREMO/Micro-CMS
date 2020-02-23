function showMore(i) { 
	document.getElementById('seeMore' + i).style.display='none';
	document.getElementById('comment' + i).innerHTML = '<?php echo "QUIO" ?>';
}