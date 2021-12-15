<?php
	
	class vueCentraleAdherent
	{
		public function __construct()
		{
			
		}
		
		public function visualiserAdherent($message)
		{		
			$listeAdherent=explode("|",$message);
			
			echo '<br><table class="table table-striped table-bordered table-sm ">
		 			<thead>
		 				<tr>
		 					<th scope="col">Nom</th>
		 					<th scope="col">Prenom</th>
		 					<th scope="col">Age</th>
		 					<th scope="col">Sexe</th>	
		 				</tr>
		 			</thead>
		 			<tbody>';
		 	$nbE=0;
		 	while ($nbE<sizeof($listeAdherent))
		 	{	
		 		$i=0;
		 		while (($i<4) && ($nbE<sizeof($listeAdherent)))
		 		{
		 			echo '<td scope>';
		 			echo trim($listeAdherent[$nbE]);
		 			$i++;
		 			$nbE++;
		 			echo '</td>';
		 		}
		 		echo '</tr>';
		 	}
		 	echo '</tbody>';
		 	echo '</table>';
			
		}
		
		public function saisirAdherent($liste){
			echo('
			<form action=index.php?vue=Adherent&action=enregistrer method=POST align=center>
			<legend>Caractéristiques de l\'adhérent :</legend>
			<table class="table table-bordered table-sm table-striped">
				<tr>
					<td>Nom de l\'adhérent :</td>
					<td scope><input type="text" name="nomAdherent" id="nomAdherent" required="true"> </td>
					<td>Prénom de l\'adhérent :<td>
					<td scope><input type="text" name="prenomAdherent" id="prenomAdherent" required="true"> </td>
				</tr>
				<tr>
					<td>Âge :</td>
					<td><input type="number" name="ageAdherent" id="ageAdherent" required=true></td>
					<td>Sexe :</td>
					<td>
						<select name="sexeAdherent" id="sexeAdherent">
							<option value="F">Femme</option>
							<option value="H">Homme</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>');
			echo($liste);
			echo('
					</td>
				</tr>
						
				<tr>
					<td>Login :</td>
					<td scope><input type="text" name="loginAdherent" id="loginAdherent" required="true"> </td>
					<td>Mot de passe :</td>
					<td scope><input type="password" name="passwordAdherent" id="passwordAdherent" required="true"> </td>
				</tr>

				<tr>
					<td><button type="submit" class="btn btn-primary">Valider</button></td>
				</tr>
			</table>
			</form>');			
		}


		public function voyagerAdherent()
		{		
			echo '<iframe width=100% height=150% src="https:www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.319959224129!2d1.3158100143582203!3d43.683111158516006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aeaee6224c0f13%3A0x9f57b169fe3a7161!2sMairie!5e0!3m2!1sfr!2sfr!4v1626195896682!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
				
		}
		
	public function voirProfil($adherent){

			echo "
			PLACEHOLDER POUR LA PHOTO
			<table>
			<tr>
			<td>Nom</td>
			<td>".$adherent->getNomAdherent()."</td>
			</tr>
			<tr>
			<td>Prénom</td>
			<td>".$adherent->getPrenomAdherent()."</td>
			</tr>
			<tr>
			<td>Âge</td>
			<td>".$adherent->getAgeAdherent()."</td>
			</tr>
			<tr>
			<td>Sexe</td>
			<td>".$adherent->getSexeAdherent()."</td>
			</tr>
			<tr>
			<td>Login</td>
			<td>".$adherent->getLoginAdherent()."</td>
			</tr>
			</table>";
		}

	public function modifierAdherent(){

	}

	public function modifierProfil($adherent){
		//incorpore ça idiot <form action=index.php?vue=Entraineur&action=SaisirEntraineur method=POST align=center>

		echo "PLACEHOLDER POUR LA PHOTO
			<form action=index.php?vue=Adherent&action=EnregistrerProfil method=POST align=center>
			<table>
			<tr>
			<td>Nom</td>
			<td><input type='text' name='nomAdherent' value=".$adherent->getNomAdherent()." required='true'>
			</tr>
			<tr>
			<td>Prénom</td>
			<td><input type='text' name='prenomAdherent' value=".$adherent->getPrenomAdherent()." required='true'>
			</tr>
			<tr>
			<td>Âge</td>
			<td><input type='text' name='ageAdherent' value=".$adherent->getAgeAdherent()." required='true'>
			</tr>
			<tr>
			<td>Sexe</td>
			<td><select name='sexeAdherent' required='true'>
			<option value=".$adherent->getSexeAdherent().">
			<option value='F'>Femme</option>
			<option value='H'>Homme</option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Login</td>
			<td><input type='text' name='loginAdherent' value=".$adherent->getLoginAdherent()." required='true'>
			</tr>
			<input type='hidden' name='idAdherent' value=".$adherent->getIdAdherent().">
			</table>
			<button type='submit' class='btn btn-primary'>Valider</button>
			</form>";
	}

	public function changerMDP($erreur=false){
		if($erreur){
			echo "<p style='color:red'>Le mot de passe ne respecte pas les règles de construction de mot de passe !</p>";
		}
		echo "<form action=index.php?vue=Adherent&action=verifMDP method=POST align=center>
		<table style='margin-top:1em'>
		<tr>
		<td>Veuillez saisir le nouveau mot de passe :</td>
		<td><input type='password' name='MDP' value='' required='true'></td>
		<td><button style='margin-left:1em' type='submit' class='btn btn-primary'>Valider</button>
		</tr>
		</table>
		<h5 style='text-align:left;font-size:1em;margin-top:1em;'>Le mot de passe doit contenir :</h5>
		<ul style='text-align:left;font-size:0.95em'>
		<li>Au moins 12 caractères</li>
		<li>Au moins 1 lettre minuscule</li>
		<li>Au moins 1 lettre majuscule</li>
		<li>Au moins 1 chiffre</li>
		<li>Au moins 1 caractère spécial</li>
		</ul>"
		;
	}

	public function confirmationChangement(){
		echo "Le changement a été effectué.";
	}	
	
}
?>
