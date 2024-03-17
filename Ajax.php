<?php
    // connexion à la base de données
    require_once('Connexion.php');

    /**
     * On doit analyser la demande faite via l'URL (GET)
     * afin de déterminer si on souhaite récupérer les 
     * messages ou en écrire un
     */
    $task = "list";
    if (array_key_exists("task",$_GET)) {
       $task =  $_GET['task'];
    }
    if ($task == "write") {
        postMessage();
    }
    else{
        getMessages();
    }
     /**
      * Si on veut récupérer, il faut envoyer du JSON
      */
    function getMessages() {
        global $bd;
        // 1. on requete la base de donnée pour sortir les 20 premiers messages
            $resultats = $bd->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 30");
        // 2. on traite les résultats
            $messages = $resultats->fetchAll();
        // 3. on affiche les données sous format JSON
            echo json_encode($messages);
    }
      /**
       * Si on veut écrire au contraire, il faut analyser les
       * paramètres envoyés en POST et les sauver dans la base de 
       * données
       */
    function postMessage() {
        global $bd;
        // 1. Analyser les paramètres passés en POST (author, content)
            if (!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)) {
                echo json_encode(["status" => "error","message" => "One field or many have not been sent"]);
                return;
            }
            $author = $_POST['author'];
            $content = $_POST['content'];
        // 2. Créer une requete qui permettra d'insérer ces données
            $query = $bd->prepare('INSERT INTO messages SET author = :author, content = :content, created_at = NOW()');
            $query->execute([
                "author" => $author,
                "content" => $content
            ]);

        // 3. Donner un status de succès ou d'erreur au format JSON
            echo json_encode(["status" => "succes"]);
    }
?>