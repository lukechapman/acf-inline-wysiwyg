/* 
Version: 1.0.2
*/

(function($) {

	var options = {
		disableReturn: true,
		disableDoubleReturn: true,
		toolbar: {
        	buttons: ['bold', 'italic', 'underline', 'anchor']
        }
    };

    if(typeof acf !== 'undefined'){

		acf.add_action('append', function( $el ){
			new MediumEditor($el.find('.inline-wysiwyg'), options);
		});

		acf.add_action('load', function( $el ){
			$el.find('.inline-wysiwyg').each(function(){
				var $input = $(this);
				if( $input.val() !== '' ){
					new MediumEditor($input, options);
				}
			});
		});
		
	}

})(jQuery);