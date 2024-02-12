<?php

namespace Controllers;

use PDO;
use Candidat;
use Centre;
use Competence;
use Realisation;
use Utilisateur;

class PortfolioController extends Controller
{
    public function table($params) {
        $entityManager = $params["em"];
        $candidats = $entityManager->getRepository(Candidat::class)->findAll();
        $centres = $entityManager->getRepository(Centre::class)->findAll();
        $competences = $entityManager->getRepository(Competence::class)->findAll();
        $realisations = $entityManager->getRepository(Realisation::class)->findAll();
        $utilisateurs = $entityManager->getRepository(Utilisateur::class)->findAll();

        if ($this->isLoggedIn()) {

            $utilisateur_prenom = $_SESSION['utilisateur_prenom'];
            $utilisateur_nom = $_SESSION['utilisateur_nom'];

            echo $this->twig->render('portfolio.html', ['competences' => $competences, 'utilisateur_prenom' => $utilisateur_prenom, 'utilisateur_nom' => $utilisateur_nom,
            'realisations' => $realisations, 'params' => $params]);
        } else {
            echo $this->twig->render('portfolio.html', ['competences' => $competences, 'realisations' => $realisations, 'params' => $params]);
        }

    }

    public function addCompetence($params) {
        $realisationId = $params['post']['realisationId'];
        $competenceId = $params['post']['competenceId'];

        $entityManager = $params["em"];

        $realisation = $entityManager->find(Realisation::class, $realisationId);
        $competence = $entityManager->find(Competence::class, $competenceId);

        if (!$realisation || !$competence) {
            echo json_encode(['status' => 'error']);
        } else {
            $realisation->addCompetence($competence);

            $entityManager->persist($realisation);
            $entityManager->flush();

            echo json_encode(['status' => 'success']);
        }
    }

    public function removeCompetence($params) {
        $realisationId = $params['post']['realisationId'];
        $competenceId = $params['post']['competenceId'];

        $entityManager = $params["em"];

        $realisation = $entityManager->find(Realisation::class, $realisationId);
        $competence = $entityManager->find(Competence::class, $competenceId);

        if (!$realisation || !$competence) {
            echo json_encode(['status' => 'error']);
        } else {
            $realisation->removeCompetence($competence);

            $entityManager->persist($realisation);
            $entityManager->flush();

            echo json_encode(['status' => 'success']);
        }
    }

    public function checkRelation($params) {
        $realisationId = $params['post']['realisationId'];
        $competenceId = $params['post']['competenceId'];

        $entityManager = $params["em"];

        $realisation = $entityManager->find(Realisation::class, $realisationId);
        $competence = $entityManager->find(Competence::class, $competenceId);

        if (!$realisation || !$competence) {
            echo json_encode(['status' => 'error']);
            return;
        }

        $competencesrea = $realisation->getCompetences();
        $relationExists = $competencesrea->contains($competence);

        if ($relationExists) {
            echo json_encode(['status' => 'exists']);
        } else {
            echo json_encode(['status' => 'not_exists']);
        }
    }


    }
