<?php

class vueCentraleConnexion
{
	public function __construct()
	{
	}

	public function AfficherMenuContextuel($role, $existe)
	{
		if ($existe == 1) {
			switch ($role) {
				case "2":
					$this->afficheMenuAdherent();

					break;
				case "3":
					$this->afficheMenuEntraineur();

					break;
				case "1":
					$this->afficheMenuAdmin();
					break;
			}
		} else {
			//header('Location: index.php?erreur=1');
			echo "Erreur de connexion";
			$this->afficheMenuInternaute();
		}
	}

	public function afficheMenuInternaute()
	{
		echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Menu Entraîneur 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=visualiser>Visualiser les entraineurs</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEquipe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Equipe 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEquipe">
					<li><a class="dropdown-item" href=index.php?vue=Equipe&action=visualiser>Visualiser une équipe</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Adherent 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=visualiser>Visualiser les Adherents</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuSpe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Sport
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuSpe">
					<li><a class="dropdown-item" href=index.php?vue=Specialite&action=visualiser>Visualiser les sports</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="contact" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Contact 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="messages">
					<li><a class="dropdown-item" href=index.php?vue=Connexion&action=contact>écrire un message</a></li>
				</ul>
			</div>
			</div>	
			</div>
		<div class="container">
			<div class="row">
				<div class ="col-md-2 col-xs-12 infosComplementaires">';
		require "vues/ihm/connexion.php";
		require "vues/ihm/deconnexion.php";
	}


	public function afficheMenuAdherent()
	{
		echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Mon profil 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=modifierSonProfil>Modifier son profil</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=voirProfil>Voir son profil</a></i>
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=changerMDP>Changer MDP</a></i>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Me déplacer 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=voyager>Aller en déplacement</a></li>
				</ul>
			</div>
			
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class ="col-md-2 col-xs-12 infosComplementaires">';
		require "vues/ihm/connexion.php";
		require "vues/ihm/deconnexion.php";
	}
	public function afficheMenuEntraineur()
	{
		echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Mon profil 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=modifierSonProfil>Modifier son profil</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=modifierSesSpecialites>Modifier ses spécialités</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=changerMDP>Modifier son mot de passe</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=voirSesSpes>Voir ses spécialités</a></li>

				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Mes sportifs 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=visualiserSesEquipes>Visualiser ses Adherents</a></li>
				</ul>
			</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class ="col-md-2 col-xs-12 infosComplementaires">
					';
		require "vues/ihm/connexion.php";
		require "vues/ihm/deconnexion.php";
	}

	public function afficheMenuAdmin()
	{
		echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Menu Entraîneur 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=ajouter>Ajouter un Entraineur</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=typeEntraineurModifier>Modifier un entraineur</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuSpe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Menu Spécialité
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuSpe">
					<li><a class="dropdown-item" href=index.php?vue=Specialite&action=ajouter>Ajouter une spécialité</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Specialite&action=modifier>Modifier une spécialité</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEquipe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Equipe 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEquipe">
					<li><a class="dropdown-item" href=index.php?vue=Equipe&action=ajouter>Ajouter une équipe</a></li>
					<li><a class=dropdown-item href=index.php?vue=Equipe&action=modifier>Modifier une équipe</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Adherent 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=ajouter>Ajouter un Adherent</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=modifier>Modifier un Adherent</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Gestion Messages 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="messages">
					<li><a class="dropdown-item" href=index.php?vue=Connexion&action=lireMessage>Lire les messages</a></li>
				</ul>
			</div></div>
		</div>
		<div class="container">
			<div class="row">
				<div class ="col-md-2 col-xs-12 infosComplementaires">';
		require "vues/ihm/connexion.php";
		require "vues/ihm/deconnexion.php";
	}
}
