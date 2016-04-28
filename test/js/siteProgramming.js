$(function(){
	
	if($("#menu_items_bar .has-sub ul li").hasClass(".has-sub")){
		$("#menu_items_bar .has-sub .has-sub").append("<i class='fa-caret-right'></i>");
	}
	
	// To add the active class to menu items
	$("#menu_items_bar > ul > li a").mouseenter(function(e){
			$("#menu_items_bar > ul > li.active").removeClass("active");
			$(this).addClass("active");
	});
	
	/*$("#menu_items_bar > ul > li.has-sub:hover a").mouseenter(function(e){
		$("#menu_items_bar > ul > li.has-sub:hover").addClass("menu-item-hover");
		$("#menu_items_bar > ul > li.has-sub ul").addClass("menu-sub-list-hover");
	}); */
	
	/* Lazy loadin of timings section */
	$(".timings-section").lazy({
		asyncLoader: function(element) {
					setTimeout(function() {
						$(".timings-section").load();
						$(".timings-section").removeClass("lazy");
					}, 5000);
				}
	});
	
	$(".footer-menu").lazy({
		placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7...",
		delay: 1000
	});
	
	// to load the html pages dynamically using class names
	$("#menu_items_bar > ul > li a").on("click",function(e){
		var self = $(this);	
		var title = self.attr("title");
		var pageName= "templates/"+ title +".html";
		if(title == "home"){
			$(".home-page-section").lazy({
				// loads with a five seconds delay
				asyncLoader: function(element) {
					setTimeout(function() {
						$(".home-page-section").css("display","block");
						$(".home-page-section").load(pageName);
						$(".content-page-section").css("display","block");
					}, 5000);
				$(".home-page-section").removeClass("lazy");
				}
				
			});
			
		}else {
			$(".content-section").lazy({
				asyncLoader: function(element) {
					setTimeout(function() {
						$(".home-page-section").css("display","none");
						$(".content-page-section").css("display","block");
						$(".content-section").html("");
						$(".content-section").load(pageName);					
					}, 5000);
					$(".content-section").removeClass("lazy");		
				}
			
			});
		}
	});
	
	lightbox.option({
	      'resizeDuration': 200,
	      'left': '300px',
	      'wrapAround': true
	});
	
	// Menu toggle bar functionalities
	$(".navbar-toggle").click(function(e){
		var self = $(this);
		if(!self.hasClass(".has-sub")){
			$(".mobile-menu-items").show();
		}
	});
	
	$("#menu_items_bar.mobile-menu-items a").click(function(e){
		$(".mobile-menu-items").hide();
	});
	
});
