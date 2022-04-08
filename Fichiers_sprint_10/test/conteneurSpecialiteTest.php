<?php
use PHPUnit\Framework\TestCase;
require_once ("C:\wamp64\www\projetMairie\Fichiers_sprint_10\Traitement\classeConteneur\conteneurSpecialite.php");
require_once ("C:\wamp64\www\projetMairie\Fichiers_sprint_10\Traitement\classeMetier\metierSpecialite.php");
class conteneurSpecialiteTest extends TestCase 
{
    private conteneurSpecialite $conteneur;

    /**
    * @before
    */
    public function initTestEnvironment()
    {
        $this->conteneur = new conteneurSpecialite();

    }

    public function testnbSpecialite()
    {
        $this->assertEquals(0, $this->conteneur->nbSpecialite());
        $this->conteneur->ajouterUneSpecialite(1, "foot");
        $this->conteneur->ajouterUneSpecialite(2, "volley");
        $this->assertEquals(2, $this->conteneur->nbSpecialite());
        $this->conteneur->ajouterUneSpecialite(3, "javelo");
        $this->assertEquals(3, $this->conteneur->nbSpecialite());
    }

}
?>