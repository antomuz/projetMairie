<?php
	
	class vueCentraleSpecialite
	{
		public function __construct()
		{
			
		}
		
		public function visualiserSpecialite($message)
		{		
			$listeSpe=explode("|",$message);
			
			echo '<br><table class="table table-striped table-bordered table-sm ">
		 			<thead>
		 				<tr>
		 					<th scope="col">numero</th>
		 					<th scope="col">libelle</th>
		 				</tr>
		 			</thead>
		 			<tbody>';
		 	$nbE=0;
		 	while ($nbE<sizeof($listeSpe))
		 	{	
		 		$i=0;
		 		while (($i<2) && ($nbE<sizeof($listeSpe)))
		 		{
		 			echo '<td scope>';
		 			echo trim($listeSpe[$nbE]);
		 			$i++;
		 			$nbE++;
		 			echo '</td>';
		 		}
		 		echo '</tr>';
		 	}
		 	echo '</tbody>';
		 	echo '</table>';
			
		}
    }
?>