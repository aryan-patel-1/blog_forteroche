<?php

require_once 'models/ArticleManager.php';
require_once 'models/CommentManager.php';

class MonitoringController
{
    private ArticleManager $articleManager;
    private CommentManager $commentManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager();
        $this->commentManager = new CommentManager();
    }

    public function showMonitoring(): void
    {
        // Récupération des paramètres GET
        $sort  = $_GET['sort']  ?? 'date_creation';
        $order = $_GET['order'] ?? 'desc';

        // Récupération des données
        $articles = $this->articleManager->getAllArticles($sort, $order);
        $comments = $this->commentManager->getAllComments();

        $view = new View("Monitoring");
        $view->render("monitoring", [
            'articles' => $articles,
            'comments' => $comments,
            'sort'     => $sort,
            'order'    => $order,
        ]);
    }

    public function deleteComment(int $id): void
    {
        $comment = $this->commentManager->getCommentById($id);

        if ($comment) {
            $this->commentManager->deleteComment($comment);
        }
        header('Location: index.php?action=monitoring');
        exit;
    }
}