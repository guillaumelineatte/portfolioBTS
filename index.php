<?php
    require_once 'vendor/autoload.php';

    echo "Connexion MySQL";

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=BTS_Guillaume;charset=utf8',
        'guillaume',
        'plop'
    );
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

$dataStatut = $db->prepare('SELECT * FROM departement');
$dataStatut->execute();
$datas = $dataStatut->fetchAll();
//var_dump($datas);

    $loader = new \Twig\Loader\FilesystemLoader('Vues/');
    $twig = new \Twig\Environment($loader);

    $array = [
        "foo" => "bar",
        "bar" => "foo",
    ];

    //echo $twig-> render('index', ['nom' => 'OUI']);
    echo $twig->render('index.html', ['the' => 'variables', 'go' => 'here', 'datas'=>$datas]);
?>

