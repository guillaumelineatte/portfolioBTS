<?php

namespace Controllers;

class UserController extends Controller {

    public function create() {
        $stmt = $this->db->query("SELECT id, ville_nom 
                                  FROM villes_france_free 
                                  LIMIT 20");
        $villes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        echo $this->twig->render('create.html', ['villes' => $villes]);
    }
    
    public function insert()
{
    try {

        $user_nom = $_POST['nom'];
        $user_prenom = $_POST['prenom'];
        $ville_id = $_POST['ville_id'];

        $stmt = $this->db->prepare("INSERT INTO user (user_nom, user_prenom, ville_id) VALUES (:nom, :prenom, :ville_id)");
        $stmt->bindParam(':nom', $user_nom);
        $stmt->bindParam(':prenom', $user_prenom);
        $stmt->bindParam(':ville_id', $ville_id);

        $stmt->execute();

        echo "Les données ont été insérées avec succès.";
    } 
    catch (\PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
        }
        header('Location: /guillaume/site/views/list.html');
            exit();
    }

    public function list() {
        try {
            $stmt = $this->db->query("SELECT u.user_nom, u.user_prenom, v.ville_nom
                                      FROM user u
                                      LEFT JOIN villes_france_free v ON u.ville_id = v.id");
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            echo $this->twig->render('list.html', ['users' => $users]);
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération des données : " . $e->getMessage();
        }
    }
}
?>