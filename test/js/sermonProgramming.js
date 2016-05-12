$(document).ready(function() {
	// To load the sermons from json file
	var sermonFolderName = "admin/messagesData.json";
	var sermonRowList = [] ;
	 console.log("inside sermon pgm");
	$(".loading-spinner").css("display","block");
	// To read the images for Home page banner slider
	$.ajax({
		 url : "admin/getMessages.php",
		 data: {
		 action:"start"
    		 },
		 type:"GET", 
		 dataType: "json",
		 success: function (data) {
			 console.log("inside ajax");
			 $.each(data,function(index,item){
				 sermonRowList += "<div class='sermon-row index"+index+"'><div class='sermon-col col-md-2'>"+ item.date+"</div>";
				 sermonRowList += "<div class='sermon-col col-md-4'>"+ item.title+"</div>";
				 sermonRowList += "<div class='sermon-col col-md-3'>"+ item.speaker+"</div>";
				 sermonRowList += "<div class='sermon-col col-md-3'>";
				 if(item.messagetype == "audio"){
					 sermonRowList += "<a id='sermon_audio' class='sermon-audio' data-src='"+ item.audiokey +"' title='"+item.title+"'></a>";
				 }
				 else if(item.messagetype == "video"){
					 sermonRowList += "<a id='sermon_video' class='sermon-video' data-src='"+ item.videokey +"' title='"+item.title+"'></a>";
				 } else if(item.messagetype == "both") {
					 sermonRowList += "<a id='sermon_audio' class='sermon-audio' data-src='"+ item.audiokey +"' title='"+item.title+"'></a>";
					 sermonRowList += "<a id='sermon_video' class='sermon-video' data-src='"+ item.videokey +"' title='"+item.title+"'></a>";
				 }
				 sermonRowList += "<a class='sermon-download' href='"+item.audiokey+"' download='"+item.audiokey+"'></a>";
				 sermonRowList += "</div></div>";
				$(".sermon-content").html(sermonRowList);
			 });
		},
		error: function(data){
			console.log(data);
		}
	});
	setTimeout(function(){
		$(".home-page-spinner").css("display","none");
		$(".loading-spinner").css("display","none");},2000);
	
	var mediaPlayer = $('audio').mediaelementplayer({
			// if the <video width> is not specified, this is the default
		    defaultVideoWidth: 480,
		    // if the <video height> is not specified, this is the default
		    defaultVideoHeight: 270,
		    // if set, overrides <video width>
		    videoWidth: -1,
		    // if set, overrides <video height>
		    videoHeight: -1,
		    // width of audio player
		    audioWidth: 400,
		    // height of audio player
		    audioHeight: 30,
		    // initial volume when the player starts
		    startVolume: 0.8,
		    // useful for <audio> player loops
		    loop: false,
		    // enables Flash and Silverlight to resize to content size
		    enableAutosize: true,
		    // the order of controls you want on the control bar (and other plugins below)
		    features: ['playpause','progress','current','duration','tracks','volume','fullscreen'],
		    // Hide controls when playing and mouse is not over the video
		    alwaysShowControls: false,
		    // force iPad's native controls
		    iPadUseNativeControls: false,
		    // force iPhone's native controls
		    iPhoneUseNativeControls: false, 
		    // force Android's native controls
		    AndroidUseNativeControls: false,
		    // forces the hour marker (##:00:00)
		    alwaysShowHours: false,
		    // show framecount in timecode (##:00:00:00)
		    showTimecodeFrameCount: false,
		    // used when showTimecodeFrameCount is set to true
		    framesPerSecond: 25,
		    // turns keyboard support on and off for this instance
		    enableKeyboard: true,
		    // when this player starts, it will pause other players
		    pauseOtherPlayers: true,
		    // array of keyboard commands
		    keyActions: []
	});
	
	// To handle the click event of music , video and download buttons
	$(".sermon-content").on("click","a.sermon-audio",function(e){
		e.preventDefault();
		var item = $(this);
		var title = item.attr("title");
		var src =  item.attr("data-src");
		var player = new MediaElementPlayer('audio');
		$(".sermon-section-title").html(title);
		if(item.hasClass("sermon-audio")){
			$(".sermons-player-section .video-section").css("display","none");
			$(".sermons-player-section .audio-section").css("display","block");
			player.pause();
			player.src = src ;
			player.load();
			player.play();
		} else if(item.hasClass("sermon-video")){
			$(".sermons-player-section .audio-section").css("display","none");
			$(".sermons-player-section .video-section").css("display","block");
			$(".video-section .player iframe").attr("src",src);
		}
	});
	  
	// Loading of the Sermon table contents
	setTimeout(function(){
	$(".pagination").hide();
	var recordsPerPage = 5;
	var totalNumRecords = $(".sermon-content .sermon-row").length;

	//recordsPerPage is the number of items you want to display on each page
	//totalNumRecords is the total number of items that you have
   if( recordsPerPage < totalNumRecords) {
	 //Show the pagination controls
	    $(".pagination").show();

	    //loop through all of the divs and hide them by default.
	    for (var i=0; i <= totalNumRecords; i++) {
	        $(".sermon-content").find(".sermon-row.index" + i).hide();
	    }

	    //then only display the number of divs the user dictated
	    for (var i = 1; i <= recordsPerPage; i++) {
	        $(".sermon-content").find(".sermon-row.index" + i).show();
	    }

	    //maxPages is the maximum amount of pages needed for pagination. (round up) 
	    var maxPages = Math.ceil(totalNumRecords/recordsPerPage);   

	    $('.pagination').jqPagination({
	        link_string : '/?{page_number}',
	        max_page     : maxPages,
	        paged        : function(page) { 

	            //a new page has been requested

	            //loop through all of the divs and hide them all.
	            for (var i=1; i <= totalNumRecords; i++) {
	            	 $(".sermon-content").find(".sermon-row.index" + i).hide();
	            }

	            //Find the range of the records for the page: 
	            var recordsFrom = recordsPerPage * (page-1);
	            var recordsTo = recordsPerPage * (page);

	            //then display only the records on the specified page
	            for (var i = recordsFrom; i <= recordsTo; i++) {
            	$(".sermon-content").find(".sermon-row.index" + i).show();
	            }      
	            //scroll to the top of the page if the page is changed
	            //$("html, body").animate({ scrollTop: 0 }, "slow");
	        }
	    });
   }
   
	}, 2000);
});

