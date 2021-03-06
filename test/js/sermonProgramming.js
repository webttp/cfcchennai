$(document).ready(function() {
	
	/* To display date picker in the messages section */
	var date = new Date();
	$("#messagedate" ).datepicker({
	  maxDate:new Date(date.setDate(date.getDate() )),
      dateFormat: "yy-mm-dd",
	  showOn: "button",
      buttonImage: "../images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
    // To handle the click event of music , video and download buttons
	$(".sermon-content").on("click","a",function(e){
		var item = $(this);
		if(item.attr("id") != "sermon-download"){
			e.preventDefault();
			var title = item.attr("title");
			$(".sermon-section-title").html(title);
			var src =  item.attr("class");
			if(item.attr("id") == "sermon-audio"){
				$(".video-section .player iframe").attr("src",null);
				$(".sermons-player-section .video-section").css("display","none");
				$(".sermons-player-section .audio-section").css("display","block");
				updateAudioPlayer(title, src);
				$("html, body").animate({ scrollTop: 0 }, "slow");
			} else if(item.attr("id") == "sermon-video"){
				$("#audio_jplayer_1").jPlayer( "stop" );
				$(".sermons-player-section .audio-section").css("display","none");
				$(".sermons-player-section .video-section").css("display","block");
				$(".video-section .player iframe").attr("src",src);
				$("html, body").animate({ scrollTop: 0 }, "slow");
			}
		}
	});
	  
	function updateAudioPlayer(title, src){
	        var player = $("#audio_jplayer_1");
	        player.jPlayer("destroy");
	        player.jPlayer({
	        ready: function () {
	          $(this).jPlayer("setMedia", {
	            title: title,
	            mp3: src
	          }).jPlayer("play", 0);
	        },
			ended: function (event) {
				$(this).jPlayer("play");
			},
	         cssSelectorAncestor: "#jp_audio_container",
	         swfPath: "/js",
	         supplied: "mp3",
	         useStateClassSkin: true,
	         autoBlur: false,
	         smoothPlayBar: true,
	         keyEnabled: true,
	         remainingDuration: true,
	         toggleDuration: true
	       })
		   .bind($.jPlayer.event.play, function() { // pause other instances of player when current one play
				$(this).jPlayer("pauseOthers");
			});
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
	
	$("#menu_items_bar a#menu_btn").on("click",function(e){
		$(".mobile-menu-items").hide();
	});

});
