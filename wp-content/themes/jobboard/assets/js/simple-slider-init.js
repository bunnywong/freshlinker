/**
* Plugin setup of simple slider
*
* @package WordPress
* @subpackage Job_Board
* @since Job Board 1.3.2
*/

jQuery(document).ready(function($){

  "use strict";

  jQuery("[data-slider]")
  .each(function () {
    var input = $(this);
  })
  .bind("slider:ready slider:changed", function (event, data) {
    jQuery(this)
    .nextAll(".output:first")
    .html(data.value.toFixed(3));

    console.log('Slider value: ' + data.value);

    jQuery('#resume_search_experience').val(data.value.toFixed(0));

  });


});
