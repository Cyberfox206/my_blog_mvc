<?php
namespace BlogMvc\Controllers;

use BlogMvc\Models\ArticleManager;
use BlogMvc\Validator;

class ArticleController
{
    private $manager;
    private $validator;

    public function __construct()
    {
        $this->manager = new ArticleManager();
        $this->validator = new Validator();
    }

    public function getall_art()
    {
        $res = $this->manager->getall_art();
        require VIEWS . 'article_vue/article_vue.php';
    }
    public function formulaire_for_add_art()
    {
        if (isset($_SESSION["user"]['id'])) {
            require VIEWS . 'article_vue/article_add.php';
        } else {
            require VIEWS . 'Auth/login.php';
        }
    }
    public function formulaire_for_modif_art($slug)
    {
        if (isset($_SESSION["user"]['id']) && $this->manager->getarticle($slug)->getuserid() === $_SESSION['user']['id']) {
            $res = $this->manager->getarticle($slug);
            require VIEWS . 'article_vue/article_modif.php';
        } else {
            require VIEWS . 'Auth/login.php';
        }
    }

    public function update_art($slug)
    {
        $this->validator->validate([
            "titre_article_modif" => ["required", "min:1", "fomatitre"],
            "description_article_modif" => ["required", "min:1", 'formatext'],
        ]);
        if (!$this->validator->errors()) {
            if (isset($_FILES['img_modif']) && $_FILES['img_modif']['error'] === 0) {
                unlink('./imgstock/' . $this->manager->getarticle($slug)->getimg());
            } else {
                $_FILES['img_modif'] = $this->manager->getarticle($slug)->getimg();
            }
            $this->manager->update($slug);
            header('location:/');
        } else {
            header("loaction:/" . $this->manager->getarticle($slug)->getid() . '/modif_formulaire');
        }
    }


    public function add_article_in_db()
    {
        $this->validator->validate([
            "titre_article" => ["required", "min:1", "fomatitre"],
            "description_article" => ["required", "min:1", 'formatext'],
        ]);
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) {
            if ($_FILES['img']['error'] === 0) {
                var_dump($_FILES);
                $info = new \SplFileInfo($_FILES['img']['name']);
                $rand = rand();
                rename($_FILES['img']['tmp_name'], './imgstock/' . $rand . '.' . $info->getExtension());
                $this->manager->add_art($rand . '.' . $info->getExtension());
                header("location:/");
            } else {
                header('location:/newart');
            }
        } else {
            header('location:/newart');
        }
    }
    public function delate()
    {
        unlink('./imgstock/' . $_POST['delate_article_img']);
        $this->manager->delate($_POST['id_article']);
        header('location:/');
    }
}

?>