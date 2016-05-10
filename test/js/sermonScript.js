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
			changeVideo(src); 
		} 
	});
});  


function loadVideoOnLoad(src) {
	var tag = document.createElement('script');

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	// 3. This function creates an <iframe> (and YouTube player)
	// after the API code downloads.
	
	function onYouTubeIframeAPIReady() {
		player = new YT.Player(
				'player',
				{
					height : '340',
					width : '720',
					videoId : "http://www.youtube.com/embed/MslSfF9AewQ?rel=0&showinfo=0&enablejsapi=1",
					events : {
						'onReady' : onPlayerReady,
						'onStateChange' : onPlayerStateChange
					}
				});
	}

}
// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {	
  event.target.playVideo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.PLAYING && !done) {
    setTimeout(stopVideo, 6000);
    done = true;
  }
}
function stopVideo() {
  player.stopVideo();
}
 
function changeVideo(videoId){
	player.loadVideoById({videoId:videoId, startSeconds:5, endSeconds:60, suggestedQuality:'large'});
}
