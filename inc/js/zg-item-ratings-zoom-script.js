/*
 ### Zeitguys Item Ratings Zoom Plugin v1.0 ###
*/
jQuery(document).ready(function( $ ){
	
	// Get all the thumbnail
	$('div.zg-zoom-thumbnail-item').mouseenter(function(e) {
	
		// Calculate the position of the image tooltip
		x = e.pageX - $(this).offset().left;
		y = e.pageY - $(this).offset().top;
		
		// Set the z-index of the current item,
		$(this).css('z-index','15');
		
		$(this).children("div.zg-zoom-tooltip").css({'display':'block'});
		
		imgHeight = $(this).children("div.zg-zoom-tooltip").children("img").height();
		
		y = y - (imgHeight/2);
		
		// make sure it's greater than the rest of thumbnail items
		// Set the position and display the image tooltip
		$(this).children("div.zg-zoom-tooltip").css({'top': y + 10,'left': x });
		
	}).mousemove(function(e) {
	
		// Calculate the position of the image tooltip  
		x = e.pageX - $(this).offset().left;
		y = e.pageY - $(this).offset().top;
		
		imgHeight = $(this).children("div.zg-zoom-tooltip").children("img").height();
		
		y = y - (imgHeight/2);
		
		// This line causes the tooltip will follow the mouse pointer
		//$(this).children("div.zg-zoom-tooltip").css({'top': y + 10,'left': x + 20});
		
	}).mouseleave(function() {
	
		// Reset the z-index and hide the image tooltip
		$(this).css('z-index','1')
		.children("div.zg-zoom-tooltip")
		.animate({"opacity": "hide"}, "fast");
	
	});
	
});