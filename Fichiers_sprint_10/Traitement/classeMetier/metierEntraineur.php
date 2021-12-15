<?php
Class metierEntraineur
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idEntraineur; 
	private $nomEntraineur;
	private $loginEntraineur;
	private $pwdEntraineur;
	private $lesSpecialites;
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdEntraineur, $unNomEntraineur,$unLoginEntraineur,$unPwdEntraineur)
		{
		$this->idEntraineur = $unIdEntraineur;
		$this->nomEntraineur = $unNomEntraineur;
		$this->loginEntraineur = $unLoginEntraineur;
		$this->pwdEntraineur = $unPwdEntraineur;
		$this->lesSpecialites = new arrayObject();
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdEntraineur()
	{
		return $this->idEntraineur;
	}
	public function getNomEntraineur()
		{
		return $this->nomEntraineur;
		}
	public function getLoginEntraineur()
		{
		return $this->loginEntraineur;
		}
	public function getPwdEntraineur()
		{
		return $this->pwdEntraineur;
		}
	public function getLesSpeEntraineur()
		{
		return $this->lesSpecialites;
		}
	//SETTEUR------------------------------------------------------------
	
	public function setIdEntraineur($unIdEntraineur)
		{
		$this->idEntraineur = $unIdEntraineur;
		}
	public function setNomEquipe($unNomEntraineur)
		{
		$this->nomEntraineur = $unNomEntraineur;
		}
	public function setLoginEquipe($unLoginEntraineur)
		{
		$this->loginEntraineur = $unLoginEntraineur;
		}
	public function setPwdEquipe($unPwdEntraineur)
		{
		$this->pwdEntraineur = $unPwdEntraineur;
		}

	public function ajoutSpeEntraineur($new_specialite)
	{
		$this->lesSpecialites->append($new_specialite);
	}

	
			
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheEntraineur()
		{
		return $this->getIdEntraineur().' | '.$this->getNomEntraineur().' | '.$this->getLoginEntraineur().' |';
		}			    
	
	}
	
?>