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
		url = self.attr("href");
		
		// To read the href and change the path
		oldpath = document.location.pathname;
        path = oldpath.substring(0, oldpath.lastIndexOf("/") + 1) ;
        newpath = path + url;
		
		// To load the corresponding page
		location.assign(newpath);
	});
	
	var imgFolderName = "admin/getImages.php";
	var dataTargetList = [] , dataImageItem = [];
	// To read the images for Home page banner slider
	$.ajax({
		 url : imgFolderName,
		 dataType: "json",
		 success: function (data) {
			 $.each(data,function(index,item){
				dataTargetList += "<li data-target='#homeCarousel' data-slide-to='"+index+"'></li>";
				dataImageItem += "<a href='"+item.redirectlink+"'> <img src='admin/imagebank/'"+item.imgsrc+"'></a>";
			});
			$("#homeCarousel .carousel-indicators").append(dataTargetList);
			$("#homeCarousel .carousel-inner .item.image-viewier").append(dataImageItem);
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
