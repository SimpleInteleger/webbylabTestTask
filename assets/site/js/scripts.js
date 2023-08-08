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
	$( "#add" ).on( "submit", function( event ) {
		
		if($("#name").val().includes("  ")  ||  $("#actors").val().includes("  ") ){
			event.preventDefault();
			if($("#name").val().includes("  ")) 
			{
				if($("#actors").val().includes("  ")) $("#info_error h2").html("input name and actors have too many spaces");
				else $("#info_error h2").html("input name have too many spaces");
			}
			else $("#info_error h2").html("input actors have too many spaces");
			$("#info_error").css("display","block");
			}else{
			$("#info_error").css("display","none;");
		}
		
	} );
});	