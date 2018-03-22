$ = jQuery.noConflict();


$(document).ready(function() {

	// OBTENER LA URL DE ADMIN-AJAX.PHP
	// console.log(url_eliminar.ajaxurl);

	$('.borrar_registro').on('click', function(event){
		event.preventDefault();

		var id = $(this).attr('data-reservaciones');

		swal({
		  	title: '¿ Estas seguro ?',
		  	text: "Esta accion no se puede revertir",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Si, Eliminar!',
		  	cancelButtonText: 'Cancelar'
		}).then((result) => {
		  	if (result.value) {
				$.ajax({
					type: 'post',
					data: {
						'action' : 'lapizzeria_eliminar',
						'id' : id,
						'tipo' : 'eliminar'
					},
					url: url_eliminar.ajaxurl,
					success: function(data){
						var resultado = JSON.parse(data);
						if(resultado.respuesta == 1){
							swal(
							  	'Eliminado!',
							  	'La reservacion se ha eliminado!',
							  	'success'
							)
							jQuery("[data-reservaciones='"+ resultado.id +"']").parent().parent().remove();
						}
					},
					
				});
			}
		})

	});

});