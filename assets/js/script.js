(function($) {

$(document).ready(function() {


	$('.descrition_block .green_button').click(function(){
		if( $(this).parents('.descrition_block').hasClass('open') ){
			$(this).parents('.descrition_block').css('max-height', '250px');
			$(this).parents('.descrition_block').removeClass('open');
		} else{
			var height = $(this).parents('.descrition_block').find('.box').height() + 70;
			$(this).parents('.descrition_block').css('max-height', height);
			$(this).parents('.descrition_block').addClass('open');
		}
	})


	$('.profile_adaptive_menu').click(function(){
		$(this).parent().children('.profile_menu').slideToggle();
	})

	$('.profile_menu .profile_menu_item').click(function(){
		var tab_id = $(this).data('tab_id');
		$('.one_tab_content').fadeOut(0);
		$('.one_tab_content#profile_content_' + tab_id ).fadeIn(0);
		$(this).parent().children().removeClass('active');
		$(this).addClass('active');

		$('#profile_adaptive_menu_item').addClass( $(this).data('class') ).html( $(this).html() );

	if(window.matchMedia('(max-width: 720px)').matches){
		$(this).parents('.profile_menu_block').children('.profile_menu').slideToggle();
	}



	})

	$('.accordion_title').click(function(){
		$(this).parent().toggleClass('open').children('.accordion_content').slideToggle();
	})


	$('#adaptive_menu').click(function(){
		$('.main_menu').slideToggle();
	});



	if(window.matchMedia('(max-width: 540px)').matches){
		$('.one_footer_col h3').click(function(){
			$(this).toggleClass('open').parent().find('ul').slideToggle();
		})
	}


	if( $( "#mixer_beats_slider" ).length ){
		$( "#mixer_beats_slider" ).slider({
			min: 0,
			max: 100,
			value: 50,
			range: "min",
			slide: function( event, ui ) {
				$( "#mixer_beats_value" ).val($( "#mixer_beats_slider" ).slider( "values", 1 ) );
			}
		});
		$( "#mixer_beats_value" ).val($( "#mixer_beats_slider" ).slider( "values", 1 ) );
	}

	if( $( "#mixer_bg_slider" ).length ){
		$( "#mixer_bg_slider" ).slider({
			min: 0,
			max: 100,
			value: 50,
			range: "min",
			slide: function( event, ui ) {
				$( "#mixer_bg_value" ).val($( "#mixer_bg_slider" ).slider( "values", 1 ) );
			}
		});
		$( "#mixer_bg_value" ).val($( "#mixer_bg_slider" ).slider( "values", 1 ) );
	}

	if( $( "#mixer_affirmation_slider" ).length ){
		$( "#mixer_affirmation_slider" ).slider({
			min: 0,
			max: 100,
			value: 50,
			range: "min",
			slide: function( event, ui ) {
				$( "#mixer_affirmation_value" ).val($( "#mixer_affirmation_slider" ).slider( "values", 1 ) );
			}
		});
		$( "#mixer_affirmation_value" ).val($( "#mixer_affirmation_slider" ).slider( "values", 1 ) );
	}




	$('.sign_up_button').click(function(){
		$('.signup_form_popup').children('.popup_bg').fadeIn();
	});

	$('.login_button').click(function(){
		$('.login_form_popup').children('.popup_bg').fadeIn();
	});

	$('.reset_password_link').click(function(){
		$('.lostpassword_form_popup').children('.popup_bg').fadeIn();
	});





	$('.popup_bg').click(function(e) {
		var clicked = $(e.target); // get the element clicked
		if (clicked.is('.popup') || clicked.parents().is('.popup') ) {
			if( clicked.is('.close') ){
				$('.popup_bg').hide();
				if( $(this).parent().hasClass('player_popup') ){
					Amplitude.pause();
					$('.one_song').removeClass('play');
					$('.amplitude-play-pause.amplitude-playing').removeClass('amplitude-playing').addClass('amplitude-paused');
				}
			}
			return;
		} else {
			$('.popup_bg').hide();
			if( $(this).parent().hasClass('player_popup') ){
				Amplitude.pause();
				$('.one_song').removeClass('play');
				$('.amplitude-play-pause.amplitude-playing').removeClass('amplitude-playing').addClass('amplitude-paused');
			}
		}
	});




	$('.open_password_change').click(function(){
		$(this).parent().children('.password_change').slideToggle();
	})




//	$('.user_contact_form').submit(function(e){
	$('.user_contact_form input[type="submit"]').click(function(e){
		console.log('ok');
		e.preventDefault();
		var empty = false;
		$(this).find('input, textarea').each(function(){
			if( $(this).val() == '' ){
				$(this).addClass('empty');
				empty = true;
			} else{
				$(this).removeClass('empty');
			}
		});
		if( !empty ){
			send_contact_form( $(this).parents('form') );
		}
	})



	function send_contact_form( form ) {
		var your_name = form.find("input.your_name").val();
		var your_email = form.find("input.your_email").val();
		var your_theme = form.find("input.your_theme").val();
		var your_message = form.find("textarea.your_message").val();

	    $.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			dataType: 'json',
			data: {
				'action' : 'contact_form',
				'your_name' : your_name,
				'your_email' : your_email,
				'your_theme' : your_theme,
				'your_message' : your_message,
			},
	        beforeSend: function() {
				$('.contact_loading_popup').children('.popup_bg').fadeIn();
				
	        },
	        success: function() {
	        	form.find("input.your_theme").val('');
	        	form.find("textarea.your_message").val('');

				$('.contact_loading_popup').children('.popup_bg').fadeOut();
				$('.contact_success_popup').children('.popup_bg').fadeIn();

	        },
	        error: function(){
	        	console.log('error');
	        }
	    });
	}


	function clearForm(container) {
		container.find("input[type=text], input[type=file], input[type=email], input[type=phone], textarea").each(function(){
			$(this).val("");
		});
	}


	$('.song_like').click(function(){
		var user_id = ajax_var.current_user_id;
		var music_id = $(this).parents('.one_song').data('music_post_id');
		like_song( music_id, user_id, $(this).parents('.one_song') );
	})

	$('.song_trash').click(function(){
		var user_id = ajax_var.current_user_id;
		var music_id = $(this).parents('.one_song').data('music_post_id');
		like_song( music_id, user_id, $(this).parents('.one_song') );
		$(this).parents('.one_song').remove();
	})


	function like_song( music_id, user_id, song_obj ) {


		$.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			dataType: 'json',
			data: {
				'action' : 'like_song',
				'music_id' : music_id,
				'user_id' : user_id,
			},
			beforeSend: function(){
				song_obj.find('.song_like').toggleClass('liked');
			},
	        success: function() {
	        },
	        error:  function() {
				song_obj.find('.song_like').toggleClass('liked');
	        },
	    });
	}


	$('.add_to_cart_button .cart').click(function(){
		var music_id = $(this).parents('.one_song').data('music_post_id');
		var user_id = ajax_var.current_user_id;
		var order_cookies = ajax_var.order_cookies;
 		add_to_cart( music_id, user_id, order_cookies, $(this).parents('.one_song') );
	})


	function add_to_cart( music_id, user_id, order_cookies, song_obj ) {


		$.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			dataType: 'json',
			data: {
				'action' : 'add_to_cart',
				'music_id' : music_id,
				'user_id' : user_id,
				'order_cookies' : order_cookies
			},
			beforeSend: function(){
				song_obj.find('.add_to_cart').toggleClass('added');
			},
	        success: function() {
	        },
	        error:  function() {
				song_obj.find('.add_to_cart').toggleClass('added');
	        },
	    });
	}




}); //document.ready


$('body').on("touchstart", function(e) {
	e.preventDefault();
	return false;
});
})( jQuery );