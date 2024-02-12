<?php

namespace Controllers;

use PDO;
use Localisation;

class LocalisationController extends Controller {

    public function panelLocalisation($params) {
        $entityManager = $params["em"];
        $localisationRepository = $entityManager->getRepository('Localisation');
        $localisations = $localisationRepository->findAll();

        //return $this->render('crudLocalisation.html', ['localisations' => $localisations, 'params' => $params]);
    }

    public function createLocalisation() {
        //return $this->render('createLocalisation.html');
    }

    public function insert($params) {
        $em = $params['em'];

        $shortLib = ($_POST['short_lib']);
        $longLib = ($_POST['long_lib']);

        $newLocalisation = new Localisation();
        $newLocalisation->setShortLib($shortLib);
        $newLocalisation->setLongLib($longLib);

        $em->persist($newLocalisation);
        $em->flush();

        header('Location: start.php?c=localisation&t=panellocalisation');
    }

    public function deleteLocalisation($params) {
        $id = ($params['get']['id']);
        $em = $params['em'];
        $localisation = $em->find('Localisation', $id);

        $em->remove($localisation);
        $em->flush();

        header('Location: start.php?c=localisation&t=panellocalisation');
    }

    public function editLocalisation($params) {
        $entityManager = $params["em"];

        $id = ($params['get']['id']);
        $em = $params['em'];
        $localisation = $em->find('Localisation', $id);

        //return $this->render('editLocalisation.html', ['localisation' => $localisation]);
    }

    public function updateLocalisation($params) {
        $em = $params['em'];
        $id = $params['post']['id'];

        $localisation = $em->find('Localisation', $id);

        $localisation->setShortLib($params['post']['short_lib']);
        $localisation->setLongLib($params['post']['long_lib']);

        $em->flush();

        header('Location: start.php?c=localisation&t=panellocalisation');
    }
}
