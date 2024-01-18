<?php
ob_start();
?>

<?php
for ($i = 0; $i < count($res); $i++) {
    if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] === $res[$i]->getuserid()) {
        ?>
        <article class="article_vue_style">
            <h2>
                <?= $res[$i]->gettitre() ?>
            </h2>
            <p>articel publier le
                <?= date_format(date_create($res[$i]->getdate()), 'd-m-Y') ?>
            </p>
            <img src="./imgstock/<?= $res[$i]->getimg() ?>" alt="/">
            <p>
                <?= $res[$i]->getdescription() ?>
            </p>
            <a href="/<?= $res[$i]->getid() ?>/modif_formulaire">modifier</a>
            <form action="/delate" method="post">
                <input type="hidden" name="delate_article_img" value="<?= $res[$i]->getimg() ?>">
                <input type="hidden" name="id_article" value="<?= $res[$i]->getid() ?>">
                <input type="submit" value="suprimer">
            </form>
        </article>
        <?php
    } else {
        ?>
        <article class="article_vue_style">
            <h2>
                <?= $res[$i]->gettitre() ?>
            </h2>
            <p>articel publier le :
                <?= date_format(date_create($res[$i]->getdate()), 'd-m-Y') ?>
            </p>
            <img src="./imgstock/<?= $res[$i]->getimg() ?>" alt="/">
            <p>
                <?= $res[$i]->getdescription() ?>
            </p>
        </article>
        <?php
    }
}
?>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
