

<title>formulaire PRATICIEN</title>

<div name="droite" style="float: left; width: 80%;">
	<div name="bas"
		style="margin: 10 2 2 2; clear: left; background-color: 77AADD; color: white; height: 88%;">
		<h1>Praticiens</h1>
		<form name="formListeRecherche">
			<select name="select" id="selectMed"
				onChange="javascript:location.href = this.value;">
		
		<?php
		if (! isset ( $_REQUEST ['practicien'] )) {
			echo '<option value=0> { Sélectionner un médicament } </option>';
		} else {
			echo '<option value=0>' . $lePracticien ['PRA_NOM'] . ' ' . $lePracticien ['PRA_PRENOM'] . '</option>';
		}
		foreach ( $lesMedicaments as $unMedicament ) {
			if ($unPracticien ['PRA_NUM'] != $lePracticien ['PRA_NUM']) {
				echo '
			<option value=index.php?uc=consulter&action=formPrac&practicien=' . $unMedicament ['MED_DEPOTLEGAL'] . '>' . $unMedicament ['MED_NOMCOMMERCIAL'] . '</option>';
			}
		}
		
		if (isset ( $_REQUEST ['practicien'] )) {
			?>
	</select>

		</form>
		<table style="color:white; border-color:white;" border='1'>
			<caption>Informations concernant <?php  echo $lePracticien ['PRA_NOM'].' '.$lePracticien ['PRA_PRENOM']?></caption>
			<tr>
				<th>Numéro </th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Adresse</th>
				<th>Ville</th>
				<th>CP</th>
			</tr>

			<tr>
				<td> <?php echo $lePracticien['PRA_NUM'] ?></td>
				<td><?php echo $lePracticien['PRA_NOM'] ?></td>
				<td><?php echo $lePracticien['PRA_PRENOM'] ?></td>
				<td><?php echo $lePracticien['PRA_ADRESSE'] ?></td>
				<td><?php echo $lePracticien['PRA_CP'] ?></td>
				<td><?php echo $lePracticien['PRA_VILLE'] ?></td>

			</tr>
	<?php
		}
		?>
			</div>
			</div>