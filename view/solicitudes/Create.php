<div class="container">

	<div class="form-group">
		<label for="squareSelect">Fecha de la solicitud: <?php echo date("d-m-Y") ?></label>
	</div>


	<div class="form-group">
		<label for="pillSelect" >¿Que solicitud desea?</label>
		<select class="form-control input-pill" id="tipoSolicitud" name="tipoSolicitud">
			<option value="">Seleccione...</option>
			<option value="Accidente" data-url="<?php echo getUrl('Accidentes', 'Accidentes', 'getCreate', false, 'ajax'); ?>">Accidente</option>
			<option value="Señalizaciones" data-url="<?php echo getUrl('Señalizacion', 'Señalizacion', 'getCreate', false, 'ajax'); ?>">Señalizaciones viales</option>
			<option value="reductores" data-url="<?php echo getUrl('Reductores', 'Reductores', 'getCreate', false, 'ajax'); ?>">Reductores</option>
			<option value="via_publica" data-url="<?php echo getUrl('Vial', 'Vial', 'getCreate', false, 'ajax'); ?>">vía pública en mal estado</option>
			<option value="pqrs" data-url="<?php echo getUrl('Pqrs', 'Pqrs', 'getCreate', false, 'ajax'); ?>">PQRS</option>
		</select>
	</div>

	<div id="formulario-dinamico"> 
		<p class="text-center">Por favor Seleccione una Opcion...</p>
	</div>


</div> 