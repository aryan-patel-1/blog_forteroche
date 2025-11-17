<h2>Suivi du blog</h2>

<section>
    <h3>Articles</h3>

    <?php
    // Fonction pour alterner ASC/DESC par colonne
    function nextOrder($column, $sort, $order) {
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
    // Fonction pour afficher les flèche
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
    ?>

    <div class="adminArticle">
 
        <div class="articleLine header">
            <div class="title">
                <a href="index.php?action=monitoring&sort=title&order=<?= nextOrder('title', $sort, $order) ?>">
                Titre <?= sortArrow('title', $sort, $order) ?></a>
            </div>
            <div class="title">
                <a href="index.php?action=monitoring&sort=views&order=<?= nextOrder('views', $sort, $order) ?>">    
                Nombre de vues <?= sortArrow('views', $sort, $order) ?></a>
                </div>
            <div class="title">
                <a href="index.php?action=monitoring&sort=date_creation&order=<?= nextOrder('date_creation', $sort, $order) ?>">    
                Date de publication <?= sortArrow('date_creation', $sort, $order) ?></a>
            </div>
            <div class="title">
                <a href="index.php?action=monitoring&sort=commentCount&order=<?= nextOrder('commentCount', $sort, $order) ?>">
                Nombre de commentaires <?= sortArrow('commentCount', $sort, $order) ?></a>
            </div>
        </div>

        <?php foreach ($articles as $article) { ?>
            <div class="articleLine">
                <div class="title"><?= $article->getTitle() ?></div>
                <div class="title"><?= $article->getViews() ?></div>
                <div class="title"><?= $article->getDateCreation()->format('d/m/Y') ?></div>
                <div class="title"><?= $article->getCommentCount() ?></div>
            </div>
        <?php } ?>
    </div>
</section>

<section>
    <h3>Commentaires</h3>
    <div class="adminArticle">
        <div class="articleLine header">
            <div class="title">Nom de l'article</div>
            <div class="title">Pseudo</div>
            <div class="title">Commentaire</div>
            <div class="title">Date</div>
            <div class="title">Action</div>
        </div>


        <?php foreach ($comments as $comment) { ?>
            <div class="articleLine">
                <div class="title"><?= $comment->getArticleTitle() ?></div>
                <div class="title"><?= htmlspecialchars($comment->getPseudo()) ?></div>
                <div class="title"><?= htmlspecialchars($comment->getContent()) ?></div>
                <div class="title"><?= $comment->getDateCreation()->format('d/m/Y') ?></div>
                <div class="title">
                    <a class="submit"
                       href="index.php?action=deleteComment&id=<?= $comment->getId() ?>"
                       onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">
                       Supprimer
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<a class="submit" href="index.php?action=admin">Retour</a>
