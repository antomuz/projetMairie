<?php

class accesBD
{
	private $hote;
	private $login;
	private $passwd;
	private $base;
	private $conn;

	// Nous construisons notre connexion
	public function __construct()
	{
		$this->hote = "localhost";
		$this->login = "root";
		$this->passwd = "";
		$this->base = "clubAussonne";
		$this->connexion();
	}
	private function connexion()
	{
		try {
			$this->conn = new PDO("mysql:host=" . $this->hote . ";dbname=" . $this->base . ";charset=utf8", $this->login, $this->passwd);
			$this->boolConnexion = true;
		} catch (PDOException $e) {
			die("Connection à la base de données échouée" . $e->getMessage());
		}
	}

	public function verifExistance($role, $login, $pwd)
	{
		if (strstr($login, "LIMIT") || strstr($login, "\"") || strstr($login, "\'") || strstr($login, "-")) //mysql_real_escape_stream()
		{
			echo "<h2 style=color:red;>Piratage ?-</h2>";
		} else {
			switch ($role) {
				case "1":
					$requete = $this->conn->prepare("SELECT idAdmin FROM administrateur where loginAdmin = ? and pwdAdmin = ?;");
					$requete->bindValue(1, $login);
					$requete->bindValue(2, md5($pwd));
					break;
				case "2":
					$requete = $this->conn->prepare("SELECT idAdherent FROM adherent where loginAdherent = ? and pwdadherent = ?;");
					$requete->bindValue(1, $login);
					$requete->bindValue(2, md5($pwd));
					break;
				case "3":
					$requete = $this->conn->prepare("SELECT idEntraineur FROM entraineur where loginEntraineur = ? and pwdentraineur= ?;");
					$requete->bindValue(1, $login);
					$requete->bindValue(2, md5($pwd));
					break;
			}

			if ($requete->execute()) {
				//$row = $requete->fetch ( PDO::FETCH_NUM );
				//echo $row[0];
				if ($requete->rowCount() == 1) {
					return (1);
				} else {
					return (0);
				}
			} else {
				die("Erreur dans la requête : " . $requete->errorCode());
			}
		}

		// $result=$this->conn->query($requete);

		// if ($result)
		// {
		//     if ($result->rowCount()==1)
		//     {
		//         return(1);
		//     }
		//     else
		//     {
		//         return(0);
		//     }
		// }
	}

	public function enregMessage($emailContact, $messageContact)
	{
		$requete = $this->conn->prepare('INSERT INTO message (emailContact, messageContact) VALUES (?,?);');
		$requete->bindValue(1, $emailContact);
		$requete->bindValue(2, $messageContact);
		$requete->execute();
	}

	public function listeDesMessages()
	{
		$requete = $this->conn->prepare('SELECT * from message;');
		if ($requete->execute()) {
			$retour = '';
			while ($row = $requete->fetch(PDO::FETCH_OBJ)) {
				$retour = $retour . $row->idMessage . '|' . $row->emailContact . '|' . $row->messageContact . '<br>';
			};

			return $retour;
		}
		if (!$requete->execute()) {
			die("Erreur dans la requête : " . $requete->errorCode());
		}
	}

	public function listeDesNouvellesFormatHTML()
	{
		$requete = $this->conn->prepare('SELECT * from typeNouvelle;');
		if ($requete->execute()) {
			$retour = '<select name=typeNouvelle>';
			while ($row = $requete->fetch(PDO::FETCH_OBJ)) {
				$retour = $retour . '<option value="' . $row->idTypeNouvelle . '">' . $row->libelleTypeNouvelle . '</option>';
			}
			$retour = $retour . '</select>';
			echo $retour;
		}
		if (!$requete->execute()) {
			die("Erreur dans la requête : " . $requete->errorCode());
		}
	}

	public function listeDesNouvellesPourUnType($idTypeNouvelleChoisi)
	{
		$requete = $this->conn->prepare('SELECT idNouvelle, dateParutionNouvelle, descriptionNouvelle FROM nouvelle where idTypeNouvelle = ? ;');
		$requete->bindValue(1, $idTypeNouvelleChoisi);
		if ($requete->execute()) {
			$retour = '';
			while ($row = $requete->fetch(PDO::FETCH_OBJ)) {
				$retour = $retour . '|' . $row->idNouvelle . '|' . $row->dateParutionNouvelle . '|' . $row->descriptionNouvelle;
			}
			return $retour;
		}

		if (!$requete->execute()) {
			die("Erreur dans la requête : " . $requete->errorCode());
		}
	}


