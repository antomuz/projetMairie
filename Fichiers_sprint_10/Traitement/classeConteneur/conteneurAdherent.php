<?php

Class conteneurAdherent
	{
	//attribut de type arrayObjet, mais on est en php donc on ne met pas les types
	private $lesAdherents;
	
	//le constructeur créer un tableau vide
	public function __construct()
		{
		$this->lesAdherents = new arrayObject();
		}
	
	//les méthodes habituellement indispensables
	public function ajouterUnAdherent($unIdAdherent, $unNomAdherent, $unPrenomAdherent, $ageAdherent, $sexeAdherent,$unLoginAdherent, $unPwdAdherent,$lEquipe)
		{	$unAdherent = new metierAdherent($unIdAdherent, $unNomAdherent, $unPrenomAdherent, $ageAdherent, $sexeAdherent,$unLoginAdherent, $unPwdAdherent,$lEquipe);
		$this->lesAdherents->append($unAdherent);
			
		}
	public function nbAdherent()
		{
		return $this->lesAdherents->count();
		}	
		
	public function listeDesAdherents()
		{
		$liste = '';
		foreach ($this->lesAdherents as $unAdherent)
			{	$liste = $liste.$unAdherent->afficheAdherent();
			}
		return $liste;
		}
		
	public function lesAdherentsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idAdherent'>";
		foreach ($this->lesAdherents as $unAdherent)
			{
			$liste = $liste."<OPTION value='".$unAdherent->getIdAdherent()."'>".$unAdherent->getNomAdherent()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		

	public function donneObjetAdherentDepuisNumero($unIdAdherent)
		{
		$trouve=false;
		$leBonAdherent=null;
		$iAdherent = $this->lesAdherents->getIterator();
		while ((!$trouve)&&($iAdherent->valid()))
			{
			if ($iAdherent->current()->getIdAdherent()==$unIdAdherent)
				{
				$trouve=true;
				$leBonAdherent = $iAdherent->current();
				}
			else
				$iAdherent->next();
			}
		return $leBonAdherent;
		}
	public function donneObjetAdherentDepuisLogin($unLoginAdherent){
		$trouve=false;
		$leBonAdherent=null;
		$iAdherent = $this->lesAdherents->getIterator();
		while ((!$trouve)&&($iAdherent->valid()))
			{
			if ($iAdherent->current()->getLoginAdherent()==$unLoginAdherent)
				{
				$trouve=true;
				$leBonAdherent = $iAdherent->current();
				}
			else
				$iAdherent->next();
			}
		return $leBonAdherent;
	}
	public function modifierUnAdherent($unIdAdherent, $unNomAdherent, $unPrenomAdherent, $unAgeAdherent, $unSexeAdherent, $unLoginAdherent)
	{

		foreach ($this->lesAdherents as $unAdherent)
		{
			if ($unAdherent->getIdAdherent() == $unIdAdherent)
			{
				$unAdherent->setNomAdherent = $unNomAdherent;
				$unAdherent->setPrenomAdherent = $unPrenomAdherent;
				$unAdherent->setAgeAdherent = $unAgeAdherent;
				$unAdherent->setSexeAdherent = $unSexeAdherent;
				$unAdherent->setLoginAdherent = $unLoginAdherent;
			}
		}
	}

	public function modifierMDP($adherent, $MDP){

		foreach ($this->lesAdherents as $unAdherent)
		{
			if ($unAdherent->getIdAdherent() == $adherent->getIdAdherent())
			{
				$unAdherent->setPwdAdherent($MDP);
			}
		}
	}
}
?> 
