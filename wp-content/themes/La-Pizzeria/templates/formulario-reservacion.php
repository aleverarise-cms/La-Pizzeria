<form action="" class="reserva-contacto" method="POST">
	<h2>Realiza una reservación</h2>
	<div class="campo">
		<input type="text" name="nombre" value="" placeholder="Nombre" required="">
	</div>

	<div class="campo">
		<input type="datetime-local" name="fecha" value="" placeholder="Fecha" required="">
	</div>

	<div class="campo">
		<input type="email" name="correo" value="" placeholder="Correo" required="">
	</div>

	<div class="campo">
		<input type="tel" name="telefono" value="" placeholder="Telefono" required="">
	</div>

	<div class="campo">
		<textarea name="mensaje" placeholder="Mensaje" required=""></textarea>
	</div>

	<div class="g-recaptcha" data-sitekey="6Ld-vkgUAAAAADKAafk7827z6EiCRVyGg_a-xiHW"></div>

	<input type="submit" name="enviar" value="Enviar" class="button">
	<input type="hidden" name="oculto" value="1">

</form>