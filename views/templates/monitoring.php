<h2>Suivi du blog</h2>

<section>
    <h3>Articles</h3>
    <div class="adminArticle">
 
        <div class="articleLine header">
            <div class="title">Titre</div>
            <div class="title">Nombre de vues</div>
            <div class="title">Date de publication</div>
            <div class="title">Nombre de commentaires</div>
        </div>

        <?php foreach ($articles as $article) { ?>
            <div class="articleLine">
                <div class="title"><?= htmlspecialchars($article->getTitle()) ?></div>
                <div class="title"><?= $article->getViews() ?></div>
                <div class="title"><?= $article->getDateCreation()->format('d/m/Y') ?></div>
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
                <div class="title"><?= $comment->getIdArticle() ?></div>
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
