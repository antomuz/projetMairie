<div class="dropdown col">
	<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Menu Entraîneur 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
		<li><a class="dropdown-item" href='index.php?vue=Entraineur&action=visualiser'>Visualiser les entraineurs</a></li>
	</ul>
</div>
<div class="dropdown col">
	<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEquipe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		Menu Equipe 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="menuEquipe">
		<li><a class="dropdown-item" href = 'index.php?vue=Equipe&action=visualiser'>Visualiser les équipes</a></li>
	</ul>
</div>
<div class="dropdown col">
	<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		Menu Adherent 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="menuAdherent">
		<li><a class="dropdown-item" href = 'index.php?vue=Adherent&action=visualiser'>Visualiser les Adherents</a></li>
	</ul>
</div>
<div class="dropdown col">
	<button class="btn bg-transparent dropdown-toogle" type="button" id="contact" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		Contact 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="contact">
		<li><a class="dropdown-item" href = 'index.php?vue=Connexion&action=contact'>Laisser un message</a></li>
	</ul>
</div>

</div>
</div>

		<div class="container">
			<div class="row">
				<div class ="col-md-2 col-xs-12 infosComplementaires">
					<?php require "vues/ihm/connexion.php";?>
					<?php require "vues/ihm/deconnexion.php";?>
					<br> <p align=center>Choisir le thème des nouvelles que vous souhaitez afficher </p><br>
					<?php 
						echo '<form action=index.php method=GET align=center>';
									$_GET['vue']='Connexion';
									$_GET['action']='initialiserTypeNouvelle';
									$monControleur->affichePage($_GET['action'],$_GET['vue'],$role);
									echo '<br> <br> 
									<input type=hidden name=vue value=Connexion></input>
									<input type=hidden name=action value=typeChoixNouvelle></input>
									<button type="submit" class="btn btn-primary">Valider</button>
							 </form>';
					?>
				</div>
				<div class="col-md-10 col-xs-12 ">