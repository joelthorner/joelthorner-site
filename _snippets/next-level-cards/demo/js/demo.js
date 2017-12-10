$(document).ready(function() {
	$('#selectEffect').change(function(event) {
		if ($(this).val()!=0)
			$('#card-demo-1 .nlcard')
				.removeAttr('class')
				.attr('class', 'nlcard nlcard-' + $(this).val());
	});
});