	/******************************************************************************
	Nous avons toutes les fonctions d'insertion
	 *******************************************************************************/
	public function insertVacataire($unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur, $unTelephone)
	{
		$sonId = $this->donneProchainIdentifiant("ENTRAINEUR", "idEntraineur");
		$requete = $this->conn->prepare("INSERT INTO ENTRAINEUR (idEntraineur,nomEntraineur,loginEntraineur,pwdEntraineur) VALUES (?,?,?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $unNomEntraineur);
		$requete->bindValue(3, $unLoginEntraineur);
		$requete->bindValue(4, md5($unPwdEntraineur));
		if (!$requete->execute()) {
			die("Erreur dans insert Entraineur : " . $requete->errorCode());
		}

		$requete = $this->conn->prepare("INSERT INTO vacataire (idEntraineur,telephoneVacataire) VALUES (?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $unTelephone);
		if (!$requete->execute()) {
			die("Erreur dans insert Vacataire : " . $requete->errorCode());
		}
		return $sonId;
	}

	public function insertTitulaire($unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur, $uneDateEmbauche)
	{
		$sonId = $this->donneProchainIdentifiant("ENTRAINEUR", "idEntraineur");
		$requete = $this->conn->prepare("INSERT INTO ENTRAINEUR (idEntraineur,nomEntraineur,loginEntraineur,pwdEntraineur) VALUES (?,?,?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $unNomEntraineur);
		$requete->bindValue(3, $unLoginEntraineur);
		$requete->bindValue(4, md5($unPwdEntraineur));
		if (!$requete->execute()) {
			die("Erreur dans insert Entraineur : " . $requete->errorCode());
		}

		$requete = $this->conn->prepare("INSERT INTO titulaire (idEntraineur,dateEmbauche) VALUES (?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $uneDateEmbauche);
		if (!$requete->execute()) {
			die("Erreur dans insert Titulaire : " . $requete->errorCode());
		}

		return $sonId;
	}

	public function insertEquipe($unNomEquipe, $unNbrPlaceEquipe, $unAgeMinEquipe, $unAgeMaxEquipe, $unSexeEquipe, $unIdEntraineur, $uneSpe)
	{
		$sonId = $this->donneProchainIdentifiant("EQUIPE", "idEquipe");
		$requete = $this->conn->prepare("INSERT INTO EQUIPE (idEquipe,nomEquipe,nbrPlaceEquipe,ageMinEquipe,ageMaxEquipe,sexeEquipe,idEntraineur,idSpe) VALUES (?,?,?,?,?,?,?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $unNomEquipe);
		$requete->bindValue(3, $unNbrPlaceEquipe);
		$requete->bindValue(4, $unAgeMinEquipe);
		$requete->bindValue(5, $unAgeMaxEquipe);
		$requete->bindValue(6, $unSexeEquipe);
		$requete->bindValue(7, $unIdEntraineur);
		$requete->bindValue(8, $uneSpe);
		if (!$requete->execute()) 
    {
			die("Erreur dans insert Equipe : " . $requete->errorCode());
		}
		return $sonId;
	}



	public function insertAdherent($unNomAdherent, $unPrenomAdherent, $unAgeAdherent, $unSexeAdherent, $unLoginAdherent, $unPwdAdherent, $unIdEquipe)
	{
		$sonId = $this->donneProchainIdentifiant("ADHERENT", "idAdherent") + 1;
		$requete = $this->conn->prepare("INSERT INTO ADHERENT (idAdherent,nomAdherent, prenomAdherent, ageAdherent, sexeAdherent,loginAdherent, pwdAdherent,idEquipe) VALUES (?,?,?,?,?,?,?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $unNomAdherent);
		$requete->bindValue(3, $unPrenomAdherent);
		$requete->bindValue(4, $unAgeAdherent);
		$requete->bindValue(5, $unSexeAdherent);
		$requete->bindValue(6, $unLoginAdherent);
		$requete->bindValue(7, md5($unPwdAdherent));
		$requete->bindValue(8, $unIdEquipe);
		if (!$requete->execute()) {
			die("Erreur dans insert Adherent : " . $requete->errorCode());
		}
		return $sonId;
	}

	public function insertSpecialite($unNomSpe) 
	{
		$sonId = $this->donneProchainIdentifiant("SPECIALITE", "idSpe");
		$requete = $this->conn->prepare("INSERT INTO SPECIALITE (idSPe,nomSpe) VALUES (?,?)");
		$requete->bindValue(1, $sonId);
		$requete->bindValue(2, $unNomSpe);
		if (!$requete->execute()) {
			die("Erreur dans insert specialite : " . $requete->errorCode());
		}
		return $sonId;
	}
	

	/***********************************************************************************************
	méthode qui va permettre de modifier les éléments d'une équipe.
	 ***********************************************************************************************/
	public function modifEquipe($idEquipe, $unNomEquipe, $unNbrPlaceEquipe, $unAgeMinEquipe, $unAgeMaxEquipe, $unSexeEquipe, $unIdEntraineur)
	{
		$requete = $this->conn->prepare("UPDATE equipe SET nomEquipe = ?, nbrPlaceEquipe = ?, ageMinEquipe = ?, ageMaxEquipe = ?, sexeEquipe = ?, idEntraineur = ? where idEquipe = ?");

		$requete->bindValue(1, $unNomEquipe);
		$requete->bindValue(2, $unNbrPlaceEquipe);
		$requete->bindValue(3, $unAgeMinEquipe);
		$requete->bindValue(4, $unAgeMaxEquipe);
		$requete->bindValue(5, $unSexeEquipe);
		$requete->bindValue(6, $unIdEntraineur);
		$requete->bindValue(7, $idEquipe);

		echo "La modification est effectuée.";

		if (!$requete->execute()) {
			die("Erreur dans modif Equipe : " . $requete->errorCode());
		}
		return $idEquipe;
	}

	public function modifTitulaire($unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur, $uneDateEmbauche, $IdEntraineur)
	{
		$requete = $this->conn->prepare("UPDATE entraineur SET nomEntraineur = ?, loginEntraineur = ?, pwdEntraineur = ? where idEntraineur = ?");

		$requete->bindValue(1, $unNomEntraineur);
		$requete->bindValue(2, $unLoginEntraineur);
		$requete->bindValue(3, md5($unPwdEntraineur));
		$requete->bindValue(4, $IdEntraineur);

		if (!$requete->execute()) {
			die("Erreur dans modif Entraineur : " . $requete->errorCode());
		}
		$requete = $this->conn->prepare("UPDATE titulaire SET dateEmbauche = ? where idEntraineur = ?");

		$requete->bindValue(1, $uneDateEmbauche);
		$requete->bindValue(2, $IdEntraineur);

		if (!$requete->execute()) {
			die("Erreur dans modif Titulaire : " . $requete->errorCode());
		}

		echo "La modification est effectuée.";

		return $IdEntraineur;
	}
	public function modifVacataire($unNomEntraineur, $unLoginEntraineur, $unPwdEntraineur, $unTelephone, $IdEntraineur)
	{
		$requete = $this->conn->prepare("UPDATE entraineur SET nomEntraineur = ?, loginEntraineur = ?, pwdEntraineur = ? where idEntraineur = ?");

		$requete->bindValue(1, $unNomEntraineur);
		$requete->bindValue(2, $unLoginEntraineur);
		$requete->bindValue(3, md5($unPwdEntraineur));
		$requete->bindValue(4, $IdEntraineur);

		if (!$requete->execute()) {
			die("Erreur dans modif Entraineur : " . $requete->errorCode());
		}
		$requete = $this->conn->prepare("UPDATE vacataire SET telephoneVacataire = ? where idEntraineur = ?");

		$requete->bindValue(1, $unTelephone);
		$requete->bindValue(2, $IdEntraineur);

		if (!$requete->execute()) {
			die("Erreur dans modif Vacataire : " . $requete->errorCode());
		}

		echo "La modification est effectuée.";

		return $IdEntraineur;
	}

	/***********************************************************************************************
	méthode qui va permettre de supprimer et ajouter des spécialités pour les adhérents
	 ***********************************************************************************************/
	public function delSpeEntraineur($idEntraineur, $idSpe)
	{

		#$requete = $this->conn->prepare("UPDATE adherent SET pwdAdherent = ? where idAdherent = ?");
		$requete = $this->conn->prepare("DELETE FROM spe_entraineur WHERE idSpe = ? AND idEntraineur = ?");
		$requete->bindValue(1, $idSpe);
		$requete->bindValue(2, $idEntraineur);

		echo "Suppression effectuée.";

		if (!$requete->execute()) {
			die("Erreur dans delSpeEntraineur : " . $requete->errorCode());
    }
  }
	
	public function modifProfil($unIdAdherent,$unNomAdherent,$unPrenomAdherent,$unAgeAdherent,$unSexeAdherent,$unLoginAdherent)
	{	
	
			$requete = $this->conn->prepare("UPDATE adherent SET  nomAdherent = ?, prenomAdherent = ?, ageAdherent = ?, sexeAdherent = ?, loginAdherent = ? where idAdherent = ?");
			$requete->bindValue(1,$unNomAdherent);
			$requete->bindValue(2,$unPrenomAdherent);
			$requete->bindValue(3,$unAgeAdherent);
			$requete->bindValue(4,$unSexeAdherent);
			$requete->bindValue(5,$unLoginAdherent);
			$requete->bindValue(6,$unIdAdherent);
		
			echo "La modification est effectuée.";
		
		if(!$requete->execute())
		{
			die("Erreur dans modif Equipe : ".$requete->errorCode());
		}
		return $unIdAdherent;
	}

	/*Supprime toutes les spécialités pour un entraineur */
	public function delSpeEntraineurAll($idEntraineur)
	{
		$requete = $this->conn->prepare("DELETE FROM spe_entraineur WHERE idEntraineur = ?");
		$requete->bindValue(1, $idEntraineur);

		echo "Suppression effectuée.";

		if (!$requete->execute()) {
			die("Erreur dans delSpeEntraineur : " . $requete->errorCode());
		}
		return $idEntraineur;
	}



	public function addSpeEntraineur($idEntraineur, $idSpe)
	{

		#$requete = $this->conn->prepare("UPDATE adherent SET pwdAdherent = ? where idAdherent = ?");
		$requete = $this->conn->prepare("INSERT INTO spe_entraineur VALUES (?, ?)");
		$requete->bindValue(1, $idSpe);
		$requete->bindValue(2, $idEntraineur);

		echo "Insertion effectuée.";

		if (!$requete->execute()) {
			die("Erreur dans addSpeEntraineur : " . $requete->errorCode());
		}
		return $idEntraineur;
	}

	/***********************************************************************************************
	méthode qui va permettre de modifier ou reset le MDP.
	***********************************************************************************************/
	public function modifMDP($adherent, $MDP)
	{	
	
			$requete = $this->conn->prepare("UPDATE adherent SET pwdAdherent = ? where idAdherent = ?");
			$requete->bindValue(1,md5($MDP));
			$requete->bindValue(2,$adherent->getIdAdherent());
			
		
			echo "La modification est effectuée.";
		
		if(!$requete->execute())
		{
			die("Erreur dans modif Equipe : ".$requete->errorCode());
		}
		return $adherent->getIdAdherent();
	}


	public function resMDP($unIdAdherent) {
		
	
		$requete = $this->conn->prepare("UPDATE adherent SET pwdAdherent = ? where idAdherent = ?");
		$requete->bindValue(1,md5('P@ssword'));
		$requete->bindValue(2,$unIdAdherent);
		
	
		echo "La modification est effectuée.";
	
	  if(!$requete->execute())
	  {
		  die("Erreur dans modif Equipe : ".$requete->errorCode());
	  }
	  return $unIdAdherent;	
	}
	
	/***********************************************************************************************
	C'est la fonction qui permet de charger les tables et de les mettre dans un tableau 2 dimensions. La petite fontions specialCase permet juste de psser des minuscules aux majuscules pour les noms des tables de la base de données
	 ************************************************************************************************/
	public function chargement($uneTable)
	{
		$lesInfos = null;
		$nbTuples = 0;
		$stringQuery = "SELECT * FROM ";
		$stringQuery = $this->specialCase($stringQuery, $uneTable);
		$query = $this->conn->prepare($stringQuery);
		if ($query->execute()) {
			while ($row = $query->fetch(PDO::FETCH_NUM)) {
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		} else {
			die('Problème dans chargement : ' . $query->errorCode());
		}
		return $lesInfos;
	}

	private function specialCase($stringQuery, $uneTable)
	{
		$uneTable = strtoupper($uneTable);
		switch ($uneTable) {
			case 'VACATAIRE':
				$stringQuery .= 'vacataire';
				break;
			case 'EQUIPE':
				$stringQuery .= 'equipe';
				break;
			case 'ADHERENT':
				$stringQuery .= 'adherent';
				break;
			case 'ENTRAINEUR':
				$stringQuery .= 'entraineur';
				break;
			case 'TITULAIRE':
				$stringQuery .= 'titulaire';
				break;

			case 'SPECIALITE':
				$stringQuery .= 'specialite';
				break;

			case 'SPE_ENTRAINEUR':
				$stringQuery .= 'spe_entraineur';
				break;

			default:
				die('Pas une table valide');
				break;
		}

		return $stringQuery . ";";
	}

	/**************************************************************************
	fonction qui permet d'avoir le prochain identifiant de la table. Elle est là uniquement parce que nous n'avons pas d'autoincremente dans notre base de données
	 ***************************************************************************/
	public function donneProchainIdentifiant($uneTable)
	{
		$stringQuery = $this->specialCase("SELECT * FROM ", $uneTable);
		$requete = $this->conn->prepare($stringQuery);
		//$requete->bindValue(1,$unIdentifiant);

		if ($requete->execute()) {
			$nb = 0;
			while ($row = $requete->fetch(PDO::FETCH_NUM)) {
				$nb = $row[0];
			}
			return $nb + 1;
		} else {
			die('Erreur sur donneProchainIdentifiant : ' + $requete->errorCode());
		}
	}

	/************************************************************************
     Fonction qui me permettent d'obtenir le numéro max pour l'entraineur car comme nous avons un héritage, nous ne pouvons pas savoir le dernier numéro grace à conteneurVacataire ou conteneurTitulaire et normalement on a supprimé le conteneuEntraineur.
	 On aurait pu optimisé en ayant qu'une méthode et en faisant passer le nom de la table...
	 *************************************************************************/
	public function donneNumeroMaxEntraineur()
	{
		$stringQuery = "SELECT idEntraineur FROM entraineur";
		$requete = $this->conn->prepare($stringQuery);

		if ($requete->execute()) {
			$nb = 0;
			while ($row = $requete->fetch(PDO::FETCH_NUM)) {
				$nb + 1;
			}
			return $nb + 1;
		} else {
			die('Erreur sur l identifiant de l entraineur : ' + $requete->errorCode());
		}
	}

	public function donneNumeroMaxEquipe()
	{
		$stringQuery = "SELECT * FROM equipe";
		$requete = $this->conn->prepare($stringQuery);
		if ($requete->execute()) {
			$nb = 0;
			while ($row = $requete->fetch(PDO::FETCH_NUM)) {
				$nb + 1;
			}
			return $nb + 1;
		} else {
			die('Erreur sur l identifiant de l equipe : ' + $requete->errorCode());
		}
	}

	public function donneNumeroMaxAdherent()
	{
		$stringQuery = "SELECT * FROM adherent";
		$requete = $this->conn->prepare($stringQuery);
		if ($requete->execute()) {
			$nb = 0;
			while ($row = $requete->fetch(PDO::FETCH_NUM)) {
				$nb + 1;
			}
			return $nb + 1;
		} else {
			die('Erreur sur l identifiant de l adherent : ' + $requete->errorCode());
		}
	}

	public function donneNumeroMaxSpecialite()
	{
		$stringQuery = "SELECT * FROM specialite";
		$requete = $this->conn->prepare($stringQuery);
		if ($requete->execute()) {
			$nb = 0;
			while ($row = $requete->fetch(PDO::FETCH_NUM)) {
				$nb + 1;
			}
			return $nb + 1;
		} else {
			die('Erreur sur l identifiant de l adherent : ' + $requete->errorCode());
		}
	}
}
