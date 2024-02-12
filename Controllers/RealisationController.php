<?php

namespace Controllers;

use PDO;
use Competence;
use Realisation;

class RealisationController extends Controller {

    public function panelrealisation($params) {
        $entityManager = $params["em"];
        $realisationRepository = $entityManager->getRepository(Realisation::class);
        $realisations = $realisationRepository->findAll();
        $competenceNames = [];

        foreach ($realisations as $realisation) {
            $competences = $realisation->getCompetences();
            $competenceNames[$realisation->getId()] = [];
            foreach ($competences as $competence) {
                $competenceNames[$realisation->getId()][] = $competence->getShortLib();
            }
        }

        echo $this->twig->render('crudRealisation.html', ['realisations' => $realisations, 'competenceNames' => $competenceNames, 'params' => $params]);
    }




    public function createRealisation($params) {
        $entityManager = $params["em"];
        $competences = $entityManager->getRepository(Competence::class)->findAll();


        echo $this->twig->render('createRealisation.html', ['competences' => $competences]);
    }

    public function insert($params) {
        $em = $params['em'];

        $lib = ($_POST['lib']);
        $competence_id = $_POST['competence'];
        $competences = $em->find(Competence::class, $competence_id);

        $newRealisation = new Realisation();
        $newRealisation->setLib($lib);
        $newRealisation->addCompetence($competences);


        $em->persist($newRealisation);
        $em->flush();

        header('Location: start.php?c=realisation&t=panelrealisation');
    }

    public function deleteRealisation($params) {
        $id = ($params['get']['id']);
        $em = $params['em'];
        $realisation = $em->find('Realisation', $id);

        $em->remove($realisation);
        $em->flush();

        header('Location: start.php?c=realisation&t=panelrealisation');
    }

    public function editRealisation($params) {
        $entityManager = $params["em"];
        $competences = $entityManager->getRepository(Competence::class)->findAll();

        $id = ($params['get']['id']);
        $em = $params['em'];
        $realisation = $em->find(Realisation::class, $id);

        echo $this->twig->render('editRealisation.html', ['realisation' => $realisation, 'competences' => $competences]);
    }

    public function updateRealisation($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $realisation = $em->find(Realisation::class, $id);
        $lib = $params['post']['lib'];
        $competenceIds = $params['post']['competences'];
        $competences = [];
        foreach ($competenceIds as $competenceId) {
            $competences[] = $em->find('Competence', $competenceId);
        }

        $realisation->setLib($lib);
        //$realisation->setLocalisation($localisation);
        $realisation->getCompetences()->clear();

        foreach ($competences as $competence) {
            $realisation->addCompetence($competence);
        }

        $em->flush();

        header('Location: start.php?c=realisation&t=panelrealisation');
    }
}
