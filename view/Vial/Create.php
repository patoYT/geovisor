<!-- Solicitud sobre señalizaciones viales en mal estado:
Verticales/horizontales en mal estado, categoría (Reglamentaria,
Informativa, Preventiva), tipo de señal (Alto, Límite de velocidad, Ceda
el paso, Prohibido girar a la izquierda/derecha, Prohibido estacionar,
Prohibido el paso, Hospital, Zona escolar, Paradero de autobús,
Dirección única, Calle sin salida, Curva peligrosa, Reducción de carril,
Pendiente pronunciada, Cruce de peatones), descripción, tipo de daño
(Despintada, Deformada, Vandalizada), id usuario, dirección para
ubicar la señal, imagen de la señal afectada (Formato JPG, JPEG,
PNG), tipo de estados de la solicitud (Pendiente, En revisión, En
proceso, Rechazada, Completada). -->


<div class="container">


	<div class="form-group">
		<label for="squareSelect">¿Dirección de la vía pública?</label>
		<div class="form-group">
			<div class="input-group">
				<button class="btn btn-black btn-border" type="button">Ubicacion</button>
				<input
					type="text"
					class="form-control"
					placeholder=""
					aria-label=""
					aria-describedby="basic-addon1" />
			</div>
		</div>

		<div class="form-group">
			<label for="pillSelect">Tipo de daño</label>
			<select class="form-control input-pill" id="pillSelect">
				<option value="">Seleccione...</option>
				<?php
				foreach ($tipos_de_daño as $tipo_daño) {
					echo "<option value='" . $tipo_daño['id_tipo'] . "'>" . $tipo_daño['nombre_tipo'] . "</option>";
				}
				?>
			</select>
		</div>
		<div>
			<label for="pillSelect">Añade imagenes</label>
			<input class="form-control btn-round" type="file" id="formFileMultiple" multiple>
		</div>

		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text">Observaciónes</span>
				<textarea class="form-control" aria-label="With textarea"></textarea>
			</div>
		</div>
		<div class="mt-5">
			<input type="submit" value="enviar" class="btn btn-success btn-round">
		</div>
	</div>
</div>