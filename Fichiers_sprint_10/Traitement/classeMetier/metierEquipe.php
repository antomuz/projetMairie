<?php
Class metierEquipe
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idEquipe; 
	private $nomEquipe; 
	private $nbrPlaceEquipe; 
	private $ageMinEquipe; 
	private $ageMaxEquipe; 
	private $sexeEquipe; 
	private $lEntraineur;
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	
	public function __construct($unIdEquipe, $unNomEquipe, $unNbrPlaceEquipe, $unAgeMinEquipe, $unAgeMaxEquipe, $unSexeEquipe, $unEntraineur)
		{
		$this->idEquipe = $unIdEquipe;
		$this->nomEquipe = $unNomEquipe;
		$this->nbrPlaceEquipe = $unNbrPlaceEquipe;
		$this->ageMinEquipe = $unAgeMinEquipe;
		$this->ageMaxEquipe = $unAgeMaxEquipe;
		$this->sexeEquipe = $unSexeEquipe;
		$this->lEntraineur = $unEntraineur;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdEquipe()
	{
		return $this->idEquipe;
	}
		
		
	public function getNomEquipe()
		{
		return $this->nomEquipe;
		}
	public function getNbrPlaceEquipe()
		{
		return $this->nbrPlaceEquipe;
		}
	public function getAgeMinEquipe()
		{
		return $this->ageMinEquipe;
		}
	public function getAgeMaxEquipe()
		{
		return $this->ageMaxEquipe;
		}
	public function getSexeEquipe()
		{
		return $this->sexeEquipe;
		}
	public function getlEntraineur()
	{
		return $this->lEntraineur;
	}
	
	//SETTEUR------------------------------------------------------------
	
	public function setIdEquipe($unIdEquipe)
		{
		$this->idEquipe = $unIdEquipe;
		}
	public function setNomEquipe($unNomEquipe)
		{
		$this->nomEquipe = $unNomEquipe;
		}
	public function setNbrPlaceEquipe($unNbrPlaceEquipe)
		{
		$this->nbrPlaceEquipe = $unNbrPlaceEquipe;
		}
	public function setAgeMaxEquipe($unAgeMaxEquipe)
		{
		$this->ageMaxEquipe = $unAgeMaxEquipe;
		}
	public function setAgeMinEquipe($unAgeMinEquipe)
		{
		$this->ageMinEquipe = $unAgeMinEquipe;
		}
	public function setSexeEquipe($unSexeEquipe)
		{
		$this->sexeEquipe = $unSexeEquipe;
		}
	public function setLEntraineur($unEntraineur)
	{
		echo $this->lEntraineur->getNomEntraineur();
		$this->lEntraineur = $unEntraineur;
	}
		
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheEquipe()
	{
		return $liste=$this->getNomEquipe().' | '.$this->getNbrPlaceEquipe().' | '.$this->getAgeMinEquipe().'|'.$this->getAgeMaxEquipe().' |'.$this->getSexeEquipe().'|'.$this->getLEntraineur()->getNomEntraineur().'|';
					
	}			    
	
	}
	
?>