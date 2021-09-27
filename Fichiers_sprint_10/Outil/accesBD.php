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
		$this->hote="localhost";
		$this->login="root";
		$this->passwd="";
		$this->base="clubAussonne";
		$this->connexion();
		
		}
	private function connexion()
	{
		try
        {
            $this->conn = new PDO("mysql:host=".$this->hote.";dbname=".$this->base.";charset=utf8", $this->login, $this->passwd);
            $this->boolConnexion = true;
        }
        catch(PDOException $e)
        {
            die("Connection à la base de données échouée".$e->getMessage());
        }
	}
	
	public function verifExistance($role,$login,$pwd)
	{   
	
		switch ($role)
		{
			case "1" :
				$requete='SELECT idAdmin FROM administrateur where loginAdmin = "'.$login.'" and pwdAdmin = "'.md5($pwd).'" ;';
				break;
			case "2" :
				$requete='SELECT idAdherent FROM adherent where loginAdherent =  "'.$login.'" and pwdAdherent = "'.md5($pwd).'" ;';
				break;
			case "3" :
				$requete='SELECT idEntraineur FROM entraineur where loginEntraineur =  "'.$login.'" and pwdEntraineur = "'.md5($pwd).'" ;';
				break;
		}
		
		$result=$this->conn->query($requete);
		
		if ($result)
    	{
			if ($result->rowCount()==1)
			{
				return(1);
			}
			else
			{
				return(0);
			}
		}
	}	
	
	public function enregMessage($emailContact,$messageContact)
	{   
		$requete='INSERT INTO message (emailContact, messageContact) VALUES ("'.$emailContact.'","'.$messageContact.'");';
		$result=$this->conn->query($requete);
		
		
	}

	public function listeDesMessages()
	{
		$requete='select * from message;';
		$retour = '';
		$result=$this->conn ->query($requete);
		while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
		{
			$retour = $retour . $row->idMessage . '|' . $row->emailContact . '|'. $row->messageContact . '<br>';
		};
		
		return $retour;
			
	}		
	
	public function listeDesNouvellesFormatHTML()
	{
		$requete='select * from typeNouvelle;';
		$retour = '<select name=typeNouvelle>';
		$result=$this->conn ->query($requete);
		while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
		{
			$retour = $retour . '<option value="' . $row->idTypeNouvelle . '">' . $row->libelleTypeNouvelle . '</option>';
		}
		$retour = $retour .'</select>';
		echo $retour;
			
	}	
	
	public function listeDesNouvellesPourUnType($idTypeNouvelleChoisi)
	{
		try{
			$requete='SELECT idNouvelle, dateParutionNouvelle, descriptionNouvelle FROM nouvelle where idTypeNouvelle =  '.$idTypeNouvelleChoisi.' ;';
			$result=$this->conn ->query($requete);
			$retour='';
			while ( $row = $result->fetch(PDO::FETCH_OBJ ) )
			{
				$retour = $retour.'|'.$row->idNouvelle.'|'.$row->dateParutionNouvelle.'|'.$row->descriptionNouvelle;
			}
			return $retour;
		}
		catch(PDOException $e)
        {
            die("erreur dans la requête".$e->getMessage());
        }

		
			
	}	

	
	/******************************************************************************
	Nous avons toutes les fonctions d'insertion
	*******************************************************************************/
	public function insertVacataire($unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur,$unTelephone)
	{
		$sonId = $this->donneProchainIdentifiant("ENTRAINEUR","idEntraineur");
		$requete = $this->conn->prepare("INSERT INTO ENTRAINEUR (idEntraineur,nomEntraineur,loginEntraineur,pwdEntraineur) VALUES (?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomEntraineur);
		$requete->bindValue(3,$unLoginEntraineur);
		$requete->bindValue(4,md5($unPwdEntraineur));
		if(!$requete->execute())
		{
			die("Erreur dans insert Entraineur : ".$requete->errorCode());
		}
		
		$requete = $this->conn->prepare("INSERT INTO vacataire (idEntraineur,telephoneVacataire) VALUES (?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unTelephone);
		if(!$requete->execute())
		{
			die("Erreur dans insert Vacataire : ".$requete->errorCode());
		}
		return $sonId;
	}
		
	public function insertTitulaire($unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur,$uneDateEmbauche)
	{
		$sonId = $this->donneProchainIdentifiant("ENTRAINEUR","idEntraineur");
		$requete = $this->conn->prepare("INSERT INTO ENTRAINEUR (idEntraineur,nomEntraineur,loginEntraineur,pwdEntraineur) VALUES (?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomEntraineur);
		$requete->bindValue(3,$unLoginEntraineur);
		$requete->bindValue(4,md5($unPwdEntraineur));
		if(!$requete->execute())
		{
			die("Erreur dans insert Entraineur : ".$requete->errorCode());
		}
		
		$requete = $this->conn->prepare("INSERT INTO titulaire (idEntraineur,dateEmbauche) VALUES (?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$uneDateEmbauche);
		if(!$requete->execute())
		{
			die("Erreur dans insert Titulaire : ".$requete->errorCode());
		}

		return $sonId;
	}
		
	public function insertEquipe($unNomEquipe,$unNbrPlaceEquipe,$unAgeMinEquipe,$unAgeMaxEquipe,$unSexeEquipe,$unIdEntraineur)
	{
		$sonId = $this->donneProchainIdentifiant("EQUIPE","idEquipe");
		$requete = $this->conn->prepare("INSERT INTO EQUIPE (idEquipe,nomEquipe,nbrPlaceEquipe,ageMinEquipe,ageMaxEquipe,sexeEquipe,idEntraineur) VALUES (?,?,?,?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomEquipe);
		$requete->bindValue(3,$unNbrPlaceEquipe);
		$requete->bindValue(4,$unAgeMinEquipe);
		$requete->bindValue(5,$unAgeMaxEquipe);
		$requete->bindValue(6,$unSexeEquipe);
		$requete->bindValue(7,$unIdEntraineur);
		if(!$requete->execute())
		{
			die("Erreur dans insert Equipe : ".$requete->errorCode());
		}
		return $sonId;
	}
	
	
		
	public function insertAdherent($unNomAdherent,$unPrenomAdherent,$unAgeAdherent, $unSexeAdherent,$unLoginAdherent, $unPwdAdherent,$unIdEquipe)
	{
		$sonId = $this->donneProchainIdentifiant("ADHERENT","idAdherent")+1;
		$requete = $this->conn->prepare("INSERT INTO ADHERENT (idAdherent,nomAdherent, prenomAdherent, ageAdherent, sexeAdherent,loginAdherent, pwdAdherent,idEquipe) VALUES (?,?,?,?,?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomAdherent);
		$requete->bindValue(3,$unPrenomAdherent);
		$requete->bindValue(4,$unAgeAdherent);
		$requete->bindValue(5,$unSexeAdherent);
		$requete->bindValue(6,$unLoginAdherent);
		$requete->bindValue(7,md5($unPwdAdherent));
		$requete->bindValue(8,$unIdEquipe);
		if(!$requete->execute())
		{
			die("Erreur dans insert Adherent : ".$requete->errorCode());
		}
		return $sonId;
	}
	
	/***********************************************************************************************
	méthode qui va permettre de modifier les éléments d'une équipe.
	***********************************************************************************************/
	public function modifEquipe($idEquipe,$unNomEquipe,$unNbrPlaceEquipe,$unAgeMinEquipe,$unAgeMaxEquipe,$unSexeEquipe,$unIdEntraineur)
	{	$requete = $this->conn->prepare("UPDATE equipe SET nomEquipe = ?, nbrPlaceEquipe = ?, ageMinEquipe = ?, ageMaxEquipe = ?, sexeEquipe = ?, idEntraineur = ? where idEquipe = ?");
		
		$requete->bindValue(1,$unNomEquipe);
		$requete->bindValue(2,$unNbrPlaceEquipe);
		$requete->bindValue(3,$unAgeMinEquipe);
		$requete->bindValue(4,$unAgeMaxEquipe);
		$requete->bindValue(5,$unSexeEquipe);
		$requete->bindValue(6,$unIdEntraineur);
		$requete->bindValue(7,$idEquipe);
		
		echo "La modification est effectuée.";
		
		if(!$requete->execute())
		{
			die("Erreur dans modif Equipe : ".$requete->errorCode());
		}
		return $idEquipe;
	}
	
	/***********************************************************************************************
	C'est la fonction qui permet de charger les tables et de les mettre dans un tableau 2 dimensions. La petite fontions specialCase permet juste de psser des minuscules aux majuscules pour les noms des tables de la base de données
	************************************************************************************************/
	public function chargement($uneTable)
	{
		$lesInfos=null;
		$nbTuples=0;
		$stringQuery="SELECT * FROM ";
		$stringQuery = $this->specialCase($stringQuery,$uneTable);
		$query = $this->conn->prepare($stringQuery);
		if($query->execute())
		{
			while($row = $query->fetch(PDO::FETCH_NUM))
			{
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		}
		else
		{
			die('Problème dans chargement : '.$query->errorCode());
		}
		return $lesInfos;
	}

	private function specialCase($stringQuery,$uneTable)
	{
			$uneTable = strtoupper($uneTable);
			switch ($uneTable) {
			case 'VACATAIRE':
				$stringQuery.='vacataire';
				break;
			case 'EQUIPE':
				$stringQuery.='equipe';
				break;
			case 'ADHERENT':
				$stringQuery.='adherent';
				break;
			case 'ENTRAINEUR':
				$stringQuery.='entraineur';
				break;
			case 'TITULAIRE':
				$stringQuery.='titulaire';
				break;
			default:
				die('Pas une table valide');
				break;
			}

			return $stringQuery.";";
	}
	
	/**************************************************************************
	fonction qui permet d'avoir le prochain identifiant de la table. Elle est là uniquement parce que nous n'avons pas d'autoincremente dans notre base de données
	***************************************************************************/
	public function donneProchainIdentifiant($uneTable)
	{
		$stringQuery = $this->specialCase("SELECT * FROM ",$uneTable);
		$requete = $this->conn->prepare($stringQuery);
		//$requete->bindValue(1,$unIdentifiant);

		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb = $row[0];
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur donneProchainIdentifiant : '+$requete->errorCode());
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

		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb + 1;
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur l identifiant de l entraineur : '+$requete->errorCode());
		}
	}
	
	public function donneNumeroMaxEquipe()
	{
		$stringQuery = "SELECT * FROM equipe";
		$requete = $this->conn->prepare($stringQuery);
		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb + 1;
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur l identifiant de l equipe : '+$requete->errorCode());
		}
	}
	
	public function donneNumeroMaxAdherent()
	{
		$stringQuery = "SELECT * FROM adherent";
		$requete = $this->conn->prepare($stringQuery);
		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
			$nb + 1;
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur l identifiant de l adherent : '+$requete->errorCode());
		}
	}
		
}