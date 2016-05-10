$(document).ready(function() {
	loadVideoOnLoad();
	
	// To handle the click event of video links
	$(".sermon-content").on("click","a.sermon-video",function(e){
		e.preventDefault();
		var item = $(this);
		var title = item.attr("title");
		var src =  item.attr("data-src");
		$(".sermon-section-title").html(title);
		if(item.hasClass("sermon-video")){
			$(".sermons-player-section .audio-section").css("display","none");
			$(".sermons-player-section .video-section").css("display","block");
			$(".video-section .player iframe").attr("src",src);
		} 
	});
});  


