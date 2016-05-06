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
	var pageName = document.location.pathname;
	
	if(pageName.indexOf("cfcc-home") != -1) {
		// To read the images for Home page banner slider
		$.ajax({
			 url : imgFolderName,
			 dataType: "json",
			 beforeSend: function(data,xhr,response){
				$("#homeCarousel .carousel-inner item").addClass("loading-image");
			 },
			 success: function (data) {
				 
				 $.each(data,function(index,item){
					if(index == 0) {
						dataTargetList += "<li data-target='#homeCarousel' data-slide-to='"+index+"' class='active'></li>";
						dataImageItem += "<div class='item image-viewier active'><a href='"+item.redirectlink+"'><img src='admin/imagebank/"+item.imgsrc+"'>";
						dataImageItem += "<div class='sLeft whiteText'><mytitle>"+item.mytitle+"</mytitle></div></a></div>";
					}else{
						dataTargetList += "<li data-target='#homeCarousel' data-slide-to='"+index+"'></li>";
						dataImageItem += "<div class='item image-viewier'><a href='"+item.redirectlink+"'><img src='admin/imagebank/"+item.imgsrc+"'>";
						dataImageItem += "<div class='sLeft whiteText'><mytitle>"+item.mytitle+"</mytitle></div></a></div>";
					}
				});
				$("#homeCarousel .carousel-inner item").removeClass("loading-image");
				$("#homeCarousel .carousel-indicators").html(dataTargetList);
				$("#homeCarousel .carousel-inner").html(dataImageItem);
			}
		});
	}
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
