<?php
	class controleur
	{
		private $toutesLesEquipes;
		private $tousLesAdherents;
		private $tousLesVacataires;
		private $tousLesTitulaires;
		private $tousLesEntraineurs;
		private $maBD;
		
/*********************************************************************************************************************
          CONSTRUCTEUR DE NOTRE CONTROLEUR
		       On construit tous les tableux d'objets et on les remplis vec la base de données
*********************************************************************************************************************/
		public function __construct()
		{
			$this->maBD = new accesBD();
			$this->tousLesVacataires = new conteneurVacataire();
			$this->tousLesTitulaires = new conteneurTitulaire();
			$this->toutesLesEquipes = new conteneurEquipe();
			$this->tousLesAdherents = new conteneurAdherent();
			$this->tousLesEntraineurs = new conteneurEntraineur();
			
	
			$this->chargeLesVacataires();
			$this->chargeLesTitulaires();
			$this->chargeLesEquipes();
			$this->chargeLesAdherents();
			$this->chargeLesEntraineurs();
			
			
		}
/*****************************************************************************************
           AFFICHAGE DES ENTETES ET PIED DE PAGE
		   
******************************************************************************************/
        public function afficheEntete()
		{
			//appel de la vue de l'entête
			require 'Vues/ihm/entete.php';
		}
		
			
		public function affichePiedPage()
		{
		//appel de la vue du pied de page
		require 'Vues/ihm/piedPage.php';
		}
		
/******************************************************************************************
          EN FONCTION DE LA VUE DEMANDE ON EFFECTUE TELLE OU TELLE ACTION
********************************************************************************************/
		public function affichePage($action,$vue,$role)
		{
			if (isset($_GET['action']) && isset($_GET['vue']))
			{
				$action = htmlspecialchars($_GET['action']);
				$vue = htmlspecialchars($_GET['vue']);

				switch ($vue)
				{
					case "Entraineur" : 
						$this->actionEntraineur($action,$role);
						break;
					case "Equipe" :
						$this->actionEquipe($action,$role);
						break;
					case "Adherent" :
						$this->actionAdherent($action,$role);
						break;
					case "Connexion" :
						$this->actionConnexion($action,$role);
						break;
				}
			}
		}
/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LA CONNEXION
					- Mise en lace d'un menu spécifique pour chacun des roles
*************************************************************************************************/
	
//---> On aiguille notre action
		public function actionConnexion($action,$role)
		{
			switch ($action)
			{
				case "Verification":
					$_SESSION['role'] = htmlspecialchars($_POST['role']);
					$_SESSION['login'] = htmlspecialchars($_POST['login']);
					$_SESSION['pwd']= htmlspecialchars($_POST['pwd']);
					$csrf=hash_hmac('sha256','Clé sécurité connexion.php',$_SESSION['key']);
					if (isset($_SESSION['role']) and isset($_SESSION['login']) and isset($_SESSION['pwd']))
					{
						
						if(hash_equals($csrf,$_POST['csrf']))
						{
							$vue = new vueCentraleConnexion();
							$existe=$this->maBD->verifExistance($_SESSION['role'],$_SESSION['login'],$_SESSION['pwd']);
							$vue->AfficherMenuContextuel($_SESSION['role'],$existe);
							require 'vues/ihm/nouvelle.php';
							$_SESSION['key']=bin2hex(random_bytes(32));
						}
						else
						{
							echo ('Attaque CSRF');
						}
					}
					else
					{
						echo("Erreur de connexion");
					}
					break;

				case "initialiserTypeNouvelle":
					echo $ListeDesTypesNouvelles=$this->maBD->listeDesNouvellesFormatHTML();
					break;
				case "typeChoixNouvelle":
					$typeNouvelleChoisi=htmlspecialchars($_GET['typeNouvelle']);
					$vue=new vueCentraleConnexion();
					if (isset($_SESSION['login']))
					{
						$existe=$this->maBD->verifExistance($_SESSION['role'],$_SESSION['login'],$_SESSION['pwd']);
						$vue->AfficherMenuContextuel($_SESSION['role'],$existe);
						require 'vues/ihm/nouvelle.php';
					}
					else
					{
						$vue->afficheMenuInternaute();
						require 'vues/ihm/nouvelle.php';
					}
					echo $liste=$this->maBD->listeDesNouvellesPourUnType($typeNouvelleChoisi);
					
					break;
				case "contact":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					require 'vues/ihm/contact.php';
					break;
				case "enregMessage":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					$emailContact = htmlspecialchars($_POST['emailContact']);
					$messageContact = htmlspecialchars($_POST['messageContact']);
					$this->maBD->enregMessage($emailContact,$messageContact);
					require 'vues/ihm/actionOk.php';
					break;
				case "lireMessage":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$message = $this->maBD->listeDesMessages();
					echo $message;
					break;
				case "Deconnexion" :
					session_destroy();
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					require 'vues/ihm/nouvelle.php';
					break;
				
			}
			
		}		
/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LES ENTRAINEURS
					- ajouter un entraineur
					- enregistrer un entraineur
					- visualiser un entraineur
					- modifier un entraineur
*************************************************************************************************/
	
//---> On aiguille notre action
		public function actionEntraineur($action,$role)
		{
			switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$vue = new vueCentraleEntraineur();
					$vue->ajouterEntraineur();
					
					
					
				break;
				case 'SaisirEntraineur':
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$typeEntraineur = htmlspecialchars($_POST['typeEntraineur']);
					$vue = new vueCentraleEntraineur();
					$vue->saisirEntraineur();
					break;
				case 'enregistrer':
					$typeEntraineur = htmlspecialchars($_POST['typeEntraineur']);
					$telEntraineur = null;
					$nomEntraineur=null;
					if ($typeEntraineur == "Vacataire") {
						$nomEntraineur = htmlspecialchars($_POST['nomEntraineur']);
						$loginEntraineur = htmlspecialchars($_POST['loginEntraineur']);
						$pwdEntraineur = htmlspecialchars($_POST['pwdEntraineur']);
						$telEntraineur = htmlspecialchars($_POST['numTelVacataire']);
						$this->tousLesVacataires->ajouterUnVacataire($this->maBD->donneProchainIdentifiant("ENTRAINEUR")+1, $nomEntraineur, $loginEntraineur,$pwdEntraineur,$telEntraineur);
						$this->maBD->insertVacataire($nomEntraineur,$loginEntraineur,$pwdEntraineur,$telEntraineur);
						$vue=new vueCentraleConnexion();
						$vue->afficheMenuAdmin();
						require 'vues/ihm/nouvelle.php';
					}
					else
					{	$nomEntraineur = htmlspecialchars($_POST['nomEntraineur']);
						$loginEntraineur = htmlspecialchars($_POST['loginEntraineur']);
						$pwdEntraineur = htmlspecialchars($_POST['pwdEntraineur']);
						$dateEmbEntraineur = htmlspecialchars($_POST['dateEmbaucheTitulaire']);
						$this->tousLesTitulaires->ajouterUnTitulaire($this->maBD->donneProchainIdentifiant("ENTRAINEUR")+1, $nomEntraineur,  $loginEntraineur,$pwdEntraineur,$dateEmbEntraineur);
						$this->maBD->insertTitulaire($nomEntraineur, $loginEntraineur,$pwdEntraineur,$dateEmbEntraineur);
						$vue=new vueCentraleConnexion();
						$vue->afficheMenuAdmin();
						require 'vues/ihm/nouvelle.php';
					}
					break;
				case "visualiser" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					require 'vues/ihm/nouvelle.php';
					$liste=$this->tousLesTitulaires->listeDesTitulaires();
					$liste = $liste.$this->tousLesVacataires->listeDesVacataires();
					$vue = new vueCentraleEntraineur();
					$vue->VisualiserEntraineur($liste);
					break;
				case "typeEntraineurModifier" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$vue = new vueCentraleEntraineur();
					$vue->typeEntraineur();
					break;
				case "modifier" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$typeEntraineur = htmlspecialchars($_POST['typeEntraineur']);

					if ($typeEntraineur == "Titulaire") 
					{
						$message= $this->tousLesTitulaires->lesTitulairesAuFormatHTML();
						$vue = new vueCentraleEntraineur();
						$vue->modifierEntraineur($message, $typeEntraineur);
					}
					else
					{
						$message= $this->tousLesVacataires->lesVacatairesAuFormatHTML();
						$vue = new vueCentraleEntraineur();
						$vue->modifierEntraineur($message, $typeEntraineur);
					}
					break;
				case "choixFaitPourModif":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$typeEntraineur = htmlspecialchars($_GET['typeEntraineur']);
					echo $typeEntraineur;
					if ($typeEntraineur == "Titulaire") 
					{
						$choix=htmlspecialchars($_GET['idTitulaire']);
						$lEntraineur=$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($choix);
						$vue = new vueCentraleEntraineur();
						$vue->choixFaitPourModifTitulaire($lEntraineur->getNomEntraineur(),$lEntraineur->getDateEmbauche(),$lEntraineur->getLoginEntraineur(),$lEntraineur->getPwdEntraineur(),$choix, $typeEntraineur);	
					}
					else
					{
						$choix=htmlspecialchars($_GET['idVacataire']);
						$lEntraineur=$this->tousLesVacataires->donneObjetVacataireDepuisNumero($choix);
						$vue = new vueCentraleEntraineur();
						$vue->choixFaitPourModifVacataire($lEntraineur->getNomEntraineur(),$lEntraineur->getTelephone(),$lEntraineur->getLoginEntraineur(),$lEntraineur->getPwdEntraineur(),$choix, $typeEntraineur);	
					} 
					break;
				case "EnregModif":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$typeEntraineur = htmlspecialchars($_GET['typeEntraineur']);
					$nomEntraineur=htmlspecialchars($_GET['nomEntraineur']);
					$loginEntraineur=htmlspecialchars($_GET['loginEntraineur']);
					$pwdEntraineur=htmlspecialchars($_GET['pwdEntraineur']);
					$idEntraineur = htmlspecialchars($_GET['idEntraineur']);
					if ($typeEntraineur == "Titulaire") 
					{
						$dateEmbEntraineur=htmlspecialchars($_GET['dateEmbEntraineur']);
						$this->maBD->modifTitulaire($nomEntraineur,$loginEntraineur,$pwdEntraineur,$dateEmbEntraineur,$idEntraineur);
						$this->tousLesTitulaires->modifierUnTitulaire($idEntraineur, $nomEntraineur, $loginEntraineur, $pwdEntraineur, $dateEmbEntraineur);
					}
					else 
					{
						$telEntraineur=htmlspecialchars($_GET['telephoneVacataire']);
						$this->maBD->modifVacataire($nomEntraineur,$loginEntraineur,$pwdEntraineur,$telEntraineur,$idEntraineur);
						$this->tousLesVacataires->modifierUnVacataire($idEntraineur, $nomEntraineur, $loginEntraineur, $pwdEntraineur, $telEntraineur);
					}
				break;		
				case "visualiserSesEquipes" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuEntraineur();
					require 'vues/ihm/nouvelle.php';
					//reste à faire
					break;
				case "modifierSonProfil" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuEntraineur();
					require 'vues/ihm/nouvelle.php';
					//reste à faire
					break;
			}
		}
		
