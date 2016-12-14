<<<<<<< HEAD


<title>formulaire PRATICIEN</title>

<div name="droite" style="float: left; width: 80%;">
	<div name="bas"
		style="margin: 10 2 2 2; clear: left; background-color: 77AADD; color: white; height: 88%;">
		<h1>Rapport de visite</h1>
		<form name="formListeRecherche">
			<table>
				<tr>
					<td width="50%" align="right" style="color: white;"><label>Date de
							début: </label></td>
					<td align="left"><input type="text" class="calendrier"
						name="dateDebut" id="dateDebut" value="" required /></td>
				</tr>
				<tr>
					<td width="50%" align="right" style="color: white;"><label>Date de
							fin: </label></td>
					<td align="left"><input type="text" class="calendrier"
						name="dateFin" id="dateFin" value="" required /></td>
				</tr>
				<select name="select" id="selectPrac"
					onChange="javascript:location.href = this.value;">
		
		<?php
		if (! isset ( $_REQUEST ['practicien'] )) {
			echo '<option value=0> { Sélectionner un practicien } </option>';
		} else {
			echo '<option value=0>' . $lePracticien ['PRA_NOM'] . ' ' . $lePracticien ['PRA_PRENOM'] . '</option>';
		}
		
		foreach ( $lesPracticiens as $unPracticien ) {
			echo '
			<option value=index.php?uc=consulter&action=formPrac&practicien=' . $unPracticien ['PRA_NUM'] . '>' . $unPracticien ['PRA_NOM'] . ' ' . $unPracticien ['PRA_PRENOM'] . '</option>';
		}
		
		?>
			
			
			
			
			
			
			
			
			</table>
		</form>
	</div>
</div>