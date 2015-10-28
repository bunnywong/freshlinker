/**
* Custom JQuery for Advanced Search
*
* @package WordPress
* @subpackage Job_Board
* @since Job Board 1.5.1
*/

jQuery(document).ready(function($){
  // Inside of this function, $() will work as an alias for jQuery()
  // and other libraries also using $ will not be accessible under this shortcut

  "use strict";


  // Slider filter

  $(function(){
    var initSlider = slider.init;
    if(initSlider){
      $('select#experience_min, select#experience_max').selectToUISlider({
        labels:10,
        labelSrc:'text',
        tooltip:true,
      });
      $('select#sallary_min, select#sallary_max').selectToUISlider({
        labels:11,
        labelSrc:'text',
        tooltip:true,
      });
    }
  });


});
