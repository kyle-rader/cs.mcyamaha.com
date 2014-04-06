var CURRENT_PAGE = 'home';

$(document).ready(function() {
	LoadPage(CURRENT_PAGE);
});

function LoadPage(page) {
	var content = $('#content');
	if (content.text() != '') {
		content.fadeOut(50, function() {
			$.get('/ajax/get_page.php?page=' + page, function(response) {
				content.html(response).fadeIn(250);
			});
		});
	} else {
		$.get('/ajax/get_page.php?page=' + page, function(response) {
			content.html(response).fadeIn(250);
		});
	}	
};

$(document).on('click', 'a.top-btn', function(event) {
	var page = $(this).attr('data-target');
	LoadPage(page);
});
