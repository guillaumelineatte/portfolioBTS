<?php

namespace Controllers;

use PDO;
use Centre;

class CentreController extends Controller
{
    public function panelCentre($params) {
        $entityManager = $params["em"];
        $centreRepository = $entityManager->getRepository('Centre');
        $centres = $centreRepository->findAll();

        echo $this->twig->render('crudCentre.html', ['centres' => $centres, 'params' => $params]);
    }

    public function createCentre() {
        echo $this->twig->render('createCentre.html');
        }

    public function insert($params) {
        $em=$params['em'];

        $nom=($_POST['nom']);
        $adresse=($_POST['adresse']);
        $ville = ($_POST['ville']);

        $newCentre = new Centre();
        $newCentre->setNom($nom);
        $newCentre->setAdresse($adresse);
        $newCentre->setVille($ville);


        $em->persist($newCentre);
        $em->flush();

        header('Location: start.php?c=centre&t=panelcentre');
    }

    public function deleteCentre($params) {
        $id = ($params['get']['id']);
        $em = $params['em'];
        $centre = $em->find('Centre', $id);

        $candidatRepository = $em->getRepository('Candidat');
        $candidatsAffilies = $candidatRepository->findBy(['centre' => $centre]);

        if (!empty($candidatsAffilies)) {
            $errorMessage = "Impossible de supprimer ce centre car des candidats y sont affiliés.";
            echo $this->twig->render('error.html', ['errorMessage' => $errorMessage]);
        } else {
            $em->remove($centre);
            $em->flush();
            header('Location: start.php?c=centre&t=panelcentre');
        }
    }


    public function editCentre($params) {
        $entityManager = $params["em"];

        $id=($params['get']['id']);
        $em=$params['em'];
        $centre=$em->find(Centre::class,$id);

        echo $this->twig->render('editCentre.html',['centre'=>$centre]);
    }

    public function updateCentre($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $centre = $em->find('Centre', $id);

        $centre->setNom($params['post']['nom']);
        $centre->setAdresse($params['post']['adresse']);
        $centre->setVille($params['post']['ville']);

        $em->flush();

        header('Location: start.php?c=centre&t=panelcentre');
        exit();
    }
}