// On a une fonction outil de chargement de notre conteneur
		
		public function chargeLesEntraineurs()
		{   $resultatEntraineur=$this->maBD->chargement('entraineur');
			$nbE=0;
			while ($nbE<sizeof($resultatEntraineur))
			{
				$this->tousLesEntraineurs->ajouterUnEntraineur($resultatEntraineur[$nbE][0],$resultatEntraineur[$nbE][1],$resultatEntraineur[$nbE][2],$resultatEntraineur[$nbE][3]);

				$nbE++;
			}

		}
		
		public function chargeLesVacataires()
		{   $resultatEntraineur=$this->maBD->chargement('entraineur');
			$resultatVacataire=$this->maBD->chargement('vacataire');
			$nbE=0;
			while ($nbE<sizeof($resultatEntraineur))
			{
				$nbV=0;
				while ($nbV<sizeof($resultatVacataire))
				{
					if ($resultatEntraineur[$nbE][0] == $resultatVacataire[$nbV][0])
					{
						$this->tousLesVacataires->ajouterUnVacataire($resultatEntraineur[$nbE][0],$resultatEntraineur[$nbE][1],$resultatEntraineur[$nbE][2],$resultatEntraineur[$nbE][3],$resultatVacataire[$nbV][1]);
					}
					$nbV++;
				}
				$nbE++;
			}
			
		}
	
		public function chargeLesTitulaires()
		{   $resultatEntraineur=$this->maBD->chargement('entraineur');
			$resultatTitulaire=$this->maBD->chargement('titulaire');
			$nbE=0;
			while ($nbE<sizeof($resultatEntraineur))
			{
				$nbT=0;
				while ($nbT<sizeof($resultatTitulaire))
				{
					if ($resultatEntraineur[$nbE][0] == $resultatTitulaire[$nbT][0])
					{
						$this->tousLesTitulaires->ajouterUnTitulaire($resultatEntraineur[$nbE][0],$resultatEntraineur[$nbE][1],$resultatEntraineur[$nbE][2],$resultatEntraineur[$nbE][2],$resultatTitulaire[$nbT][1]);
					}
					$nbT++;
				}
				$nbE++;
			}
			
		}

