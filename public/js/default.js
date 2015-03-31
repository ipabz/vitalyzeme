$(function () {
	var modal = null;
	
	$(document).delegate('.themodalhere', 'click', function(e) {
		e.preventDefault(); 
		$('.mymodal-popup-wrapper').slideDown('fast');	
	});
	
	$('.mymodal-popup-wrapper').click(function(e) {
        modal = setTimeout(function() {
				$('.mymodal-popup-wrapper').hide();
			}, 100);
    });
	
	$('.mymodal-popup').click(function(e) {
		e.preventDefault();
        clearTimeout(modal);
		return false;
    });
	
	$(document).delegate('.thelink', 'click', function(e) {
		//$('.loading_container').show();	
	});
	
	$(document).delegate('.month_current, .month_passed', 'click', function(e) {
		//$('.loading_container').show();	
		window.location = $(this).attr('data-href');
	});
	
	$(document).delegate('.star', 'click', function(e) {
		e.preventDefault();
		
		//$('.loading_container').show();	
		var _ref = $(this);
		var cl = _ref.attr('class');
		cl = cl.replace('-empty', '');
		var c_id = $(this).attr('data-chapter-id');
		
		$.get($(this).attr('href'), function() {
			_ref.attr('class', cl);
			$('.article').removeClass('current_step');
			$('#chapter'+c_id).addClass('current_step');
			//$('.loading_container').hide();
		});
		
		return false;
	});
	
	$('#timeline-body .article .topics .topic').hover(function(e) { 
			var parent = $(this).parent();
			var prev = parent.prev();
			
			prev.addClass('hovered_head');
		}, function(e) {
				
				var parent = $(this).parent();
				var prev = parent.prev();
				
				prev.removeClass('hovered_head');
				
			});
			
	$('.thelink').click(function(e) {
        e.preventDefault();		
		var url = $(this).attr('data-href');
		
		$.get(url, function(d) {
			$('.modal-content').html(d);
		});
    });	
	
	$('#myModal').on('hidden.bs.modal', function (e) {
		var url = window.location.href;
		//window.location = url;
		$('.modal-content').html('');
		setTimeout(function() { $('.page-title').trigger('click'); }, 1000);
	});
	
	
	var whitebar = $('.whitebar');
	var whitebar_parent = whitebar.parent();
	whitebar.height((whitebar_parent.height() * .93 ));
	var style = whitebar.attr('style');
	whitebar.attr('style', style+'margin-top:'+(whitebar_parent.height() - (whitebar_parent.height() * .93 ))+'px');
		
});