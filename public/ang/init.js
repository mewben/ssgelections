toastr.options.closeButton = true;
toastr.options.positionClass = 'toast-bottom-right';

$(document).ready(function() {
	$('body').tooltip({
		selector: "[data-tooltip=tooltip]",
		container: "body"
	});
});

$(document).on('click', 'a.dropdown-toggle', function() {
	$(this).next().find(':input:enabled:visible:first').focus().select();
});

$(document).on('shown.bs.modal', '.modal', function() {
	$(this).find('.modal-body').find(':input:enabled:visible:first').focus().select();
});