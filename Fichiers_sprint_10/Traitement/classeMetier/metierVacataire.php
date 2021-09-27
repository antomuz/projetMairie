<?php


Class metierVacataire extends metierEntraineur
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $telephone; 
	
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdEntraineur, $unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur,$unTelephone)
		{
		parent::__construct($unIdEntraineur,$unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur);
		$this->telephone = $unTelephone;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getTelephone()
	{
		return $this->telephone;
	}
		
	//SETTEUR------------------------------------------------------------
	
	public function setTelephone($unTelephone)
		{
		$this->telephone = $unTelephone;
		}
				
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheVacataire()
		{
		$liste=parent::afficheEntraineur();
		$liste=$liste.$this->getTelephone().'|';
		return $liste;
		}			    
	
	}
	
?>