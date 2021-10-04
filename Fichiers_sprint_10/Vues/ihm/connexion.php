<!-- Le bouton qui va lancer la modal -->
<button type="button" class="btn bg-transparent" data-toggle="modal" data-target="#connexion">
  Se connecter
</button>

<!-- La modal -->
<div class="modal fade" id="connexion" tabindex="-1" role="dialog" aria-labelledby="maConnexion" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header" style="text-align:center">
        		<h5 class="modal-title" id="maConnexion">Saisir vos identifiants</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
      		</div>
			<div class="modal-body">
				<div class="container">
					<form action=index.php?vue=Connexion&action=Verification method=POST align=center>
						<div class="row">
							<div class="col-sm">
								<input type="radio" name="role" value="1" id="admin">
								<label for="admin">Admin</label>
							</div>
							
							<div class="col-sm">
								<input type="radio" name="role" value="2" id="adherent">
								<label for="adherent">Adherent</label>
							</div>
							
							<div class="col-sm">
								<input type="radio" name="role" value="3" id="entraineur">
								<label for="entraineur">Entraineur</label>
							</div>
						</div>
						<div class="row" style="padding-top:1em">
							<div class="col-sm">
								<input type=text name=login value="Login"></input>
							</div>
						</div>

						<div class="row" style="padding-top:1em">
							<div class="col-sm">
								<input type=password name=pwd value="Pwd"></input>
							</div>
						</div>

						<div class="row" style="padding-top:1em">
							<div class="col-sm">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
								<button type="submit" class="btn btn-primary">Valider</button>
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>