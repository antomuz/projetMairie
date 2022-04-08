<?php

class conteneurSpecialite
	{
	//attribut de type arrayObjet, mais on est en php donc on ne met pas les types
	private $lesSpecialites;
	
	//le constructeur créer un tableau vide
	public function __construct()
		{
		$this->lesSpecialites = new arrayObject();
		}
	
	//les méthodes habituellement indispensables
	public function ajouterUneSpecialite($unIdSpe, $unNomSpe)
	{
		$uneSpecialite = new metierSpecialite($unIdSpe, $unNomSpe);
		$this->lesSpecialites->append($uneSpecialite);
			
	}
	
	public function modifierUneSpecialite($unIdSpecialite, $unNomSpecialite)
	{
			
		foreach ($this->lesSpecialites as $uneSpecialite)
		{
			if ($uneSpecialite->getIdSpe() == $unIdSpecialite)
			{
				$uneSpecialite->nomSpecialite = $unNomSpecialite;
			}
		}
	}

	
	
	public function nbSpecialite()
		{
		return $this->lesSpecialites->count();
		}	
		
	public function listeDesSpecialites()
		{
		$liste = '';
		foreach ($this->lesSpecialites as $uneSpecialite)
			{	
                $liste = $liste.$uneSpecialite->afficheSpe();
			}
		return $liste;
		}
		
	public function lesSpecialitesAuFormatHTML()
		{
		$liste = "<SELECT name = 'idSpe'>";
		foreach ($this->lesSpecialites as $uneSpecialite)
			{
			$liste = $liste."<OPTION value='".$uneSpecialite->getIdSpe()."'>".$uneSpecialite->getNomSpe()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}	
		
	public function lesSpecialitesAuFormatHTMLPourModif($uneSpe) 
	{
		$liste = "<SELECT name = 'idSpe'>";
		foreach ($this->lesSpecialites as $uneSpecialite)
			{
				if ($uneSpecialite->getIdSpe() == $uneSpe->getIdSpe()) 
				{
					$liste = $liste."<OPTION value='".$uneSpecialite->getIdSpe()."' selected>".$uneSpecialite->getNomSpe()."</OPTION>";
				}
				else 
				{
					$liste = $liste."<OPTION value='".$uneSpecialite->getIdSpe()."'>".$uneSpecialite->getNomSpe()."</OPTION>";
				}
			
			}
		$liste = $liste."</SELECT>";
		return $liste;
	}
	
	public function donneObjetSpecialiteDepuisNumero($unIdSpe)
		{
		
		$trouve=false;
		$laBonneSpecialite=null;
		$iSpecialite = $this->lesSpecialites->getIterator();
		while ((!$trouve)&&($iSpecialite->valid()))
			{
				if ($iSpecialite->current()->getIdSpe()==$unIdSpe)
				{
				$trouve=true;
				$laBonneSpecialite = $iSpecialite->current();
				}
			else
				$iSpecialite->next();
			}
		return $laBonneSpecialite;
		}	
	
		public function lesSpecialitesAuFormatHTMLsmarter()
		{
			$liste = "";
			$liste = $liste."<OPTION value=0>Indéfini</OPTION>";
			foreach ($this->lesSpecialites as $uneSpecialite)
				{
				$liste = $liste."<OPTION value='".$uneSpecialite->getIdSpe()."'>".$uneSpecialite->getNomSpe()."</OPTION>";
				}
			return $liste;
		}	
	}
	
?> 