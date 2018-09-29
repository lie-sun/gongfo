$(function(){

	$('a.sbtn, .subBack').on('click', function(){
		$('#mask').show();
	});

	$('#mask').on('click', function(){
		$(this).hide();
	});

	$('a.ddbtn').on('tap', function(e){
		e.stopPropagation();
		if (!$(this).hasClass('on')) {
			$(this).addClass('on');
			$(this).parent().addClass('on');
			$(this).next().addClass('on');			
		}else {
			$(this).removeClass('on');			
			$(this).next().removeClass('on');
			setTimeout(function(){
            	$('a.ddbtn').parent().removeClass('on');
            }, 300);
		}
	});

	$(document).on('tap', function(e){
        var obj = e.target;
        if (!$(obj).is('.dropdown, .dropdown *')) {                
            $('.dropdown, a.ddbtn').removeClass('on');
            setTimeout(function(){
            	$('a.ddbtn').parent().removeClass('on');
            }, 300);
        }
    });

});