<h2>Suivi du blog</h2>

<section>
    <h3>Articles</h3>

    <div class="adminArticle">

        <div class="articleLine header">
            <div class="title">
                <a href="index.php?action=monitoring&sort=title&order=<?= Sort::nextOrder('title', $sort ?? '', $order ?? '') ?>">
                Titre <?= Sort::sortArrow('title', $sort ?? '', $order ?? '') ?></a>
            </div>
            <div class="title">
                <a href="index.php?action=monitoring&sort=views&order=<?= Sort::nextOrder('views', $sort ?? '', $order ?? '') ?>">    
                Nombre de vues <?= Sort::sortArrow('views', $sort ?? '', $order ?? '') ?></a>
            </div>
            <div class="title">
                <a href="index.php?action=monitoring&sort=date_creation&order=<?= Sort::nextOrder('date_creation', $sort ?? '', $order ?? '') ?>">    
                Date de publication <?= Sort::sortArrow('date_creation', $sort ?? '', $order ?? '') ?></a>
            </div>
            <div class="title">
                <a href="index.php?action=monitoring&sort=commentCount&order=<?= Sort::nextOrder('commentCount', $sort ?? '', $order ?? '') ?>">
                Nombre de commentaires <?= Sort::sortArrow('commentCount', $sort ?? '', $order ?? '') ?></a>
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