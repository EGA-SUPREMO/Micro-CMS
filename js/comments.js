"strict use";

function reduceText(text) {
	max_length = 400;

    result = '';

    if (text.length >= max_length) {
        result = text.substring(0, max_length);

        result += '...';
    } else {
        result = text;
    }

    return result;
}
function showMore(i, text) {
	if (document.getElementById('seeMore' + i).innerHTML == 'Show more') {
		document.getElementById('seeMore' + i).innerHTML = 'Show less';
		document.getElementById('comment' + i).innerHTML = text;
	} else {
		document.getElementById('seeMore' + i).innerHTML = 'Show more';
		document.getElementById('comment' + i).innerHTML = reduceText(text);
	}
}