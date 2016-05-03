$(function(){
	
	if($("#menu_items_bar .has-sub ul li").hasClass(".has-sub")){
		$("#menu_items_bar .has-sub .has-sub").append("<i class='fa-caret-right'></i>");
	}
	
	// To add the active class to menu items
	$("#menu_items_bar > ul > li a").mouseenter(function(e){
			$("#menu_items_bar > ul > li.active").removeClass("active");
			$(this).addClass("active");
	});
	
	// To handle the nav items click event
	$("#menu_items_bar > ul > li a").on("click",function(e){
		var self , url; 
		self = $(this);
		url = self.attr("href");
		
		// To read the href and change the path
		var oldpath = document.location.pathname;
		var path = oldpath.substring(0, oldpath.lastIndexOf("/") + 1);
		var newpath = path + url;
		location.assign(newpath);
	});
	
	lightbox.option({
	      'resizeDuration': 200,
	      'left': '300px',
	      'wrapAround': true
	});
	
	// Menu toggle bar functionalities
	$(".navbar-toggle").click(function(e){
		$(".mobile-menu-items").show();
	});
	
	$("#menu_items_bar.mobile-menu-items a").click(function(e){
		$(".mobile-menu-items").hide();
	});
	
});
