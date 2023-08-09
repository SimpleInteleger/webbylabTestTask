$(document).ready(function(){
	var href="";
	$(".pop_up_message_js").click(function(){
		$(this).css("display","none");
	});
	$(".del_hrefs a.btn-danger").click(function(e){
		
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
	$("a.page-link").click(function(event){
		event.preventDefault();
		var url=$(location).attr('href');
		if(url.indexOf("?")!=-1)
		{
			var params=url.split("?");
			if(url.indexOf("&")!=-1)
			{
			var params_array=params[1].split("&");
				var param_array=[];
				var param_exist=false;
				for (let i = 0;i < params_array.length; i++) {
					param_array = params_array[i].split("=");
					if(param_array[0] == "pg"){
						param_exist=true;
						param_array[1] = $(this).attr("href");
						params_array[i]=param_array.join("=");
					}
				}
				
				params[1]=params_array.join("&");
				url=params.join("?");
				
				if (param_exist)
				{
					window.location.href=url;
				}
				else
				{
					url=url+"&pg="+$(this).attr("href");
					window.location.href=url;
				}
			}
			else
			{
				var param_array=[];
				var param_exist=false;
				
					param_array = params[1].split("=");
					if(param_array[0] == "pg"){
						param_exist=true;
						param_array[1] = $(this).attr("href");
						params[1]=param_array.join("=");
					}
				url=params.join("?");
				
				if (param_exist)
				{
					window.location.href=url;
				}
				else
				{
					url=url+"&pg="+$(this).attr("href");
					window.location.href=url;
				}
			}
			
		}
		else
		{
			url=url+"?pg="+$(this).attr("href");
			window.location.href=url;
		}
		
		} );
});	