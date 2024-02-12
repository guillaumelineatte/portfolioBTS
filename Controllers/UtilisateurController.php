<?php

namespace Controllers;

use Utilisateur;

class UtilisateurController extends Controller {

    public function verifLogin($params) {
        $em = $params['em'];

        $email = ($_POST['email']);
        $password = ($_POST['password']);

        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from(Utilisateur::class, 'u')
            ->where('u.email = :email')
            ->andWhere('u.password = :password')
            ->setParameter('email', $email)
            ->setParameter('password', $password);

        $query = $qb->getQuery();
        $utilisateur = $query->getOneOrNullResult();

        if ($utilisateur) {
            $_SESSION['utilisateur_id'] = $utilisateur->getId();
            $_SESSION['utilisateur_nom'] = $utilisateur->getNom();
            $_SESSION['utilisateur_prenom'] = $utilisateur->getPrenom();
            $_SESSION['utilisateur_email'] = $utilisateur->getEmail();

            echo json_encode(['status' => 'success']);

        } else {
            echo $this->twig->render('portfolio.html',['error' => 'Identifiants invalides']);
            echo json_encode(['status' => 'error']);
        }

    }

    public function logout()
{
    session_destroy();
    echo json_encode(['status' => 'success']);
}

    public function checkLoginStatus()
    {
        if ($this->isLoggedIn()) {
            echo json_encode(['isLoggedIn' => true]);
        } else {
            echo json_encode(['isLoggedIn' => false]);
        }
    }

}

?>
