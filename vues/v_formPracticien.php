

<title>formulaire PRATICIEN</title>

<div name="droite" style="float: left; width: 80%;">
	<div name="bas"
		style="margin: 10 2 2 2; clear: left; background-color: 77AADD; color: white; height: 88%;">
		<h1>Praticiens</h1>
		<form name="formListeRecherche">
			<select name="select" id="selectPrac"
				onChange="javascript:location.href = this.value;">
		
		<?php
		if (! isset ( $_REQUEST ['practicien'] )) {
			echo '<option value=0> { Sélectionner un practicien } </option>';
		} else {
			echo '<option value=0>' . $lePracticien ['nom'] . ' ' . $lePracticien ['prenom'] . '</option>';
		}
		foreach ( $lesPracticiens as $unPracticien ) {
			if (! isset ( $_REQUEST ['visiteur'] ) || $unVisiteur ['id'] != $leVisiteur ['id']) {
				echo '
			<option value=index.php?uc=comptable&action=listeFraisComptable&visiteur=' . $unVisiteur ['id'] . '>' . $unVisiteur ['nom'] . ' ' . $unVisiteur ['prenom'] . '</option>';
			}
		}
		
		if (isset ( $_REQUEST ['visiteur'] )) {
			?>
	</select>
		</form>
		<form id="formPraticien"></form>
	</div>
</div>
