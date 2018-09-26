    <?php
    require_once("Manager.php");

    class CommentManager extends Manager
    {
        public function getComments($postId)
        {
            $db = $this->dbConnect();
            $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
            $comments->execute(array($postId));
            return $comments;
        }

        public function postComment($postId, $author, $comment)
        {
            $db = $this->dbConnect();
            $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, reported, notReadComment, comment_date) VALUES(?, ?, ?, 0, 1, NOW())');
            $affectedLines = $comments->execute(array($postId, $author, $comment));

            return $affectedLines;
        }
    
    }