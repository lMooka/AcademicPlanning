function MostraErro(msg) {

	var errorstr = "<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>x</button><strong>"+msg+"</strong></div>";
	$(errorstr).appendTo($("#errors")).hide().fadeIn('slow',function(){
		window.location = '#errors';
		$(this).delay(5500).fadeOut('slow',function(){
			$(this).delay(1000).remove();
			
		});
		
	});
}