/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LES EQUIPES
					- ajouter une équipe
					- enregistrer une équipe
					- visualiser une équipe
					- modifier une équipe
*************************************************************************************************/
	
//---> On aiguille notre action
	
		function actionEquipe($action,$role)
		{
			switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$vue = new vueCentraleEquipe();
					$vue->ajouterEquipe();		
					break;
				case 'SaisirEquipe':
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$vue = new vueCentraleEquipe();
					$vue->saisirEquipe($this->tousLesEntraineurs->lesEntraineursAuFormatHTML());
					break;
				case 'enregistrer':
					$nomEquipe = htmlspecialchars($_POST['nomEquipe']);
					$nbrPlaceEquipe = htmlspecialchars($_POST['nbrPlaceEquipe']);
					$ageMinEquipe = htmlspecialchars($_POST['ageMinEquipe']);
					$ageMaxEquipe = htmlspecialchars($_POST['ageMaxEquipe']);
					$sexeEquipe = htmlspecialchars($_POST['sexeEquipe']);
					$idEntraineur = htmlspecialchars($_POST['idEntraineur']);
					$this->toutesLesEquipes->ajouterUneEquipe($this->maBD->donneNumeroMaxEquipe(),$nomEquipe,$nbrPlaceEquipe,$ageMinEquipe,$ageMaxEquipe,$sexeEquipe,$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($idEntraineur));
					$this->maBD->insertEquipe($nomEquipe,$nbrPlaceEquipe,$ageMinEquipe,$ageMaxEquipe,$sexeEquipe,$idEntraineur);
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					break;
				case "visualiser" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					require 'vues/ihm/nouvelle.php';
					$message = $this->toutesLesEquipes->lesEquipesAuFormatHTML();
					$vue = new vueCentraleEquipe();
					$vue->visualiserEquipe($message);
					break;
				case "choixFaitPourVisu":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					require 'vues/ihm/nouvelle.php';
					$choix=htmlspecialchars($_GET['idEquipe']);
					$lEquipe=$this->toutesLesEquipes->donneObjetEquipeDepuisNumero($choix);
					$vue = new vueCentraleEquipe();
					$vue->choixFaitPourVisuEquipe($lEquipe->getNomEquipe(),$lEquipe->getNbrPlaceEquipe(),$lEquipe->getAgeMinEquipe(),$lEquipe->getAgeMaxEquipe(),$lEquipe->getSexeEquipe(),$choix,$this->tousLesTitulaires->lesTitulairesAuFormatHTML());	
					break;
				case "modifier" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$message= $this->toutesLesEquipes->lesEquipesAuFormatHTML();
					$vue = new vueCentraleEquipe();
					$vue->modifierEquipe($message);
					break;
				case "choixFaitPourModif":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$choix=htmlspecialchars($_GET['idEquipe']);
					$lEquipe=$this->toutesLesEquipes->donneObjetEquipeDepuisNumero($choix);
					$vue = new vueCentraleEquipe();
					$vue->choixFaitPourModifEquipe($lEquipe->getNomEquipe(),$lEquipe->getNbrPlaceEquipe(),$lEquipe->getAgeMinEquipe(),$lEquipe->getAgeMaxEquipe(),$lEquipe->getSexeEquipe(),$choix,$this->tousLesTitulaires->lesTitulairesAuFormatHTML());	
					break;
				case "EnregModif":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$idEquipe=htmlspecialchars($_GET['idEquipe']);
					$nomEquipe=htmlspecialchars($_GET['nomEquipe']);
					$nbrPlaceEquipe=htmlspecialchars($_GET['nbrPlaceEquipe']);
					$ageMinEquipe=htmlspecialchars($_GET['ageMinEquipe']);
					$ageMaxEquipe=htmlspecialchars($_GET['ageMaxEquipe']);
					$sexeEquipe=htmlspecialchars($_GET['sexeEquipe']);
					$idTitulaire = htmlspecialchars($_GET['idTitulaire']);
					$leTitulaire = $this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($idTitulaire);
					$this->maBD->modifEquipe($idEquipe,$nomEquipe,$nbrPlaceEquipe,$ageMinEquipe,$ageMaxEquipe,$sexeEquipe,$idTitulaire);
					$this->toutesLesEquipes->modifierUneEquipe($idEquipe, $nomEquipe, $nbrPlaceEquipe, $ageMinEquipe, $ageMaxEquipe, $sexeEquipe, $leTitulaire);
					
			}
		}
		
