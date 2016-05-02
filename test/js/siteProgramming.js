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
		var contactPage;
		 if(title == "cfcc-thirumullai"){
		 	contactPage = "templates/thirumullai-contact.html";
		 }else if(title == "cfcc-tambaram"){
		 	contactPage = "templates/tambaram-contact.html";
		 }
		if(title == "home"){
			$(".content-page-section").css("display","none");
			$(".home-page-section").css("display","block");
			$(".home-page-section").load(pageName);
		}else if(title == "cfcc-thirumullai" || title == "cfcc-tambaram"){
			
			$(".home-page-section").css("display","none");
			$(".timings-section").css("display","none");
			$(".content-section").html("");
			$(".content-section").removeClass("content-border");
			$(".timings-section").html("");
			$(".content-page-section").css("display","block");
			$(".contacts-section").css("display","block");
			$(".loading-container").css("display","block");
			setTimeout(function(){
				$(".content-section").load(pageName);
				$(".loading-container").css("display","none");
				$(".content-section").addClass("content-border");
	        	}, 1000);
			setTimeout(function(){
				$(".contacts-section").load(contactPage);
			}, 2000);
		}
		else {
			$(".home-page-section").css("display","none");
			$(".contacts-section").css("display","none");
			$(".contacts-section").html("");
			$(".content-section").html("");
			$(".content-section").removeClass("content-border");
			$(".timings-section").html("");
			$(".content-page-section").css("display","block");
			$(".loading-container").css("display","block");
			$(".timings-section").css("display","block");
			setTimeout(function(){
				$(".content-section").load(pageName);
				$(".loading-container").css("display","none");
				$(".content-section").addClass("content-border");
			
	        	}, 1000);
			setTimeout(function(){
				$(".timings-section").load(timingsPage);
			}, 2000);
			
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
