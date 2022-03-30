<?php
class metierEntraineur
{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idEntraineur;
	private $nomEntraineur;
	private $loginEntraineur;
	private $pwdEntraineur;
	private $lesSpecialites;

	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdEntraineur, $unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur)
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
		$present = FALSE;
		if (count($this->lesSpecialites) > 0) {
			foreach ($this->lesSpecialites as $uneSpecialite) {
				if ($uneSpecialite->getIdSpe() == $new_specialite->getIdSpe()) {
					$present = TRUE;
					break;
				}
			}
		}
		if (!$present) {

			$this->lesSpecialites->append($new_specialite);
		}
	}

	public function suppressionSpeEntraineur($idSpe)
	{
		foreach ($this->lesSpecialites as $uneSpe) {
			if ($uneSpe->getIdSpe() == $idSpe) {
				unset($this->lesSpecialites[$uneSpe]);
			}
		}
	}

	public function suppressionSpeEntraineurAll()
	{
		unset($this->lesSpecialites);
		$this->lesSpecialites = new arrayObject();
	}

	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheEntraineur()
	{
		$vretour = $this->getIdEntraineur() . ' | ' . $this->getNomEntraineur() . ' | ' . $this->getLoginEntraineur() . ' |';
		if (count($this->lesSpecialites) > 0) {
			$liste = array();
			foreach ($this->lesSpecialites as $uneSpecialite) {
				array_push($liste, $uneSpecialite->getNomSpe());
			}
			$liste = implode(', ', $liste); //implode permet de joindre les éléments de $liste par le séparateur qui lui est passé en premier paramètre.
			$vretour = $vretour . $liste . ' |  ';
		} else {
			$vretour = $vretour . ' indéfinie | ';
		}

		return $vretour;
	}
}
