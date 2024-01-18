<?php
ob_start();
?>
<form class="article_add_style" action="/add" method="post" enctype="multipart/form-data">
    
    <label for="titre_article">insert title:</label>
    <input type="text" name="titre_article" id="">

    <label for="img">select one picture:</label>
    <input type="file" name="img" id="">

    <label for="description_article">insert description:</label>
    <input type="text" name="description_article" id="">

    <input type="submit" value="envoyer">
</form>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';

