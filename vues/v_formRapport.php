
<script language="javascript">
		function selectionne(pValeur, pSelection,  pObjet) {
			//active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale Ã  la valeur attendue (pValeur)
			if (pSelection==pValeur) 
				{ formRAPPORT_VISITE.elements[pObjet].disabled=false; }
			else { formRAPPORT_VISITE.elements[pObjet].disabled=true; }
		}
	</script>
<script language="javascript">
        function ajoutLigne( pNumero){//ajoute une ligne de produits/qté Ã  la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incrémente le numéro de ligne
            var laDiv=document.getElementById("lignes");	//récupÃ¨re l'objet DOM qui contient les données
			var titre = document.createElement("label") ;	//crée un label
			laDiv.appendChild(titre) ;						//l'ajoute Ã  la DIV
			titre.setAttribute("class","titre") ;			//définit les propriétés
			titre.innerHTML= "   Produit : ";
			var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
			laDiv.appendChild(liste) ;
			liste.setAttribute("name","PRA_ECH"+pNumero) ;
			liste.setAttribute("class","zone");
			//remplit la liste avec les valeurs de la premiÃ¨re liste construite en PHP Ã  partir de la base
			liste.innerHTML=formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
			var qte = document.createElement("input");
			laDiv.appendChild(qte);
			qte.setAttribute("name","PRA_QTE"+pNumero);
			qte.setAttribute("size","2"); 
			qte.setAttribute("class","zone");
			qte.setAttribute("type","text");
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }
    </script>
<form name="formRAPPORT_VISITE" method="post"
	action="index.php?uc=consulter&action=saisirRap">
	<h1>Rapport de visite</h1>
	<label class="titre">NUMERO :</label><input type="text" size="10"
		name="RAP_NUM" class="zone" /> <label class="titre">DATE VISITE :</label><input
		type="text" size="10" name="RAP_DATEVISITE" class="zone" /> <label
		class="titre">PRATICIEN :</label><select name="PRA_NUM" class="zone">
		<?php
		if (! isset ( $_REQUEST ['practicien'] )) {
			echo '<option value=0> Sélectionner un practicien </option>';
		} 
		foreach ( $lesPracticiens as $unPracticien ) {
				echo '
			<option value=' . $unPracticien ['PRA_NUM'] . '> '.$unPracticien['PRA_NOM'].' '.$unPracticien['PRA_PRENOM'].'</option>';
			
		}?></select>
	<label class="titre">COEFFICIENT :</label><input type="text" size="6"
		name="PRA_COEFF" class="zone" /> <label class="titre">REMPLACANT :</label><input
		type="checkbox" class="zone" onClick="selectionne(true,this.checked,'PRA_REMPLACANT');" /><select
		name="PRA_REMPLACANT" disabled="disabled" class="zone">
		<?php
		if (! isset ( $_REQUEST ['practicien'] )) {
			echo '<option value=0> Sélectionner un remplacant </option>';
		} 
		foreach ( $lesPracticiens as $unPracticien ) {
				echo '
			<option value=' . $unPracticien ['PRA_NUM'] . '> '.$unPracticien['PRA_NOM'].' '.$unPracticien['PRA_PRENOM'].'</option>';
			
		}?>
		</select> <label
		class="titre">DATE :</label><input type="text" size="19"
		name="RAP_DATE" class="zone" /> <label class="titre">MOTIF :</label><select
		name="RAP_MOTIF" class="zone"
		onClick="selectionne('AUT',this.value,'RAP_MOTIFAUTRE');">
		<option value="PRD">Périodicité</option>
		<option value="ACT">Actualisation</option>
		<option value="REL">Relance</option>
		<option value="SOL">Sollicitation praticien</option>
	</select> <label class="titre">BILAN :</label>
	<textarea rows="5" cols="50" name="RAP_BILAN" class="zone"></textarea>
	<label class="titre"><h3>Eléments présentés</h3></label> <label
		class="titre">PRODUIT 1 : </label><select name="PROD1" class="zone"></select>
	<label class="titre">PRODUIT 2 : </label><select name="PROD2"
		class="zone"></select> <label class="titre">DOCUMENTATION OFFERTE :</label><input
		name="RAP_DOC" type="checkbox" class="zone" checked="false" /> <label
		class="titre"><h3>Echanitllons</h3></label>
	<div class="titre" id="lignes">
		<label class="titre">Produit : </label> <select name="PRA_ECH1"
			class="zone"><option>Produits</option></select><input type="text"
			name="PRA_QTE1" size="2" class="zone" /> <input type="button"
			id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />
	</div>
	<label class="titre">SAISIE DEFINITIVE :</label><input name="RAP_LOCK"
		type="checkbox" class="zone" checked="false" /> <label class="titre"></label>
	<div class="zone">
		<input type="reset" value="annuler"></input><input type="submit"></input>

</form>