// On a une fonction outil de chargement de notre conteneur	

		public function chargeLesEquipes()
		{   $resultatEquipe=$this->maBD->chargement('equipe');
			$nbE=0;
			while ($nbE<sizeof($resultatEquipe))
			{
				if ($this->tousLesVacataires->chercherExistanceIdVacataire($resultatEquipe[$nbE][6]))
				{
						$this->toutesLesEquipes->ajouterUneEquipe($resultatEquipe[$nbE][0],$resultatEquipe[$nbE][1],$resultatEquipe[$nbE][2],$resultatEquipe[$nbE][3],$resultatEquipe[$nbE][4],$resultatEquipe[$nbE][5],$this->tousLesVacataires->donneObjetVacataireDepuisNumero($resultatEquipe[$nbE][6]));
				}
				else
				{		$this->toutesLesEquipes->ajouterUneEquipe($resultatEquipe[$nbE][0],$resultatEquipe[$nbE][1],$resultatEquipe[$nbE][2],$resultatEquipe[$nbE][3],$resultatEquipe[$nbE][4],				$resultatEquipe[$nbE][5],$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($resultatEquipe[$nbE][6]));
					
				}
				$nbE++;
			}
		
		}


/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LES ADHERENTS
					- ajouter un adherent
					- enregistrer un adherent
					- visualiser un adherent
					- modifier un adherent
