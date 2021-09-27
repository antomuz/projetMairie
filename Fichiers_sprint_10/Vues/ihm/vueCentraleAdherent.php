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
							<th scope="col">Equipe</th>
							<th scope="col">Entraineur</th>
														
		 				</tr>
		 			</thead>
		 			<tbody>';
		 	$nbE=0;
		 	while ($nbE<sizeof($listeAdherent))
		 	{	
		 		$i=0;
		 		while (($i<6) && ($nbE<sizeof($listeAdherent)))
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
		
		public function voyagerAdherent()
		{		
			echo '<iframe width=100% height=150% src="https:www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.319959224129!2d1.3158100143582203!3d43.683111158516006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aeaee6224c0f13%3A0x9f57b169fe3a7161!2sMairie!5e0!3m2!1sfr!2sfr!4v1626195896682!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
				
		}
		
	
}
?>