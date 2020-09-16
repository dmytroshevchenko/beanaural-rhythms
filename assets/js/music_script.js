(function($) {
$(document).ready(function() {
	

	if( $('.player_popup').length ){
		var if_player = 1;
	} else{
		var if_player = 0;
	}
	if( if_player ){
		Amplitude.init({
			"songs": songs_array
		});
	}


	$('.show-playlist').on('click', function(){
		$('#white-player-playlist-container').slideDown(500, function(){
			$(this).show();
		});
	});

	$('.close-playlist').on('click', function(){
		$('#white-player-playlist-container').slideUp(500, function(){
			$(this).hide();
		});
	});


	$('.song_play_pause .play_icon').click(function(){
		
		var music_id = $(this).parents('.one_song').data('music_id');
		Amplitude.playSongAtIndex( music_id );

		var playlist_item_html = '';
		$.each(songs_array, function( index, value ){
			if( index >= music_id ){
				playlist_item_html += '<div class="white-player-playlist-song amplitude-song-container amplitude-play-pause" amplitude-song-index="' + music_id + '"><img src="' + value.cover_art_url + '"/><div class="playlist-song-meta"><span class="playlist-song-name">' + value.name + '</span><span class="playlist-artist-album">' + value.album + '</span></div></div>';
				
			}
		});
		$('.white-player-playlist').html( playlist_item_html );

		$(this).parents('.one_song').addClass('play');
		$('.player_popup').children('.popup_bg').fadeIn();

	});




}); //document.ready


$(document).on('click', '.amplitude-play-pause.amplitude-playing', function(){
		var music_id = $(this).parents('.footer_player').data('music_id');
		$('.one_song[data-music_id="' + music_id + '"]').addClass('play');
});

$(document).on('click', '.amplitude-play-pause.amplitude-paused', function(){
	$('.one_song').removeClass('play');
});

/*
$(document).on('click', '.amplitude-prev', function(){
		$('.one_song').removeClass('play');
		var music_id = $(this).parents('.footer_player').data('music_id') - 1;
		$('.footer_player').data('music_id', music_id);
		$('.one_song[data-music_id="' + music_id + '"]').addClass('play');
});

$(document).on('click', '.amplitude-next', function(){
		$('.one_song').removeClass('play');
		var music_id = $(this).parents('.footer_player').data('music_id') + 1;
		$('.footer_player').data('music_id', music_id);
		$('.one_song[data-music_id="' + music_id + '"]').addClass('play');
});
*/







})( jQuery );