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
		var self, url, oldpath, path, newpath; 
		self = $(this);
		if(self.attr("id") != 'menu_btn') {
			url = self.attr("href");
			// To read the href and change the path
			oldpath = document.location.pathname;
        		path = oldpath.substring(0, oldpath.lastIndexOf("/") + 1) ;
        		newpath = path + url;
			// To load the corresponding page
			location.assign(newpath);
		}
	});
	
	$("#menu_items_bar a#menu_btn").on("click",function(e){
		$(".mobile-menu-items").hide();
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
	
	$("a#menu_btn").click(function(e){
		$(".mobile-menu-items").hide();
	});
	
	// To close the menu items on mouse out
	$(".mobile-menu-items").on("focusout",function(e){
		$(this).hide();	
	}); 
});
