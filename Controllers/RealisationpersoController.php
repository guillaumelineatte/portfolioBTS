<?php

namespace Controllers;

use PDO;
use Competence;
use Realisationperso;

class RealisationpersoController extends Controller {

    public function panelrealisationperso($params) {
        $entityManager = $params["em"];
        $realisationpersoRepository = $entityManager->getRepository(Realisationperso::class);
        $realisationpersos = $realisationpersoRepository->findAll();
        $competenceNames = [];

        foreach ($realisationpersos as $realisationperso) {
            $competences = $realisationperso->getCompetences();
            $competenceNames[$realisationperso->getId()] = [];
            foreach ($competences as $competence) {
                $competenceNames[$realisationperso->getId()][] = $competence->getShortLib();
            }
        }

        echo $this->twig->render('crudRealisationperso.html', ['realisationpersos' => $realisationpersos, 'competenceNames' => $competenceNames, 'params' => $params]);
    }




    public function createRealisationperso($params) {
        $entityManager = $params["em"];
        $competences = $entityManager->getRepository(Competence::class)->findAll();


        echo $this->twig->render('createRealisationperso.html', ['competences' => $competences]);
    }

    public function insert($params) {
        $em = $params['em'];

        $lib = ($_POST['lib']);
        $competence_id = $_POST['competence'];
        $competences = $em->find(Competence::class, $competence_id);

        $newRealisationperso = new Realisationperso();
        $newRealisationperso->setLib($lib);
        $newRealisationperso->addCompetence($competences);


        $em->persist($newRealisationperso);
        $em->flush();

        header('Location: start.php?c=realisationperso&t=panelrealisationperso');
    }

    public function deleteRealisationperso($params) {
        $id = ($params['get']['id']);
        $em = $params['em'];
        $realisationperso = $em->find('Realisationperso', $id);

        $em->remove($realisationperso);
        $em->flush();

        header('Location: start.php?c=realisationperso&t=panelrealisationperso');
    }

    public function editRealisationperso($params) {
        $entityManager = $params["em"];
        $competences = $entityManager->getRepository(Competence::class)->findAll();

        $id = ($params['get']['id']);
        $em = $params['em'];
        $realisationperso = $em->find(Realisationperso::class, $id);

        echo $this->twig->render('editRealisationperso.html', ['realisationperso' => $realisationperso, 'competences' => $competences]);
    }

    public function updateRealisationperso($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $realisationperso = $em->find(Realisationperso::class, $id);
        $lib = $params['post']['lib'];
        $competenceIds = $params['post']['competences'];
        $competences = [];
        foreach ($competenceIds as $competenceId) {
            $competences[] = $em->find('Competence', $competenceId);
        }

        $realisationperso->setLib($lib);
        //$realisationperso->setLocalisation($localisation);
        $realisationperso->getCompetences()->clear();

        foreach ($competences as $competence) {
            $realisationperso->addCompetence($competence);
        }

        $em->flush();

        header('Location: start.php?c=realisationperso&t=panelrealisationperso');
    }
}
