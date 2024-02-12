<?php

namespace Controllers;

use PDO;
use Candidat;
use Centre;

class CandidatController extends Controller
{
    public function panelCandidat($params) {
        $entityManager = $params["em"];
        $candidatRepository = $entityManager->getRepository(Candidat::class);
        $candidats = $candidatRepository->findAll();

        $centreNames = [];
        foreach ($candidats as $candidat) {
            $centreNames[$candidat->getId()] = $candidat->getCentre()->getNom();
        }
        echo $this->twig->render('crudCandidat.html', ['candidats' => $candidats, 'centreNames' => $centreNames, 'params' => $params]);
    }



    public function createCandidat($params) {
        $entityManager = $params["em"];
        $centres = $entityManager->getRepository(Centre::class)->findAll();

        echo $this->twig->render('createCandidat.html', ['centres'=>$centres]);
    }

    public function insert($params) {
        $em = $params['em'];

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $centre_id = $_POST['centre'];
        $centres = $em->find(Centre::class, $centre_id);
        $num = $_POST['num'];
        $avatar = file_get_contents($_FILES['photo']['tmp_name']);
        $option = $_POST['option'];
        $url = $_POST['url'];

        $newCandidat = new Candidat();
        $newCandidat->setNom($nom);
        $newCandidat->setPrenom($prenom);
        $newCandidat->setCentre($centres);
        $newCandidat->setNumeroCandidat($num);
        $newCandidat->setAvatar($avatar);
        $newCandidat->setOption($option);
        $newCandidat->setUrl($url);

        $em->persist($newCandidat);
        $em->flush();

        header('Location: start.php?c=candidat&t=panelcandidat');
    }

    public function deleteCandidat($params) {
        $id = $params['get']['id'];
        $em = $params['em'];
        $candidat = $em->find(Candidat::class, $id);

        $em->remove($candidat);
        $em->flush();

        header('Location: start.php?c=candidat&t=panelcandidat');
    }

    public function editCandidat($params) {
        $entityManager = $params["em"];
        $centres = $entityManager->getRepository(Centre::class)->findAll();

        $id = $params['get']['id'];
        $em = $params['em'];
        $candidat = $em->find(Candidat::class, $id);

        echo $this->twig->render('editCandidat.html',['candidat' => $candidat , 'centres' => $centres]);
    }

    public function updateCandidat($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $candidat = $em->find(Candidat::class, $id);

        $candidat->setNom($params['post']['nom']);
        $candidat->setPrenom($params['post']['prenom']);
        $candidat->setNumeroCandidat($params['post']['num']);
        $candidat->setOption($params['post']['option']);
        $candidat->setUrl($params['post']['url']);
        if (!empty($_FILES['photo']['tmp_name'])) {
            $candidat->setAvatar(file_get_contents($_FILES['photo']['tmp_name']));
        }

        $centre_id = $params['post']['centre'];
        $centre = $em->find(Centre::class, $centre_id);
        $candidat->setCentre($centre);

        $em->flush();

        header('Location: start.php?c=candidat&t=panelcandidat');
        exit();
    }
}
