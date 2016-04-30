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
		if(title == "home"){
			$.ajax({
				url: pageName,
				beforeSend: function(xhr){
					$(".spinner-container").css("display","block");
				},
				success: function(result,status,xhr){
						$(".content-page-section").css("display","none");
						$(".home-page-section").css("display","block");
						$(".home-page-section").load(result);
					
				},
				error: function(xhr,status,error){
					$(".error-container").css("display","block");
					$(".error-container").html("<h3> We are coming soon </h3>");
				}
			}).done(function(){
				$(".spinner-container").css("display","none");
			});
		}else {
			$.ajax({
				url: pageName,
				beforeSend: function(xhr){
					$(".spinner-container").css("display","block");
				},
				success: function(result,status,xhr){
						$(".home-page-section").css("display","none");
						$(".content-page-section").css("display","block");
						$(".content-section").css("display","block");
						$(".content-section").html("");
						$(".content-section").load(result);	
				},
				error: function(xhr,status,error){
					$(".error-container").css("display","block");
					$(".error-container").html("<h3> We are coming soon </h3>");
				}
			}).done(function(){
				$(".spinner-container").css("display","none");
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
		$(".mobile-menu-items").show();
	});
	
	$("#menu_items_bar.mobile-menu-items a").click(function(e){
		$(".mobile-menu-items").hide();
	});
	
});
