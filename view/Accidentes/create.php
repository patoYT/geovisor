<!-- Fecha del accidente
✓ Dirección – coordenadas Accidente.
✓ Clase vehículos involucrados:Automóvil, bus, buseta, camión,
camioneta, campero, microbús, tractocamión, volqueta,
motocicleta, bicicleta, motocarro, cuatrimoto.
✓ Tipo de choque:
▪ Colisión entre vehículos (carro con carro, carro con moto,
bus con bicicleta, etc.).
▪ Colisión con objeto fijo (poste, señal de tránsito, árbol,
etc.).
▪ Atropello (peatón, animal).
▪ volcamiento.
▪ Otro (con espacio para especificar).
✓ Imagen. (Formato JPG, JPEG, PNG).
✓ Lesionados.(Abarca cualquier persona que haya sido afectada
físicamente en un accidente, ya sea un peatón, conductor,
pasajero u ocupante de un vehículo).
✓ Observación. (Espacio para colocar información relevante del
accidente reportado). -->

<div class="container">

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
			<input class="form-control btn-round" type="file" id="formFileMultiple" multiple>
		</div>

		<div class="form-group">
			<label for="solidSelect">¿Hubo lesionados?</label>
			<select class="form-control input-solid" id="solidSelect">
				<option>Seleccione...</option>
				<option>SI</option>
				<option>NO</option>
			</select>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
			<label class="form-check-label" for="flexCheckChecked">
				¿Hubo lesionados?
			</label>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text">Observaciónes</span>
				<textarea class="form-control" aria-label="With textarea"></textarea>
			</div>
		</div>
		<div class="mt-5">
			<input type="submit" value="Enviar" class="btn btn-success btn-round">
		</div>
	</div>
</div>