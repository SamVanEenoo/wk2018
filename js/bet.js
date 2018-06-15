$(document).ready(function(){
	
  $(".btn-bet").click(function(){
	var wedstrijdid = $(this).attr("wedstrijd-id");
	var oddid = $(this).attr("odd-id");
	
	post_data = {
	  'action-type' 	: 'add-bet',
	  'wedstrijdid' 	: wedstrijdid,
	  'oddid' 			: oddid
	};
	
	$.post('php/bet.php', post_data, function(response){
	  if(response.type == 'success'){
		$("#odd1-" + response.wid).removeClass("btn-selected");
		$("#oddx-" + response.wid).removeClass("btn-selected");
		$("#odd2-" + response.wid).removeClass("btn-selected");
		$("#" + response.oddid + "-" + response.wid).addClass("btn-selected");
	  }else if(response.type == 'info'){
		$("#message").show();
		$("#message").html(response.txt);
		$("#message").removeClass( "hidden" );
		$('html, body').animate({ scrollTop: 0 }, 0);
		$("#message").delay( 5000 ).fadeOut();
	  }
	}, 'json');
  });

  $(".btn-paid").click(function(){
	var userid = $(this).attr("userid");
	
	post_data = {
	  'userid' 			: userid
	};
	
	$.post('php/paid.php', post_data, function(response){
	  if(response.type == "success"){
    	window.location.href = 'registered.php';
	  }
	}, 'json');
  });

  	$("#logout").on('click', function (e) {
  		e.preventDefault();
		$.get('php/logout.php', function(response){
    		location.reload();
		}, 'json');

	});

});