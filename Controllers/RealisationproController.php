<?php

namespace Controllers;

use PDO;
use Competence;
use Realisationpro;

class RealisationproController extends Controller {

    public function panelrealisationpro($params) {
        $entityManager = $params["em"];
        $realisationproRepository = $entityManager->getRepository(Realisationpro::class);
        $realisationpros = $realisationproRepository->findAll();
        $competenceNames = [];

        foreach ($realisationpros as $realisationpro) {
            $competences = $realisationpro->getCompetences();
            $competenceNames[$realisationpro->getId()] = [];
            foreach ($competences as $competence) {
                $competenceNames[$realisationpro->getId()][] = $competence->getShortLib();
            }
        }

        echo $this->twig->render('crudRealisationpro.html', ['realisationpros' => $realisationpros, 'competenceNames' => $competenceNames, 'params' => $params]);
    }




    public function createRealisationpro($params) {
        $entityManager = $params["em"];
        $competences = $entityManager->getRepository(Competence::class)->findAll();


        echo $this->twig->render('createRealisationpro.html', ['competences' => $competences]);
    }

    public function insert($params) {
        $em = $params['em'];

        $lib = ($_POST['lib']);
        $competence_id = $_POST['competence'];
        $competences = $em->find(Competence::class, $competence_id);

        $newRealisationpro = new Realisationpro();
        $newRealisationpro->setLib($lib);
        $newRealisationpro->addCompetence($competences);


        $em->persist($newRealisationpro);
        $em->flush();

        header('Location: start.php?c=realisationpro&t=panelrealisationpro');
    }

    public function deleteRealisationpro($params) {
        $id = ($params['get']['id']);
        $em = $params['em'];
        $realisationpro = $em->find('Realisationpro', $id);

        $em->remove($realisationpro);
        $em->flush();

        header('Location: start.php?c=realisationpro&t=panelrealisationpro');
    }

    public function editRealisationpro($params) {
        $entityManager = $params["em"];
        $competences = $entityManager->getRepository(Competence::class)->findAll();

        $id = ($params['get']['id']);
        $em = $params['em'];
        $realisationpro = $em->find(Realisationpro::class, $id);

        echo $this->twig->render('editRealisationpro.html', ['realisationpro' => $realisationpro, 'competences' => $competences]);
    }

    public function updateRealisationpro($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $realisationpro = $em->find(Realisationpro::class, $id);
        $lib = $params['post']['lib'];
        $competenceIds = $params['post']['competences'];
        $competences = [];
        foreach ($competenceIds as $competenceId) {
            $competences[] = $em->find('Competence', $competenceId);
        }

        $realisationpro->setLib($lib);
        //$realisationpro->setLocalisation($localisation);
        $realisationpro->getCompetences()->clear();

        foreach ($competences as $competence) {
            $realisationpro->addCompetence($competence);
        }

        $em->flush();

        header('Location: start.php?c=realisationpro&t=panelrealisationpro');
    }
}
