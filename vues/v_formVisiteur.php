<title>formulaire PRATICIEN</title>

<div name="droite" style="float: left; width: 80%;">
	<div name="bas"
		style="margin: 10 2 2 2; clear: left; background-color: 77AADD; color: white; height: 88%;">
		<h1>Rapport de visite</h1>
		<form name="formListeRecherche" method='POST'
			action='index.php?uc=consulter&action=formVis'>
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
				<tr>
					<select name="select" id="selectPrac">	
		<?php
		if (! isset ( $_REQUEST ['select'] )) {
			echo '<option value=0> { Sélectionner un practicien } </option>';
		} else {
			echo '<option value=0>' . $lePracticien ['PRA_NOM'] . ' ' . $lePracticien ['PRA_PRENOM'] . '</option>';
		}
		
		foreach ( $lesPracticiens as $unPracticien ) {
			if ($unPracticien ['PRA_NUM'] != $_REQUEST ['select'])
				echo '
			<option value=' . $unPracticien ['PRA_NUM'] . '>' . $unPracticien ['PRA_NOM'] . ' ' . $unPracticien ['PRA_PRENOM'] . '</option>';
		}
		
		?>
			</select>
			
			</table>
			<input type='SUBMIT' value='Valider'>
		</form>
		
		
		<?php
		
		if (isset ( $_REQUEST ['select'] )) {
			echo $_SESSION ['login'];
			echo $_REQUEST ['dateDebut'];
			echo $_REQUEST ['dateFin'];
			echo $_REQUEST ['select'];
		}
		?>
	</div>
</div>