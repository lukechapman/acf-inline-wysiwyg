/* 
Version: 1.0.1
*/

(function($) {

	var options = {
		disableReturn: true,
		disableDoubleReturn: true,
		toolbar: {
        	buttons: ['bold', 'italic', 'underline', 'anchor']
        }
    };

	acf.add_action('append', function( $el ){
		var editor = new MediumEditor($el.find('.inline-wysiwyg'), options)
	});

	acf.add_action('load', function( $el ){
		var editor = new MediumEditor($el.find('.inline-wysiwyg'), options)
	});

})(jQuery);