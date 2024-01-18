<?php
namespace BlogMvc\Models;

/** Class User **/
class Article
{

    private $id_article;
    private $id_user;
    private $titre_article;
    private $article_date;
    private $img;
    private $description_article;

    public function getid()
    {
        return $this->id_article;
    }

    public function getuserid()
    {
        return $this->id_user;
    }

    public function gettitre()
    {
        return $this->titre_article;
    }

    public function getimg()
    {
        return $this->img;
    }

    public function getdescription()
    {
        return $this->description_article;
    }
    public function getdate()
    {
        return $this->article_date;
    }
}
