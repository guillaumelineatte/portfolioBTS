<?php

namespace Controllers;

use PDO;
use Competence;

class CompetenceController extends Controller {

    public function panelCompetence($params) {
        $entityManager = $params["em"];
        $competenceRepository = $entityManager->getRepository('Competence');
        $competences = $competenceRepository->findAll();

        echo $this->twig->render('crudCompetence.html', ['competences' => $competences, 'params' => $params]);
    }

    public function createCompetence() {
        echo $this->twig->render('createCompetence.html');
    }

    public function insert($params) {
        $em = $params['em'];

        $shortLib = ($_POST['short_lib']);
        $longLib = ($_POST['long_lib']);

        $newCompetence = new Competence();
        $newCompetence->setShortLib($shortLib);
        $newCompetence->setLongLib($longLib);

        $em->persist($newCompetence);
        $em->flush();

        header('Location: start.php?c=competence&t=panelcompetence');
    }

    public function deleteCompetence($params) {
        $id = ($params['get']['id']);
        $em = $params['em'];
        $competence = $em->find('Competence', $id);

        $em->remove($competence);
        $em->flush();

        header('Location: start.php?c=competence&t=panelcompetence');
    }

    public function editCompetence($params) {
        $entityManager = $params["em"];

        $id = ($params['get']['id']);
        $em = $params['em'];
        $competence = $em->find('Competence', $id);

        echo $this->twig->render('editCompetence.html', ['competence' => $competence]);
    }

    public function updateCompetence($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $competence = $em->find('Competence', $id);

        $competence->setShortLib($params['post']['short_lib']);
        $competence->setLongLib($params['post']['long_lib']);

        $em->flush();

        header('Location: start.php?c=competence&t=panelcompetence');
    }
}
