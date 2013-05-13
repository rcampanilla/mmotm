$(document).ready(function() {
    
    /*+ login module +*/
    $('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('body').on('click', 'a.close, #mask', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
    /*- login modue -*/
    
    var startVideo = '2rz-vhLCBak';
    var playList = 'https://gdata.youtube.com/feeds/api/playlists/PLRaiciPZMNNfe5_32Ml5jVQp-voIUzGXI?v=2';
    $.ajax({
    url : playList,
    type: "GET",
    dataType: "xml",
    success: function(data) {
        var info = $(data).find('feed');
        var lists = '<div id="current-video">';
        //lists += '<h1>' + $(info).find('title')[0].textContent + '<span> by <a href="">'+ $(info).find('author  name')[0].textContent +'</a></span> </h1>';
        lists += '    <iframe width="349" height="205" src="http://www.youtube.com/embed/'+startVideo+'?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>';
        lists += '</div>';
        lists += '<div id="playlists">';

        $(info).find('entry').each( function(i){
            lists += '<div class="row self-clear" id="'+$(this).find('media\\:group yt\\:videoid')[0].textContent+'">';
            //lists += '    <label>'+ (i+1) +'</label>';
            lists += '    <p>';
            lists += '        <img src="'+$(this).find('media\\:group media\\:thumbnail')[0].attributes[0].textContent+'" alt="" width="64" />';
            lists += '        '+$(this).find('title')[0].textContent+ '<br /><span>by '+$(this).find('author  name')[0].textContent+'</span>';
            lists += '    </p>';
            lists += '</div>';
        });
        lists += '</div>';
        
        $("#video-container").append(lists);
        $("#"+startVideo).addClass("active");
        $("#"+startVideo).focus();
        
        $(".row").click(function () {
            $("#current-video iframe").remove();
            $("#current-video").append('<iframe width="349" height="205" src="http://www.youtube.com/embed/'+$(this).attr('id')+'?feature=player_detailpage&autoplay=1" frameborder="0" allowfullscreen></iframe>');
            $("#playlists .row").removeClass("active");
            $(this).addClass("active");
        });
    },
    error: function(data) { /*alert('Sorry, unable to get playlist info');*/ },
    });
    
});