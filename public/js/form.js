
$(document).ready(function() {

	// $('#contact-form .form-control').each(function(){
	// 	$(this).attr('required', false);
	// });

	$("#contact-form").submit(function(e) { //Validation du formulaire
		e.preventDefault();

		$.ajax({
			url: "php/send_mail.php",
			type: "POST",
			data: $("#contact-form").serialize(), // Assemble tous les champs du formulaire pour envoyer le contenu
			dataType: 'json',

			success: function(json) { // Affiche une alerte Bootstrap
				console.log(json);
				$("#reponse").removeClass();
				if(json.formValid){
					if (json.mailSend){
						$("#reponse").addClass("alert alert-success");
						$("#reponse").html("Le message a été envoyé avec succès.");
						const element =  document.querySelector('#contact-form');
						element.classList.add('animated', 'zoomOut');
					}
					else {
						$("#reponse").addClass("alert alert-danger");
						$("#reponse").html("Le message n'a pas pu être envoyé.");
						const element =  document.querySelector('#contact-form');
						element.classList.add('animated', 'tada');	
					}	
				}
				else {
					var impErrors = '';
					for (var i = 0; i < json.errors.length; i++) {
						if (i!=0){
							impErrors += '<br>';
						}
						impErrors += json.errors[i];
					}
					$("#reponse").addClass("alert alert-danger");
					$("#reponse").html(impErrors);
					const element =  document.querySelector('#contact-form');
					element.classList.add('animated', 'tada');
				}
			},

			error: function(response, status, error) {
                console.log('=== ajax error ===');
                console.log('-> error :');
                console.log(error);
                console.log('=====Martin\'Style=======');
			}
		});
	});			
});
