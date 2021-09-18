<?php


namespace crise\vue;


class VuePrincipale
{
    private $data;

    public function __construct(array $d)
    {
        $this->data = $d;
    }

    public function getVueUser(){
        $html = "";
        $l = $this->data[0];
        if(is_null($l))
        {
            return "<h2>Liste Inexistante</h2>";
        }

        foreach ($l as $donnees){
            $id = $donnees->idUtilisateur;
            $nom = $donnees->nomUtilisateur;
            $mdp = $donnees->motDePasse;
            $html .=
"<p>
            <strong>ID est</strong> : $id<br />
            nom du l'utilisateur est $nom<br /><em>
            mot de passe est $mdp<br /></em>
</p>";
        }
        return $html;
    }
}