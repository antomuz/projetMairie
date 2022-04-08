<?php echo '
<br><br> 
<p align=center>Choisir le thème des nouvelles que vous souhaitez afficher </p><br><br>
<form action=index.php method=GET align=center>';
	$_GET['vue']='Connexion';
	$_GET['action']='initialiserTypeNouvelle';
	$this->affichePage($_GET['action'],$_GET['vue'],$role);
	echo '<br> <br> 
	<input type=hidden name=vue value=Connexion></input>
	<input type=hidden name=action value=typeChoixNouvelle></input>
	<button type="submit" class="btn btn-primary">Valider</button>
</form>
					
</div>
<div class="col-md-10 col-xs-12 ">';
				
											
echo '
<script>
function showHint(str) 
{
  if (str.length == 0) 
  {
    document.getElementById("mailHint").innerHTML = "";
    return;
  } 
  else 
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
	{
      if (this.readyState == 4 && this.status == 200) 
	  {
        document.getElementById("mailHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "emailHint.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<form action=index.php?vue=Connexion&action=enregMessage method=POST>
	<label for=emailContact>Saisir votre email</label><br>
	<input type=text name=emailContact onkeyup="showHint(this.value)"></input> <br><br>
	<p>Suggestions: <span id="mailHint"></span></p><br>
	<label>Saisir un message</label><br>
	<textarea rows=4 cols=50 name=messageContact ></textarea><br><br>
	<button type="submit" class="btn btn-primary">Valider</button>
</form>';
?>