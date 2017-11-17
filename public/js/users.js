$(document).ready(function() {
	$('.editUserBtn').click(function() {

		if($(this).hasClass('edit')) {
			$(this).text('Save');

			$(this).parent().siblings().each(function(i, td) {
				let itemVal = $(td).text();
				$(td).css('background-color', 'orange');
				let editableDiv = $('<div contenteditable="true" data-divNum="' + i + '"></div>');
				$(editableDiv).text(itemVal);

				$(td).html(editableDiv);
			});

			$(this).removeClass('edit');
			$(this).addClass('save');
		} else if($(this).hasClass('save')) {
			$(this).text('Edit');
			let arrUpdateData = [];
			let userObj = {};

			let userId = $(this).data('userid');
			userObj.userId = userId;
			
			arrUpdateData.push(userObj);

			$(this).parent().siblings().each(function(i, td) {
				let itemVal = $(td).children('div').text();
				let obj = {};
				obj.index = i;
				obj.value = itemVal;

				arrUpdateData.push(obj);
			});

			console.log('arr is', arrUpdateData);

			let data = JSON.stringify(arrUpdateData);
			
			$.post('/zend.local/public/users/edit/data/' + data, function(data) {
				console.log('data ist:::', data);
			}, 'json');

			$(this).parent().siblings().each(function(i, td) {
				let itemVal = $(td).children('div').text();
				$(td).css('background', 'transparent');
				$(td).empty();

				$(td).text(itemVal);
			});

			$(this).removeClass('save');
			$(this).addClass('edit');
		}
	});
});