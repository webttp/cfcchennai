$(function(){
	
	if($("#menu_items_bar .has-sub ul li").hasClass(".has-sub")){
		$("#menu_items_bar .has-sub .has-sub").append("<i class='fa-caret-right'></i>");
	}
	
	// To add the active class to menu items
	$("#menu_items_bar > ul > li a").mouseenter(function(e){
			$("#menu_items_bar > ul > li.active").removeClass("active");
			$(this).addClass("active");
	});
	
	// to load the html pages dynamically using class names
	$("#menu_items_bar > ul > li a").on("click",function(e){
		var self = $(this);	
		var title = self.attr("title");
		var pageName= "templates/"+ title +".html";
		var timingsPage = "templates/timings.html";
		if(title == "home"){
			$(".content-page-section").css("display","none");
			$(".home-page-section").css("display","block");
			$(".home-page-section").load(pageName);
		}else {
			$(".home-page-section").css("display","none");
			$(".content-section").html("");
			$(".timings-section").html("");
			setTimeout(function(){
				$(".loading-container").css("display","block");
			}, 2000);
			$(".content-page-section").css("display","block");
			$(".content-section").load(pageName);
        		$(".timings-section").load(timingsPage);
			$(".loading-container").css("display","none");
		}
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
