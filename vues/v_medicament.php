

<title>formulaire PRATICIEN</title>

<div name="droite" style="float: left; width: 80%;">
	<div name="bas"
		style="margin: 10 2 2 2; clear: left; background-color: 77AADD; color: white; height: 88%;">
		<h1>Médicaments</h1>
		<form name="formListeRecherche">
			<select name="select" id="selectMed"
				onChange="javascript:location.href = this.value;">
		
		<?php
		if (! isset ( $_REQUEST ['medicament'] )) {
			echo '<option value=0> { Sélectionner un médicament } </option>';
		} else {
			echo '<option value=0>' . $leMedicament ['MED_NOMCOMMERCIAL'] . '</option>';
		}
		foreach ( $lesMedicaments as $unMedicament ) {
			if ($unMedicament ['MED_DEPOTLEGAL'] != $leMedicament ['MED_DEPOTLEGAL']) {
				echo '
			<option value=index.php?uc=consulter&action=medicament&medicament=' . $unMedicament ['MED_DEPOTLEGAL'] . '>' . $unMedicament ['MED_NOMCOMMERCIAL'] . '</option>';
			}
		}
		
		if (isset ( $_REQUEST ['medicament'] )) {
			?>
	</select>

		</form>
		<table style="color: white; border-color: white;" border='1'>
			<caption>Informations concernant <?php  echo $leMedicament ['MED_NOMCOMMERCIAL']?></caption>
			<tr>
				<th>Numéro</th>
				<th>Nom</th>
				<th>Famille</th>
				<th>Composition</th>
				<th>Effets</th>
			</tr>

			<tr>
				<td> <?php echo $leMedicament['MED_DEPOTLEGAL'] ?></td>
				<td><?php echo $leMedicament['MED_NOMCOMMERCIAL'] ?></td>
				<td><?php echo $leMedicament['FAM_LIBELLE'] ?></td>
				<td><?php echo $leMedicament['MED_COMPOSITION'] ?></td>
				<td><?php echo $leMedicament['MED_EFFETS'] ?></td>
			</tr>
	<?php
		}
		?>
			</div>
			</div>