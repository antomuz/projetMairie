<?php

Class metierAdherent
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idAdherent;
	private $nomAdherent;
	private $prenomAdherent;
	private $ageAdherent;
	private $sexeAdherent;
	private $loginAdherent;
	private $pwdAdherent;
	private $lEquipe;
	
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdAdherent, $unNomAdherent, $unPrenomAdherent, $unAgeAdherent, $unSexeAdherent, $unLoginAdherent, $unPwdAdherent,$uneEquipe)
		{
		$this->idAdherent = $unIdAdherent;
		$this->nomAdherent = $unNomAdherent;
		$this->prenomAdherent = $unPrenomAdherent;
		$this->ageAdherent = $unAgeAdherent;
		$this->sexeAdherent = $unSexeAdherent;
		$this->loginAdherent = $unLoginAdherent;
		$this->pwdAdherent = $unPwdAdherent;
		$this->lEquipe = $uneEquipe;
		
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdAdherent()
		{
		return $this->idAdherent;
		}
		
	public function getNomAdherent()
		{
		return $this->nomAdherent;
		}
	public function getPrenomAdherent()
		{
		return $this->prenomAdherent;
		}
	public function getAgeAdherent()
	{
		return $this->ageAdherent;
	}	
	public function getSexeAdherent()
	{
		return $this->sexeAdherent;
	}
	public function getLoginAdherent()
	{	
		return $this->loginAdherent;
	}
	public function getPwdAdherent()
	{
		return $this->pwdAdherent;
	}
	public function getlEquipeDelAdherent()
	{
		return $this->lEquipe;
	}
	
	
// les setteurs-----------------------------------------------------

	public function setIdAdherent($unIdAdherent)
		{
		$this->idAdherent=$unIdAdherent;
		}
		
	public function setNomAdherent($unNomAdherent)
		{
		$this->nomAdherent=$unNomAdherent;
		}
	public function setPrenomAdherent($unPrenomAdherent)
		{
		$this->prenomAdherent=$unPrenomAdherent;
		}
	public function setAgeAdherent($unAgeAdherent)
	{
		$this->ageAdherent=$unAgeAdherent;
	}	
	public function setSexeAdherent($unSexeAdherent)
	{
		$this->sexeAdherent=$unSexeAdherent;
	}
	public function setLoginAdherent($unLoginAdherent)
	{
		$this->loginAdherent=$unLoginAdherent;
	}
	public function setPwdAdherent($unPwdAdherent)
	{
		$this->pwdAdherent=$unPwdAdherent;
	}
		
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheAdherent()
	{
		$liste=$this->getNomAdherent().' | '.$this->getPrenomAdherent().' | '.$this->getAgeAdherent().' | '.$this->getSexeAdherent().' | ';
		return $liste;
	}	

	public function setLEquipeDeLAdherent($uneEquipe)
	{
		$this->lEquipe = $uneEquipe;
	}

	}
	
?>
