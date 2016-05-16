$(document).ready(function() {
	
	// To load the sermons from json file
	$(".loading-spinner").css("display","block");
	
	setTimeout(function(){
		$(".home-page-spinner").css("display","none");
		$(".loading-spinner").css("display","none");},2000);
	
/*	var mediaPlayer = $('audio').mediaelementplayer({
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
	*/
	 /*jPlayer audio player*/ 
	$("#audio_jplayer_1").jPlayer({
	        ready: function () {
	          $(this).jPlayer("setMedia", {
	            title: "CFCC Messages",
	            mp3: "https://ia601508.us.archive.org/14/items/02DailyFellowshipWithGod/02-Daily%20fellowship%20with%20God.mp3"
	           });
	        },
	        cssSelectorAncestor: "#audio_jplayer_1",
	        swfPath: "/js",
	        supplied: "mp3",
	        useStateClassSkin: true,
	        autoBlur: false,
	        smoothPlayBar: true,
	        keyEnabled: true,
	        remainingDuration: true,
	        toggleDuration: true
	      });
	
	// To handle the click event of music , video and download buttons
	$(".sermon-content").on("click","a",function(e){
		var item = $(this);
		if(item.attr("id") != "sermon-download"){
			e.preventDefault();
			/* var player = new MediaElementPlayer('audio');
			player.pause();*/
			var title = item.attr("title");
			$(".sermon-section-title").html(title);
			var src =  item.attr("class");
			if(item.attr("id") == "sermon-audio"){
				$(".sermons-player-section .video-section").css("display","none");
				$(".sermons-player-section .audio-section").css("display","block");
				updatePlayer(title,src);
				/*player.setSrc(src) ;
				player.load();
				player.play();*/
				$("html, body").animate({ scrollTop: 0 }, "slow");
			} else if(item.attr("id") == "sermon-video"){
				$(".sermons-player-section .audio-section").css("display","none");
				$(".sermons-player-section .video-section").css("display","block");
				$(".video-section .player iframe").attr("src",src);
				$("html, body").animate({ scrollTop: 0 }, "slow");
			}
		}
	});
	  
	function updatePlayer(title, src){
	        var player = $("#audio_jplayer_1");
	
	        player.jPlayer({
	        ready: function () { 
	          $(this).jPlayer("setMedia", { 
	            title: title,
	            mp3: src
	
	          }); 
	          $(this).jPlayer("play", 0);
	        },
	        swfPath: "/js",
	        supplied: "mp3",
	
	      }); 
	      player.jPlayer("setMedia", { 
	            mp3: src
	          }); 
	      player.jPlayer("play", 0);
    }
	/* var recordsPerPage = 5;
	var totalNumRecords;
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
	    for (var i = 0; i < recordsPerPage; i++) {
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
	            for (var i=0; i < totalNumRecords; i++) {
	            	 $(".sermon-content").find(".sermon-row.index" + i).hide();
	            }

	            //Find the range of the records for the page: 
	            var recordsFrom = recordsPerPage * (page-1);
	            var recordsTo = recordsPerPage * (page);

	            //then display only the records on the specified page
	            for (var i = recordsFrom; i < recordsTo; i++) {
            	$(".sermon-content").find(".sermon-row.index" + i).show();
	            }      
	            //scroll to the top of the page if the page is changed
	            //$("html, body").animate({ scrollTop: 0 }, "slow");
	        }
	    });
   }
   
	}, 2000);
	*/
	/* Textbox and dropdown functionalities in sermon's page */
	$(".search-textbox input").on("focus mouseenter", function(e){
		$(this).attr("value","");
	}).on("mouseout", function(e){
		if($(this).attr("value") == ""){
			$(this).attr("value","Search Sermon title");
		}
	});
});

