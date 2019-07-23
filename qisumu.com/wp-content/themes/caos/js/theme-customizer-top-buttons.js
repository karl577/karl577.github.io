jQuery(document).ready(function($) {
	var $destination = $("#customize-info .accordion-section-title");
	$destination.prepend('<a style="width: 80%; margin: 10px auto; display: block; text-align: center;" href="https://www.quemalabs.com/article/caos-documentation/" class="button" target="_blank">{documentation}</a>'.replace( '{documentation}', topbtns.documentation ) );
 	$destination.prepend('<a style="width: 80%; margin: 10px auto; display: block; text-align: center;" href="https://www.quemalabs.com/theme/caos-pro/?utm_source=Caos%20Theme&utm_medium=Pro%20Button&utm_campaign=Caos" class="button" target="_blank">{pro}</a>'.replace( '{pro}', topbtns.pro ) );
});