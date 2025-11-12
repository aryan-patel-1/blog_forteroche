<?php

require_once 'models/ArticleManager.php';
require_once 'models/CommentManager.php';

class MonitoringController
{
    // Déclaration des propriétés de la classe
    private ArticleManager $articleManager;
    private CommentManager $commentManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager();
        $this->commentManager = new CommentManager();
    }


     //Vérifie si l'utilisateur est connecté
    private function checkIfUserIsConnected(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }


    // Affiche la page de monitoring avec le système de vues

    public function showMonitoring() : void
    {
        $this->checkIfUserIsConnected();

        $articles = $this->articleManager->getAllArticles();
        $comments = $this->commentManager->getAllComments();

        $view = new View("Monitoring");
        $view->render("monitoring", [
            'articles' => $articles,
            'comments' => $comments
        ]);
    }

    // Supprime un commentaire par son ID

    public function deleteComment(int $id): void
    {
        // On récupère le commentaire correspondant à l'ID
        $comment = $this->commentManager->getCommentById($id);

        // Si le commentaire existe, on le supprime via le CommentManager
        if ($comment) {
            $this->commentManager->deleteComment($comment);
        }

        // Redirection vers la page de monitoring après la suppression
        header('Location: index.php?action=monitoring');
        exit;
    }

}
