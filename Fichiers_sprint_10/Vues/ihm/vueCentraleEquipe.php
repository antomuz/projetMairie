<?php
	
	class vueCentraleEquipe
	{
		public function __construct()
		{
			
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

		// public function visualiserEquipe($message)
		// {
						
		// 	$listeEquipe=explode("|",$message);
		// 	echo '<br><table class="table table-striped table-bordered table-sm ">
		// 			<thead>
		// 				<tr>
		// 					<th scope="col">Nom</th>
		// 					<th scope="col">Age Max</th>
		// 					<th scope="col">Age Min</th>
		// 					<th scope="col">Sexe</th>
		// 					<th scope="col">Nbr de pers Max</th>
		// 					<th scope="col">Entraineur</th>
														
		// 				</tr>
		// 			</thead>
		// 			<tbody>';
		// 	$nbE=0;
		// 	while ($nbE<sizeof($listeEquipe))
		// 	{	
		// 		$i=0;
		// 		while (($i<6) && ($nbE<sizeof($listeEquipe)))
		// 		{
		// 			echo '<td scope>';
		// 			echo trim($listeEquipe[$nbE]);
		// 			$i++;
		// 			$nbE++;
		// 			echo '</td>';
		// 		}
		// 		echo '</tr>';
		// 	}
		// 	echo '</tbody>';
		// 	echo '</table>';
			
		// }
		
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