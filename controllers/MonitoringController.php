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

        // Fonction pour alterner ASC/DESC par colonne
        function nextOrder($column, $sort, $order) 
        {
            if ($column === $sort) {
                // Si l'ordre actuel est 'asc', on passe à 'desc'
                if ($order === 'asc') {
                    return 'desc';
                } else {
                    return 'asc';
                }
            } else {
            // Si ce n'est pas la colonne triée, on retourne 'asc' par défaut
                return 'asc';
            }
        }
        // Fonction pour afficher les flèches
        function sortArrow($column, $sort, $order) {
            if ($column !== $sort) {
                return '⇅'; // colonne pas triée → ⇅
            }
            if ($order === 'asc') {
                return '↑';
            } else {
                return '↓';
            }
        }


    // Affiche la page de monitoring avec le système de vues

    public function showMonitoring() : void
    {
        $this->checkIfUserIsConnected();
    
        // si order existe dans l'url on le récupère sinon on met desc par défaut
        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 'desc';
        }
    
        // si sort existe dans l'url on le récupère sinon on met date_creation par défaut
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = 'date_creation';
        }
    
        // récupère tous les articles triés selon les paramètres sort et order
        $articles = $this->articleManager->getAllArticles($sort, $order);
    
        // récupère tous les commentaires
        $comments = $this->commentManager->getAllComments();
    
        $view = new View("Monitoring");
        $view->render("monitoring", [
            'articles'=> $articles,
            'comments'=> $comments,
            'sort'=> $sort,
            'order'=> $order,
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
