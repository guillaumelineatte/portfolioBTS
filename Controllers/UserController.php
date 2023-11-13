<?php

namespace Controllers;

//use Symfony\Component\Routing\Annotation\Route;
use User;
use Doctrine\ORM\Query\ResultSetMapping;

class UserController extends Controller {

    public function one($params)
    {
        $entityManager = $params["em"];
        $connectUser = "Un seul";

        $user = new User();

        $user -> setNom("LINEATTE");
        
        $user -> setPrenom("Guillaume");
        //var_dump($user);die;
        $entityManager -> persist($user);
        
        $entityManager -> flush();

        echo $this->twig->render('index.html', ['connectUser' => $connectUser, 'params' => $params]);
    }

    public function userList($params) {
        $entityManager = $params["em"];
        $userRepository = $entityManager->getRepository('User');

        
        $users = $userRepository->findAll();

            echo $this->twig->render('userList.html', ['users' => $users, 'url' => $params['url']]);
       
    }

    public function create() 
    {
        echo $this->twig->render('create.html');
    }

    public function insert($params) {

        $em = $params['em'];
        $nom =($_POST['nom']);
        $prenom =($_POST['prenom']);

        $newUser = new User();
        $newUser->setNom($nom);
        $newUser->setPrenom($prenom);

        $em->persist($newUser);
        $em->flush();

        header('Location: start.php?c=user&t=userList');
    }

    public function edit($params) {
        //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $params['get']['id'];
        $em = $params["em"];
        $user = $em->find('User', $id);
        echo $this->twig->render('edit.html', ['user' => $user]);
        
    }

    public function update($params) {
        $id = $params['get']['id'];
        $em = $params['em'];
        $user = $em->find('User', $id);

        //var_dump($params['post']);die;
        $user->setNom = $params['post']['nom'];
        $user->setPrenom =$params['post']['prenom'];

        

        $em->flush();
        $this->userList();
        //echo $this->twig->render('edit.html', ['user' => $user]);
    }
}
?>