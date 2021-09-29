<?php
	
	class vueCentraleEquipe
	{
		public function __construct()
		{
			
		}
		
		public function ajouterEquipe()
			{
				echo '<form action=index.php?vue=Equipe&action=SaisirEquipe method=POST align=center>
								<fieldset>
								<legend>Voulez vous ajouter une nouvelle équipe ? </legend>			
								<button type="submit" class="btn btn-primary">Valider</button>
								</fieldset>	
							</form>';

		}
		
		public function saisirEquipe($liste){
			echo '
			<form action=index.php?vue=Equipe&action=enregistrer method=POST align=center>
				<legend>Caractéristiques de l\'équipe :</legend>
				<table class="table table-bordered table-sm table-striped">
						
							<tr>
								<td>Nom de l\'équipe :</td>
								<td scope><input type="text" name="nomEquipe" id="nomEquipe" required="true"> </td>
								<td>Capacité max</td>
								<td><input type="number" name="nbrPlaceEquipe" id="nbrPlaceEquipe" required="true"></td>
							
							</tr>
							<tr>
								<td>Âge minimal</td>
								<td><input type="number" name="ageMinEquipe" id="ageMinEquipe" required=true></td>
								<td>Âge maximal</td>
								<td><input type="number" name="ageMaxEquipe" id="ageMaxEquipe" required=true></td>
							</tr>
							
							<tr>
								<td>Équipe</td>
								<td><select name="sexeEquipe" id="sexeEquipe"><option value="F">Féminine</option><option value="H">Masculine</option></select></td>
								<td>Entraineur</td>
								<td>';
						echo $liste;
						echo '<td>	
							</tr>
						
						
							<button type="submit" class="btn btn-primary">Valider</button>
				
						
					</table>		
			</form>';
		}
		
		public function modifierEquipe($message)
		{
			echo '<form action=index.php?vue=Equipe&action=choixFaitPourModif method = GET>';
			echo $message; 
			echo ' <input type=hidden name=vue value=Equipe></input>
				   <input type=hidden name=action value=choixFaitPourModif></input>
				   <button type="submit" class="btn btn-primary">Valider</button>
				  </form>
			';
		}

		public function visualiserEquipe($message) 
		{
			echo '<form action=index.php?vue=Equipe&action=choixFaitPourVisu method = GET>';
			echo $message; 
			echo ' <input type=hidden name=vue value=Equipe></input>
				   <input type=hidden name=action value=choixFaitPourVisu></input>
				   <button type="submit" class="btn btn-primary">Valider</button>
				  </form>
			';
		}

		
	public function choixFaitPourModifEquipe($nom, $nbrPlace, $ageMin, $ageMax, $sexe, $choix,$liste)
	{
		echo '<form action=index.php?vue=Equipe&action=EnregModif method = GET>
						<input type=text name=nomEquipe value='.$nom.'></input>
						<input type=integer name=nbrPlaceEquipe value='.$nbrPlace.'></input>
						<input type=integer name=ageMinEquipe value='.$ageMin.'></input>
						<input type=integer name=ageMaxEquipe value='.$ageMax.'></input>
						<input type=text name=sexeEquipe value='.$sexe.'></input>	';
						echo $liste;
						echo '<input type=hidden name=idEquipe value='.$choix.'></input>	
						<input type=hidden name=vue value=Equipe></input>
						<input type=hidden name=action value=EnregModif></input>
						<button type="submit" class="btn btn-primary">Valider</button>
			 </form>';
	}

	public function choixFaitPourVisuEquipe($nom, $nbrPlace, $ageMin, $ageMax, $sexe, $choix,$listeEquipe) 
	{
		echo '<br><table class="table table-striped table-bordered table-sm ">
		 			<thead>
		 				<tr>
							<th scope="col">Nom</th>
							<th scope="col">Age Max</th>
							<th scope="col">Age Min</th>
							<th scope="col">Sexe</th>
							<th scope="col">Nbr de pers Max</th>
							<th scope="col">Entraineur</th>
														
						</tr>
		 			</thead>
		 			<tbody>
		 				</tr>
						 	<td scope="col">'.$nom.'</th>
		 					<td scope="col">'.$nbrPlace.'</th>
		 					<td scope="col">'.$ageMin.' Min</th>
		 					<td scope="col">'.$ageMax.'</th>
		 					<td scope="col">'.$sexe.'</th>
		 					<td scope="col">'.$choix.'</th>
		 				</tr>
					</tbody>
				</table>';
	}
}
?>
