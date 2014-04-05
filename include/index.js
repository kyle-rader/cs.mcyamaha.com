var CURRENT_PAGE = 'home';

$(document).ready(function() {
	LoadPage(CURRENT_PAGE);
});

function LoadPage(page) {
	var content = $('#content');
	if (content.text() != '') {
		content.fadeOut(75);
	}
	$.get('/ajax/get_page.php?page=' + page, function(response) {
		content.html(response).fadeIn();
	});
};
