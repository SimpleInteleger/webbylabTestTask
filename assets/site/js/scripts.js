$(document).ready(function(){
	var href="";
		$(".pop_up_message_js").click(function(){
		$(this).css("display","none");
	});
	$(".del_hrefs a").click(function(e){
	
		e.preventDefault();
		$(".pop_up_choice").css("display","block");
		href=$(this).attr("href");
	
	});
	$("#yes_button").click(function(e){
		$(".pop_up_choice").css("display","none");
		window.location.href=href;
		
		});
	$("#no_button").click(function(e){
		$(".pop_up_choice").css("display","none");
		});
});	