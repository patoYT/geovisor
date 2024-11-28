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
		<label for="squareSelect">Fecha del accidente: <?php echo date("d-m-Y") ?></label>
	</div>

	<div class="form-group">
		<label for="squareSelect">¿Donde fue el accidente?</label>
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
			<label for="pillSelect">Tipo de choque</label>
			<select class="form-control input-pill" id="pillSelect">
				<option value="">Seleccione...</option>
				<?php
				foreach ($tipo_choques as $tipo_choque) {
					echo "<option value='" . $tipo_choque['id_tipo_choque'] . "'>" . $tipo_choque['nombre_tipo_choque'] . "</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="pillSelect">Subtipo de choque</label>
			<select class="form-control input-pill" id="pillSelect">
				<option value="">Seleccione...</option>
				<?php
				foreach ($subtipo_choques as $subtipo_choque) {
					echo "<option value='" . $subtipo_choque['id_subtipo_choque'] . "'>" . $subtipo_choque['nombre_subtipo_choque'] . "</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="pillSelect">Clase vehiculos</label>
			<select class="form-control input-pill" id="pillSelect">
				<option value="">Seleccione...</option>
				<?php
				foreach ($clase_vehiculos as $clase_vehiculo) {
					echo "<option value='" . $clase_vehiculo['id_clase_vehiculo'] . "'>" . $clase_vehiculo['nombre_clase_vehiculo'] . "</option>";
				}
				?>
			</select>
		</div>
		<div>
			<label for="pillSelect">Añade imagenes</label>
			<input class="form-control" type="file" id="formFileMultiple" multiple>
		</div>

		<div class="form-group">
			<label for="solidSelect">¿Hubo lesionados?</label>
			<select class="form-control input-solid" id="solidSelect">
				<option>Seleccione...</option>
				<option>SI</option>
				<option>NO</option>
			</select>
		</div>
		<!-- <div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
			<label class="form-check-label" for="flexCheckChecked">
				¿Hubo lesionados?
			</label>
		</div> -->
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text">Observaciónes</span>
				<textarea class="form-control" aria-label="With textarea"></textarea>
			</div>
		</div>
	</div>
</div>