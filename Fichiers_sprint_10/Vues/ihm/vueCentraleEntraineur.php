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
							<legend>L entraineur est un : </legend>
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
							<legend>L entraineur est un : </legend>
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
				   <input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
				   <button type="submit" class="btn btn-primary">Valider</button>
				  </form>
			';
		}

		public function choixFaitPourModifTitulaire($nom, $date, $login, $pswd, $choix, $typeEntraineur)
	{
		echo '<form action=index.php?vue=Equipe&action=EnregModif method = GET>
						<input type=text name=nomEntraineur value='.$nom.'></input>
						<input type=text name=dateEmbEntraineur value='.$date.'></input>
						<input type=text name=loginEntraineur value='.$login.'></input>
						<input type=password name=pwdEntraineur value='.$pswd.'></input>'
						;
						echo '<input type=hidden name=idEntraineur value='.$choix.'></input>	
						<input type=hidden name=vue value=Entraineur></input>
						<input type=hidden name=action value=EnregModif></input>
						<input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
						<button type="submit" class="btn btn-primary">Valider</button>
			 </form>';
	}
		public function choixFaitPourModifVacataire($nom, $tel, $login, $pswd, $choix, $typeEntraineur)
	{
		echo '<form action=index.php?vue=Equipe&action=EnregModif method = GET>
						<input type=text name=nomEntraineur value='.$nom.'></input>
						<input type=text name=telephoneVacataire value='.$tel.'></input>
						<input type=text name=loginEntraineur value='.$login.'></input>
						<input type=password name=pwdEntraineur value='.$pswd.'></input>'
						;
						echo '<input type=hidden name=idEntraineur value='.$choix.'></input>	
						<input type=hidden name=vue value=Entraineur></input>
						<input type=hidden name=action value=EnregModif></input>
						<input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
						<button type="submit" class="btn btn-primary">Valider</button>
			 </form>';
	}

		public function visualiserEntraineur($liste)
		{
			$listeEntraineur=explode("|",$liste);
			
				echo '<div class="ascenseur">
					<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nom</th>
							<th scope="col">Login</th>
							<th scope="col">Date ou Téléphone</th>
						</tr>
					</thead>
					<tbody>';
					$nbE=0;
					while ($nbE<sizeof($listeEntraineur))
						{	
							$i=0;
							echo '<tr>';
							while (($i<4) && ($nbE<sizeof($listeEntraineur)))
							{
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
			$typeEntraineur = $_POST['typeEntraineur'];
						
				echo '<form action=index.php?vue=Entraineur&action=enregistrer method=POST>';
					
					switch ($typeEntraineur) 
					{
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
									  <input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
									  <button type="submit" class="btn btn-primary">Valider</button>
									</tr>
								</tbody>
							</table>
							
					</form>';
					break;
			
					case 'Titulaire':
						echo '<legend>Information du Titulaire</legend>
												
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
									  <input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
									  <button type="submit" class="btn btn-primary">Valider</button>
									</tr>
								</tbody>
							</table>
							
					</form>';
						break;
					}
			
		}
		
		
		
	}