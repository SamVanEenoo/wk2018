$(document).ready(function () {

	$("#signupBtn").on('click', function (e) {

		firstName = $("input[name='firstName']").val();
		lastName = $("input[name='lastName']").val();
		email = $("input[name='email']").val();
		password1 = $("input[name='password1']").val();
		password2 = $("input[name='password2']").val();

		post_data = {
			'firstName' : firstName,
			'lastName' : lastName,
			'email' : email,
			'password1' : password1
		};

		$.post('php/signup.php', post_data, function(response){
			$("#message").html(response.message);
			$('#messageModal').css('display','block');
		}, 'json');



		e.preventDefault();
		return false;
	});

	$("#close-modal").on('click', function (e) {
		$('#messageModal').css('display','none');
	});

	function scorePassword(pass) {
	    var score = 0;
	    if (!pass)
	        return score;
	    var letters = new Object();
	    for (var i=0; i<pass.length; i++) {
	        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
	        score += 5.0 / letters[pass[i]];
	    }

	    if(pass.length >= 8){
	    	score += 2.5;
	    }else if(pass.length >= 12){
	    	score += 5.0;
	    }

	    var variations = {
	        digits: /\d/.test(pass),
	        lower: /[a-z]/.test(pass),
	        upper: /[A-Z]/.test(pass),
	        nonWords: /\W/.test(pass),
	    }

	    variationCount = 0;
	    for (var check in variations) {
	        variationCount += (variations[check] == true) ? 1 : 0;
	    }
	    score += (variationCount-1) * 10;

	    if(score > 100){
	    	score = 100;
	    }

	    return parseInt(score);
	}



    $("#password1").on("keypress keyup keydown", function() {
        var pass = $(this).val();

        if(scorePassword(pass) >= 75){
        	$("#passwordbackground4").html("Strong");
        	$("#passwordscore3").css("display","none");
        }else if(scorePassword(pass) >= 50){
        	$("#passwordbackground4").html("OK");
        	$("#passwordscore2").css("display","none");
        	$("#passwordscore3").css("display","none");
        }

        if(scorePassword(pass) < 50){
        	$("#passwordbackground4").html("Weak");
        	$("#passwordscore2").css("display","block");
        	$("#passwordscore3").css("display","block");
        }else if(scorePassword(pass) < 75){
        	$("#passwordbackground4").html("OK");
        	$("#passwordscore3").css("display","block");
        }
        	
        var color = parseInt(scorePassword(pass)*1.45);
    });


	$("#loginBtn").on('click', function (e) {

		email = $("input[name='loginEmail']").val();
		password = $("input[name='loginPassword']").val();

		post_data = {
			'email' : email,
			'password' : password
		};

		$.post('php/login.php', post_data, function(response){
			if(response.status == "true"){
    			location.reload();
			}else{
				$("#message").html(response.msg);
				$('#messageModal').css('display','block');
			}
		}, 'json');



		e.preventDefault();
		return false;
	});
	
});