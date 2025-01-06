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

	<h1>Holaaa el id del usuario es <?php echo $_SESSION["id"] ?></h1>

	<form action="<?php echo getUrl('Reductores', 'Reductores', 'postCreate', false, 'ajax'); ?>" id="formreduc" method="post">
		<div class="form-group">
			<label for="pillSelect">Tipo de solicitud</label>
			<select class="form-control input-pill" name="estadoSeñalizacion" method="post">
				<option value="">Seleccione...</option>
				<option value="nuevo">Nuevo</option>
				<option value="reparacion">Reparacion</option>
			</select>
		</div>

		<div class="form-group" id="grupoTipoDano" style="display: none;">
			<label for="pillSelect">Tipo de daño</label>
			<select class="form-control input-pill" name="tipoDaño">
				<option value="">Seleccione...</option>
				<?php
				foreach ($tipos_de_daño as $tipo_daño) {
					echo "<option value='" . $tipo_daño['id_tipo'] . "'>" . $tipo_daño['nombre_tipo'] . "</option>";
				}
				?>
			</select>
		</div>


		<div class="form-group">
			<label for="pillSelect">Categoria de reductor</label>
			<select class="form-control input-pill" name="cate_reductor">
				<option value="">Seleccione...</option>
				<?php
				foreach ($categoria_reductores as $categoria_reductor) {
					echo "<option value='" . $categoria_reductor['id_cr'] . "'>" . $categoria_reductor['nombre_reductor'] . "</option>";
				}
				?>
			</select>
		</div>


		<div class="form-group">
			<label for="pillSelect">Tipo reductor</label>
			<select class="form-control input-pill" name="tipo_reductor">
				<option value="">Seleccione...</option>
				<?php
				foreach ($tipo_reductores as $tipo_reductor) {
					echo "<option value='" . $tipo_reductor['id_tr
'] . "'>" . $tipo_reductor['nombre_tipo'] . "</option>";
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="squareSelect">¿Cual es la ubicacion?</label>
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



			<div>
				<label for="pillSelect">Añade imagenes</label>
				<input class="form-control btn-round" type="file" id="formFileMultiple" multiple>
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
					<textarea class="form-control" aria-label="With textarea" name="observaciones"></textarea>
				</div>
			</div>

			<div class="mt-5">
				<input type="submit" value="enviar" class="btn btn-success btn-round">
			</div>
		</div>
	</form>
</div>