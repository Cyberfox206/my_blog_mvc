<?php
ob_start();
?>

<form class="article_add_style" action="/<?= $res->getid() ?>/modif" method="post" enctype="multipart/form-data">

    <label for="titre_article">insert the new title:</label>
    <input type="text" name="titre_article_modif" id="">

    <label for="img">select a new picture:</label>
    <input type="file" name="img_modif" id="">

    <label for="description_article">insert the new description:</label>
    <input type="text" name="description_article_modif" id="">

    <input type="submit" value="envoyer">
</form>


<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';

