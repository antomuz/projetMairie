<?php

Class metierSpecialite
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idSpe;
	private $nomSpe;

	
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdSpe, $unNomSpe)
		{
		$this->idSpe= $unIdSpe;
		$this->nomSpe = $unNomSpe;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdSpe()
		{
		return $this->idSpe;
		}
		
	public function getNomSpe()
		{
		return $this->nomSpe;
		}
	
// les setteurs-----------------------------------------------------

	public function setNomSpe($unNomSpe)
		{
		$this->nomSpe=$unNomSpe;
		}
		
		
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheSpe()
	{
		$liste=$this->idSpe.' | '.$this->nomSpe.' | ';
		return $liste;
	}
	}
	
?>