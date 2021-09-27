<?php
	include ('Outil/autoload.php');
	$role=0;
	if (!isset($monControleur))
	{
		$monControleur = new controleur();
		$monControleur->afficheEntete();
	}
	
	if ((isset($_GET['vue']))&& (isset($_GET['action'])))
	{
		$monControleur->affichePage($_GET['action'],$_GET['vue'],$role);
	}
	else
	{
		require "vues/ihm/menu.php";
		
	
	}
	
	//if (!isset($monControleur))
	//{
		$monControleur->affichePiedPage();
	//}
?>