	<?php

	class vueCentraleEntraineur
	{
		public function __construct()
		{
		}

		public function ajouterEntraineur()
		{
			echo '<form action=index.php?vue=Entraineur&action=SaisirEntraineur method=POST align=center>
							<fieldset>
							<legend>L\'entraineur est un : </legend>
							<input type="radio" name="typeEntraineur" value="Vacataire" id="vacataire">
							<label for="vacataire">Vacataire</label> <br/>

							<input type="radio" name="typeEntraineur" value="Titulaire" id="titulaire">
							<label for="titulaire">Titulaire</label> <br/>

							
							
							<button type="submit" class="btn btn-primary">Valider</button>
							</fieldset>	
						  </form>';
		}
		public function typeEntraineur()
		{
			echo '<form action=index.php?vue=Entraineur&action=modifier method=POST align=center>
							<fieldset>
							<legend>L\'entraineur est un : </legend>
							<input type="radio" name="typeEntraineur" value="Vacataire" id="vacataire">
							<label for="vacataire">Vacataire</label> <br/>

							<input type="radio" name="typeEntraineur" value="Titulaire" id="titulaire">
							<label for="titulaire">Titulaire</label> <br/>

							
							
							<button type="submit" class="btn btn-primary">Valider</button>
							</fieldset>	
						  </form>';
		}

		public function modifierEntraineur($message, $typeEntraineur)
		{
			echo '<form action=index.php?vue=Entraineur&action=choixFaitPourModif method = GET>';
			echo $message;
			echo ' <input type=hidden name=vue value=Entraineur></input>
				   <input type=hidden name=action value=choixFaitPourModif></input>
				   <input type=hidden name=typeEntraineur value=' . $typeEntraineur . '>
				   <button type="submit" class="btn btn-primary">Valider</button>
				  </form>
			';
		}

		public function modifierSpeEntraineur($liste_specialites, $nbSpes)
		{	# À modifier ?
			echo '<form action=index.php?vue=Entraineur&action=verifModifSesSpecialites method = POST>';
			for ($i = 1; $i <= $nbSpes; $i++) {
				echo "<p>Spécialité $i</p><Select name='spe$i'>";
				echo $liste_specialites;
				echo "</select>";
			}
			echo "<input type='hidden' name='nbSpes' value=$nbSpes>";
			echo '<button type="submit" class="btn btn-primary">Valider</button>
				  </form>';
		}

		public function choixFaitPourModifTitulaire($idEntraineur, $nom, $date, $login, $pswd, $choix, $lesSpesEntraineur, $listeSpesHTML, $nbSpes = 3)
		{
			echo '<form action=index.php?vue=Equipe&action=EnregModif method = GET>
						<input type=text name=nomEntraineur value=' . $nom . '></input>
						<input type=text name=dateEmbauche value=' . $date . '></input>
						<input type=text name=loginEntraineur value=' . $login . '></input>
						<input type=password name=pwdEntraineur value=' . $pswd . '></input>';
			for ($i = 0; $i < $nbSpes; $i++) {
				echo ' 		<label for="spe-selection">Choisissez une spécialité : </label>			
							<select name="spe' . $i . '" id="spe-selection">';
				if (isset($lesSpesEntraineur[$i])) {
					echo '<option value="' . $lesSpesEntraineur[$i]->getIdSpe() . '">' . $lesSpesEntraineur[$i]->getNomSpe() . '</option>';
				}
				echo ($listeSpesHTML);
				echo '</select></br>';
			}
			echo '<input type=hidden name=idEntraineur value=' . $choix . '></input>	
						<input type=hidden name=vue value=Entraineur></input>
						<input type=hidden name=idEntraineur value=' . $idEntraineur . '></input>
						<input type=hidden name=action value=EnregModif></input>
						<input type=hidden name=nbSpes value=' . $nbSpes . '>
						<button type="submit" class="btn btn-primary">Valider</button>
			 </form>';
		}
		public function choixFaitPourModifVacataire($idEntraineur, $nom, $tel, $login, $pswd, $choix, $lesSpesEntraineur, $listeSpesHTML, $nbSpes = 3)
		{
			echo '<form action=index.php?vue=Equipe&action=EnregModif method = GET>
						<input type=text name=nomEntraineur value=' . $nom . '></input>
						<input type=text name=telephoneVacataire value=' . $tel . '></input>
						<input type=text name=loginEntraineur value=' . $login . '></input>
						<input type=password name=pwdEntraineur value=' . $pswd . '></input>';
			for ($i = 0; $i < $nbSpes; $i++) {
				echo ' 		<label for="spe-selection">Choisissez une spécialité : </label>			
										<select name="spe' . $i . '">';
				if (isset($lesSpesEntraineur[$i])) {
					echo '<option value="' . $lesSpesEntraineur[$i]->getIdSpe() . '">' . $lesSpesEntraineur[$i]->getNomSpe() . '</option>';
				}
				echo ($listeSpesHTML);
				echo '</select></br>';
			}
			echo '<input type=hidden name=idEntraineur value=' . $choix . '></input>	
						<input type=hidden name=vue value=Entraineur></input>
						<input type=hidden name=action value=EnregModif></input>
						<input type=hidden name=id value=' . $idEntraineur . '></input>
						<input type=hidden name=nbSpes value=' . $nbSpes . '>
						<button type="submit" class="btn btn-primary">Valider</button>
			 </form>';
		}

		public function visualiserEntraineur($liste)
		{
			$listeEntraineur = explode("|", $liste);

			echo '<div class="ascenseur">
					<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nom</th>
							<th scope="col">Login</th>
							<th scope="col">Spécialité(s)</th>
							<th scope="col">Date ou Téléphone</th>
						</tr>
					</thead>
					<tbody>';
			$nbE = 0;
			while ($nbE < sizeof($listeEntraineur)) {
				$i = 0;
				echo '<tr>';
				while (($i < 5) && ($nbE < sizeof($listeEntraineur))) {
					echo '<td scope>';
					echo trim($listeEntraineur[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			echo '</div>';
		}
		public function saisirEntraineur()
		{
			$typeEntraineur = htmlspecialchars($_POST['typeEntraineur']);

			echo '<form action=index.php?vue=Entraineur&action=enregistrer method=POST>';

			switch ($typeEntraineur) {
				case 'Vacataire':
					echo '<legend>Information du Vacataire</legend>
							
							<table class="table table-bordered table-sm table-striped">
								<thead>
									<tr>
									  <th scope="col">Téléphone</th>
									  <th scope="col">Nom</th>
									  <th scope="col">Login</th>
									  <th scope="col">Password</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									  <td scope>
										<input type="text" name="numTelVacataire" id="NumTel" required="true">
									  </td>
									  <td>
										<input type=text name=nomEntraineur id=nomEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=loginEntraineur id=loginEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=pwdEntraineur id=pwdEntraineur required=true>
									  </td>
									</tr>
									<tr colspan=5>
									  <input type=hidden name=typeEntraineur value=' . $typeEntraineur . '>
									  <button type="submit" class="btn btn-primary">Valider</button>
									</tr>
								</tbody>
							</table>
							
					</form>';
					break;

				case 'Titulaire':
					echo '
					
						<legend>Information du Titulaire</legend>
												
							<table class="table table-bordered table-sm table-striped">
								<thead>
									<tr>
									  <th scope="col">Date Entrée</th>
									  <th scope="col">Nom</th>
									  <th scope="col">Login</th>
									  <th scope="col">Password</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									  <td scope>
										<input type="text" name="dateEmbaucheTitulaire" id="dateEmbaucheTitulaire" required="true">
									  </td>
									  <td>
										<input type=text name=nomEntraineur id=nomEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=loginEntraineur id=loginEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=pwdEntraineur id=pwdEntraineur required=true>
									  </td>
									</tr>
									<tr colspan=5>
									  <input type=hidden name=typeEntraineur value=' . $typeEntraineur . '>
									  <button type="submit" class="btn btn-primary">Valider</button>
									</tr>
								</tbody>
							</table>
							
					</form>';
					break;
			}
		}

		public function voirSesSpes($spe)
		{
			echo ("Vous avez les spécialités suivantes : ");
			foreach ($spe as $uneSpe) {
				echo ('</br>- ' . $uneSpe->getNomSpe() . '');
			}
		}

		public function modifierProfilEntraineur($statut, $profil, $listeSpesHTML, $nbSpes = 3) //param titulaire + infos du profil
		{
			//echo ($profil);
			$profil = explode('|', $profil);
			//echo($profil[0]);
			$spe = explode(',', $profil[3]);
			switch ($statut) {
				case "titulaire":
					echo '
				<form action=index.php?vue=Entraineur&action=EnregModif method=POST>
					<legend>Votre profil :</legend>
					<table>
						<tr>
							<td>Date Entrée</td>
							<td><input type="text" name="dateEmbaucheTitulaire" id="dateEmbaucheTitulaire" value=' . $profil[4] . ' required="true"></td>
						</tr>
						<tr>
							<td>Nom</td>
							<td>
								<input type=text name=nomEntraineur id=nomEntraineur value=' . $profil[1] . ' required=true>
							</td>
						</tr>
						<tr>
						<td>Login</td>
						<td>
						<input type=text name=loginEntraineur id=loginEntraineur value=' . $profil[2] . ' required=true>
						
						</td>
						</tr>
					</table>
					<input type=hidden name=typeEntraineur value="titulaire">
					<input type=hidden name=idEntraineur value=' . $profil[0] . '>
					<button type="submit" class="btn btn-primary">Valider</button>
				</form>';

					break;

				case "vacataire":
					echo '
					<form action=index.php?vue=Entraineur&action=EnregModif method=POST>
						<legend>Votre profil :</legend>
						<table>
							<tr>
								<td>Numéro</td>
								<td><input type="text" name="numTelVacataire" id="numTelVacataire" value=' . $profil[4] . ' required="true"></td>
							</tr>
							<tr>
								<td>Nom</td>
								<td><input type=text name=nomEntraineur id=nomEntraineur value=' . $profil[1] . ' required=true></td>
							</tr>
							<tr>
								<td>Login</td>
								<td><input type=text name=loginEntraineur id=loginEntraineur value=' . $profil[2] . ' required=true></td>
							</tr>
						</table>';
						for ($i = 1; $i <= $nbSpes; $i++) {
							echo '<label for="spe-selection">Choisissez une spécialité</label>
														<select name="spe' . $i . '" id="spe' . $i . '">';
							if (isset($spe[$i])) {
								echo '<option value="' . $spe[$i] . '">Choisissez une spécialité</option>';
							} else {
								echo '<option value="0">Indéfinie</option>';
							}
							echo ($listeSpesHTML);
						}
						echo '</select>
						<input type=hidden name=statut value="vacataire">
						<input type=hidden name=idEntraineur value=' . $profil[0] . '>
						<button type="submit" class="btn btn-primary">Valider</button>
					</form>';
					break;
				default:
					echo ('erreur !');
					break;
			}
		}
		public function changerMDP($erreur = false)
		{
			if ($erreur) {
				echo "<p style='color:red'>Le mot de passe ne respecte pas les règles de construction de mot de passe !</p>";
			}
			echo "<form action=index.php?vue=Entraineur&action=verifMDP method=POST align=center>
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
			</ul>";
		}
	}
