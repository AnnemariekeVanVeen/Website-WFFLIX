<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */


class VideoModel extends BaseModel
{
    private $table = 'videos';
    private $id;
    private $videoURL, $videoName, $videoDescription, $videoSubject;

    /**
     * @var string
     */

    public function __construct()
    {
        parent::construct();
    }

    /**
     * @return string
     */
    public static function migrateVideos()
    {
        echo "hello";
        $self = new self;

        try {
            $sql = 'CREATE TABLE IF NOT EXISTS ' . $self->getTable() . '(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,' .
                'video_url TEXT NOT NULL,' .
                'video_name VARCHAR(255),' .
                'video_description TEXT,' .
                'video_subject VARCHAR(50) )';

            if ($stmt = $self->conn->prepare($sql)):
                $stmt->execute();

                return 'Videos table created';
            else:
                return 'Error creating Videos table';
            endif;
        } catch (PDOException $exception) {
            die($exception->getMessage()); // getting the message of the error
        }
    }

    /**
     * @param integer $id
     * @return bool|UserModel
     */
    public static function findVideo($id)
    {
        $self = new self;

        $sql = "SELECT * FROM {$self->getTable()} WHERE id = :id";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $data = $stmt->fetch();
            $self = $self->loadData($self, $data);

            return $self;
        else:
            return false;
        endif;
    }

    /**
     * @param string $key
     * @param string $data
     * @return array|bool
     */
    public static function find_byVideo($key, $data)
    {
        $self = new self;
        $result = [];

        $sql = "SELECT * FROM {$self->getTable()} WHERE $key = :value";
        // prepares DB
        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(':value', $data);
            $stmt->execute();
            // loads data
            $data = $stmt->fetchall();
            foreach ($data as $row):
                $tmp = new self;
                $tmp = $tmp->loadData($tmp, $row);

                array_push($result, $tmp);
            endforeach;
            return $result;
        else:
            return false;
        endif;
    }

    /**
     * @return array|bool
     */
    public static function allVideo()
    {
        $self = new self;
        $result = [];

        $sql = "SELECT * FROM {$self->getTable()}";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->execute();

            $data = $stmt->fetchall();

            foreach ($data as $row):
                $tmp = new self;
                $tmp = $tmp->loadData($tmp, $row);

                array_push($result, $tmp);
            endforeach;

            //  die(var_dump($result));

            return $result;
        else:
            return false;
        endif;
    }

    /**
     * @param array $data
     * @return bool|UserModel
     */
    public static function createVideo($data)
    {
        $self = new self;
        $sql = 'INSERT INTO ' . $self->getTable() . '(video_url, video_name, video_description, video_subject)' .
            ' VALUES (:video_url, :video_name, :video_description, :video_subject)';

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(':video_url', $data['video_url']);
            $stmt->bindValue(':video_name', $data['video_name']);
            $stmt->bindValue(':video_description', $data['video_description']);
            $stmt->bindValue(':video_subject', $data['video_subject']);

            if ($stmt->execute()):
                $sql2 = "SELECT * FROM {$self->getTable()} WHERE video_url = :video_url";
                if ($stmt2 = $self->conn->prepare($sql2)):
                    $stmt2->bindValue(':video_url', $data['video_url']);
                    $stmt2->execute();
                    return self::find($stmt2->fetch()['id']);
                endif;
            endif;
        endif;
        return false;
    }

    /**
     * @return bool
     */
    public function updateVideo()
    {
        $sql = "UPDATE videos SET video_url = :video_url, video_name = :video_name, video_description = :video_description,
                  video_subject = :video_subject WHERE id = :id";

        if ($stmt = $this->conn->prepare($sql)):
            $stmt->bindValue(':video_url', $this->videoURL);
            $stmt->bindValue(':video_name', $this->videoName);
            $stmt->bindValue(':video_description', $this->videoDescription);
            $stmt->bindValue(':video_subject', $this->videoSubject);
            return $stmt->execute();
        endif;
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function destroyVideo($id)
    {
        $self = new self;
        $sql = "DELETE FROM users WHERE id = :id";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(":id", $id);

            return $stmt->execute();
        endif;
        return false;
    }

    /**
     * @param VideoModel $self
     * @param array $data
     * @return VideoModel
     */
    private function loadData($self, $data)
    {
        $self->setId($data['id']);
        $self->setVideoUrl($data['video_url']);
        $self->setVideoName($data['video_name']);
        $self->setVideoDescription($data['video_description']);
        $self->setVideoSubject($data['video_subject']);

        return $self;
    }

    /*----------------------------- Getters and Setters ----------------------------------------*/

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $video_url
     */
    public function setVideoUrl($video_url): void
    {
        $this->videoURL = $video_url;
    }

    /**
     * @param string $video_url
     */
    public function getVideoUrl()
    {
        return $this->videoURL;
    }

    /**
     * @param string $video_name
     */
    public function setVideoName($video_name): void
    {
        $this->videoName = $video_name;
    }

    /**
     * @param $video_name
     */
    public function getVideoName()
    {
        return $this->videoName;
    }

    /**
     * @param $video_descr
     */
    public function setVideoDescription($video_descr): void
    {
        $this->videoDescription = $video_descr;
    }

    /**
     * @param $video_descr
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
    }

    /**
     * @param string $video_subject
     */
    public function setVideoSubject($video_subject): void
    {
        $this->videoSubject = $video_subject;
    }

    /**
     * @param string $video_subject
     */
    public function getVideoSubject()
    {
        return $this->videoSubject;
    }
}