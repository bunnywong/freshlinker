jQuery(document).ready(function($){

	$('#searchsubmit').after('<i class="fa fa-search"></i>');
		
	$('#all_jobs').on('click', '.nmedia-pagination a.page-numbers', function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		$('#all_jobs').fadeOut(500, function(){
			$("#loding").show();
			$(this).load(link + ' #all_jobs', function() {
				$("#loding").hide();
				$(this).fadeIn(500);
			});
		});
	});
	$('#fresh-graduate-50').on('click', '.nmedia-pagination a.page-numbers', function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		$('#fresh-graduate-50').fadeOut(500, function(){
			$("#loding").show();
			$(this).load(link + ' #fresh-graduate-50', function() {
				$("#loding").hide();
				$(this).fadeIn(500);
			});
		});
	});
	$('#full-time-15').on('click', '.nmedia-pagination a.page-numbers', function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		$('#full-time-15').fadeOut(500, function(){
			$("#loding").show();
			$(this).load(link + ' #full-time-15', function() {
				$("#loding").hide();
				$(this).fadeIn(500);
			});
		});
	});
	$('#part-time-24').on('click', '.nmedia-pagination a.page-numbers', function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		$('#part-time-24').fadeOut(500, function(){
			$("#loding").show();
			$(this).load(link + ' #part-time-24', function() {
				$("#loding").hide();
				$(this).fadeIn(500);
			});
		});
	});
	
});