*************************************************************************************************/
//---> On aiguille notre action		
		function actionAdherent($action,$role)
		{
			switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					// a faire car on ajoute toujours le meme pour faire des tests
					$this->tousLesAdherents->ajouterUnAdherent($this->maBD->donneNumeroMaxAdherent(),'Essai','adherent',12,'F','essai','essai',$this->toutesLesEquipes->donneObjetEquipeDepuisNumero(3));
					$this->maBD->insertAdherent('Essai','adherent',12,'F','essai','essai',3);
					break;
				
				
					// case "ajouter":
					// 	$vue=new vueCentraleConnexion();
					// 	$vue->afficheMenuAdmin();
					/// 	require 'vues/ihm/nouvelle.php';
					// 	$vue = new vueCentraleEquipe();
					// 	$vue->ajouterEquipe();		
					// 	break;
					// case 'SaisirEquipe':
					// 	$vue=new vueCentraleConnexion();
					// 	$vue->afficheMenuAdmin();
					// 	require 'vues/ihm/nouvelle.php';
					// 	$vue = new vueCentraleEquipe();
					// 	$vue->saisirEquipe($this->tousLesEntraineurs->lesEntraineursAuFormatHTML());
					// 	break;
					// case 'enregistrer':
					// 	$nomEquipe = htmlspecialchars($_POST['nomEquipe']);
					// 	$nbrPlaceEquipe = htmlspecialchars($_POST['nbrPlaceEquipe']);
					// 	$ageMinEquipe = htmlspecialchars($_POST['ageMinEquipe']);
					// 	$ageMaxEquipe = htmlspecialchars($_POST['ageMaxEquipe']);
					// 	$sexeEquipe = htmlspecialchars($_POST['sexeEquipe']);
					// 	$idEntraineur = htmlspecialchars($_POST['idEntraineur']);
					// 	$this->toutesLesEquipes->ajouterUneEquipe($this->maBD->donneNumeroMaxEquipe(),$nomEquipe,$nbrPlaceEquipe,$ageMinEquipe,$ageMaxEquipe,$sexeEquipe,$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($idEntraineur));
					// 	$this->maBD->insertEquipe($nomEquipe,$nbrPlaceEquipe,$ageMinEquipe,$ageMaxEquipe,$sexeEquipe,$idEntraineur);
					// 	$vue=new vueCentraleConnexion();
					// 	$vue->afficheMenuAdmin();
					// 	require 'vues/ihm/nouvelle.php';
					// 	break;
				
				
				
				
				
				
				
				
					case "visualiser" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					require 'vues/ihm/nouvelle.php';
					$message = $this->tousLesAdherents->listeDesAdherents();
					$vue = new vueCentraleAdherent();
					$vue->visualiserAdherent($message);
					break;

				case "modifier" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					require 'vues/ihm/nouvelle.php';
					$vue = new vueCentraleAdherent();
					$vue->modifierAdherent();
					break;
				case "modifierSonProfil" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					$vue = new vueCentraleAdherent(); 
					require 'vues/ihm/nouvelle.php';
					$adherent = $this->tousLesAdherents->donneObjetAdherentDepuisLogin($_SESSION['login']);
					$vue->modifierProfil($adherent);
					break;

				case "changerMDP" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					$vue = new vueCentraleAdherent(); 
					require 'vues/ihm/nouvelle.php';
					$vue->changerMDP();
					break;
				case "verifMDP" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					$vue = new vueCentraleAdherent(); 
					require 'vues/ihm/nouvelle.php';

					$MDP = $_POST['MDP'];
					if(preg_match("#^\S*(?=\S{12,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$#",$MDP)){

						try{
							$adherent = $this->tousLesAdherents->donneObjetAdherentDepuisLogin($_SESSION['login']);
							$this->tousLesAdherents->modifierMDP($adherent, $MDP);
							$this->maBD->modifMDP($adherent,$MDP);
						}
						catch(Exception $e){

						}


					}
					else{
						$vue->changerMDP(true);
					}
					break;
				case "EnregistrerProfil" : 
					$vue= new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					require 'vues/ihm/nouvelle.php';
					$idAdherent = htmlspecialchars($_POST['idAdherent']);
					$nomAdherent = htmlspecialchars($_POST['nomAdherent']);
					$prenomAdherent = htmlspecialchars($_POST['prenomAdherent']);
					$ageAdherent = htmlspecialchars($_POST['ageAdherent']);
					$sexeAdherent = htmlspecialchars($_POST['sexeAdherent']);
					$loginAdherent = htmlspecialchars($_POST['loginAdherent']);
					$this->tousLesAdherents->modifierUnAdherent($idAdherent,$nomAdherent,$prenomAdherent,$ageAdherent,$sexeAdherent,$loginAdherent);
					$this->maBD->modifProfil($idAdherent,$nomAdherent,$prenomAdherent,$ageAdherent,$sexeAdherent,$loginAdherent);
					break;
				case "voyager" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					$vue = new vueCentraleAdherent();
					require 'vues/ihm/nouvelle.php';
					$vue->voyagerAdherent();
					break;
				case "voirProfil" :
					$vue= new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					$vue = new vueCentraleAdherent(); 
					require 'vues/ihm/nouvelle.php';
					$adherent = $this->tousLesAdherents->donneObjetAdherentDepuisLogin($_SESSION['login']);
					$vue->voirProfil($adherent);
			}
		}

// On a une fonction outil de chargement de notre conteneur	
	
		public function chargeLesAdherents()
		{   $resultatAdherent=$this->maBD->chargement('adherent');
			$nbA=0;
			while ($nbA<sizeof($resultatAdherent))
			{
				$this->tousLesAdherents->ajouterUnAdherent($resultatAdherent[$nbA][0],$resultatAdherent[$nbA][1],$resultatAdherent[$nbA][2],$resultatAdherent[$nbA][3],$resultatAdherent[$nbA][4],$resultatAdherent[$nbA][5],$resultatAdherent[$nbA][6],$this->toutesLesEquipes->donneObjetEquipeDepuisNumero($resultatAdherent[$nbA][6]));
				$nbA++;
			}
		}
	
	}
?>

	
	
