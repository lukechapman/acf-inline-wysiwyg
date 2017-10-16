/*
Version: 1.0.2
*/

(function($){

	var options = {
		disableReturn: true,
		disableDoubleReturn: true,
		toolbar: {
        	buttons: ['bold', 'italic', 'underline', 'anchor']
        }
    };

	function acf_get_medium_editor_selector($el, $selector) {
		// because of repeaters, flex fields and clones
		// selector needs to be absolutely specific
		if ($selector != '') {
			$selector = '>'+$selector.trim();
		}

		var $parent = $el.parent();
		if ($parent.hasClass('acf-clone')) {
			// do not add editors to any clones
			// wait until they are active
			return false;
		}
		if ($parent.hasClass('acf-postbox')) {
			$selector = $parent.prop('nodeName').toLowerCase()+'#'+$parent.attr('id')+$selector;
			return $selector;
		}
		if ($parent.prop('nodeName').toLowerCase() == 'form') {
			$selector = $parent.prop('nodeName').toLowerCase()+$selector;
			return $selector;
		}
		if (typeof($parent.data('key')) != 'undefined') {
			$selector = '[data-key="'+$parent.data('key')+'"]'+$selector;
		}
		if (typeof($parent.data('id')) != 'undefined') {
			$selector = '[data-id="'+$parent.data('id')+'"]'+$selector;
		}
		if ($parent.hasClass('acf-row')) {
			$selector = '.acf-row'+$selector;
		}
		if (typeof($parent.attr('id')) != 'undefined') {
			$selector = '#'+$parent.attr('id')+$selector;
		}
		$selector = $parent.prop('nodeName').toLowerCase()+$selector;

		// recurse
		$selector = acf_get_medium_editor_selector($parent, $selector);

		return $selector;
	}

	function initialize_acf_medium_editor_field($el) {
		var $textarea = $el.find('textarea').first();
		var $selector = 'textarea'
		$selector = acf_get_medium_editor_selector($textarea, $selector);
		if (!$selector) {
			return;
		}

		var editor = new MediumEditor($selector, options);

		if (!editor.elements.length) {
			return;
		}

		// cause update to editor to trigger acf change event
		editor.subscribe('editableInput', function(e, editable) {
			$($selector).trigger('change');
		});
	}

	if(typeof acf.add_action !== 'undefined') {
		acf.add_action('ready append', function( $el ){
			acf.get_fields({ type : 'inline_wysiwyg'}, $el).each(function(){
				initialize_acf_medium_editor_field($(this));
			});
		});
	} else {
		$(document).on('acf/setup_fields', function(e, postbox){
			$(postbox).find('.field[data-field_type="inline_wysiwyg"]').each(function(){
				initialize_acf_medium_editor_field($(this));
			});
		});
	}
})(jQuery);
