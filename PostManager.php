<?php
spl_autoload_register(function ($Manager) {
include $Manager . '.php';
});
class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $chapterByPage= 3;
        $currentPage= intval ($_GET['page']);
        $start=ceil(($currentPage-1)*$chapterByPage);
        $req = $db->query("SELECT id, title, creation_date,  content  FROM posts ORDER BY creation_date DESC LIMIT $start, $chapterByPage");
        return $req ;
    }
 
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
 
}
