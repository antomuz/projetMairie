<?php

class conteneurTitulaire
	{
	//attribut de type arrayObjet, mais on est en php donc on ne met pas les types
	private $lesTitulaires;
	
	//le constructeur créer un tableau vide
	public function __construct()
		{
		$this->lesTitulaires = new arrayObject();
		}
	
	//les méthodes habituellement indispensables
	public function ajouterUnTitulaire($unIdEntraineur, $unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur, $uneDateEmbauche)
	{
		$unTitulaire = new metierTitulaire($unIdEntraineur, $unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur, $uneDateEmbauche);
		$this->lesTitulaires->append($unTitulaire);
			
	}
	
	public function nbTitulaire()
		{
		return $this->lesTitulaires->count();
		}	
		
	public function listeDesTitulaires()
		{
		$liste = '';
		foreach ($this->lesTitulaires as $unTitulaire)
			{	$liste = $liste.$unTitulaire->afficheTitulaire();
			}
		return $liste;
		}
		

		
	public function lesTitulairesAuFormatHTML()
		{
		$liste = "<SELECT name = 'idTitulaire'>";
		foreach ($this->lesTitulaires as $unTitulaire)
			{
			$liste = $liste."<OPTION value='".$unTitulaire->getIdTitulaire()."'>".$unTitulaire->getNomTitulaire()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}	
		
	public function modifierUnTitulaire($unIdTitulaire, $unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur, $uneDateEmbauche)
		{
				
			foreach ($this->lesTitulaires as $unTitulaire)
			{
				if ($unTitulaire->getIdTitulaire() == $unIdTitulaire)
				{
					$unTitulaire->setNomEquipe = $unNomEntraineur;
					$unTitulaire->setNbrPlaceEquipe = $unLoginEntraineur;
					$unTitulaire->setAgeMinEquipe = $unPwdEntraineur;
					$unTitulaire->setAgeMaxEquipe = $uneDateEmbauche;
				}
			}
		}
	
	
	public function donneObjetTitulaireDepuisNumero($unIdTitulaire)
		{
		$trouve=false;
		$leBonTitulaire=null;
		$iTitulaire = $this->lesTitulaires->getIterator();
		while ((!$trouve)&&($iTitulaire->valid()))
			{
			if ($iTitulaire->current()->getIdEntraineur()==$unIdTitulaire)
				{
				$trouve=true;
				$leBonTitulaire = $iTitulaire->current();
				}
			else
				$iTitulaire->next();
			}
		return $leBonTitulaire;
		}	
		
		public function chercherExistenceIdTitulaire($unId)
		{
		$trouve=false;
		$iTitulaire = $this->lesTitulaires->getIterator();
		while ((!$trouve)&&($iTitulaire->valid()))
			{	
				if ($iTitulaire->current()->getIdEntraineur()==$unId)
					$trouve=true;
			$iTitulaire->next();
			}
		return $trouve;
		}	
			
	}
?> 