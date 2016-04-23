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
			$(".content-page-section").css("display","none");
			$(".home-page-section").css("display","block");
			$(".home-page-section").load(pageName);
		}else {
			$(".home-page-section").css("display","none");
			$(".content-page-section").css("display","block");
			$(".content-section").html("");
			$(".content-section").load(pageName);
		}
	});
});