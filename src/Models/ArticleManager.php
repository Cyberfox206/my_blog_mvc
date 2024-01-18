<?php
namespace BlogMvc\Models;

// use BlogMvc\Models\User;

class ArticleManager
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function getarticle($id_article)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM `article` WHERE id_article = ?");
        $stmt->execute(
            array(
                $id_article,
            )
        );
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "BlogMvc\Models\Article");
        return $stmt->fetch(\PDO::FETCH_CLASS);
    }
    public function getall_art()
    {
        $stmt = $this->bdd->query('SELECT * FROM `article` ORDER BY article_date DESC ');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "BlogMvc\Models\Article");
    }
    public function add_art($img)
    {
        $stmt = $this->bdd->prepare("INSERT INTO `article` (`id_article`, `id_user`, `titre_article`, `article_date`, `img`, `description_article`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(
            array(
                uniqid(),
                $_SESSION['user']['id'],
                $_POST['titre_article'],
                date("Y-m-d H:i:s"),
                $img,
                $_POST['description_article']
            )
        );
    }

    public function delate($art_id)
    {
        $stmt = $this->bdd->prepare("DELETE FROM `article` WHERE `id_article` = ?");
        $stmt->execute(
            array(
                $art_id,
            )
        );
    }

    public function update($id_article)
    {
        $stmt = $this->bdd->prepare("UPDATE `article` SET `titre_article` = ?, `img` = ?, `description_article` = ? WHERE `article`.`id_article` = ?");
        $stmt->execute(
            array(
                $_POST['titre_article_modif'],
                $_FILES['img_modif'],
                $_POST['description_article_modif'],
                $id_article,
            )
        );
    }

}
