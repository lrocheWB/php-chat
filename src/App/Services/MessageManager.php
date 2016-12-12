<?php

namespace App\Services;

use App\Modele\DatabaseInterface;

/**
 * MessageManager
 */
class MessageManager
{
    /**
     * @var App\Modele\DatabaseInterface
     */
    private $conn;

    public function __construct(DatabaseInterface $database)
    {
        $this->conn = $database->connect();
    }

    /**
     * @return array
     */
    public function get()
    {
        try {
            $query = "SELECT content, uname, time FROM message m"
                . " INNER JOIN user u ON u.uid = m.uid"
                . " ORDER by time;";
            $res = mysqli_query($this->conn, $query);
        } catch (\mysqli_sql_exception $e) {
            mysqli_close($this->conn);
            $_SESSION['chat_errors'] = ['Error occured. Please try again later.'];
            throw $e;
        }

        mysqli_close($this->conn);

        return mysqli_fetch_all($res);
    }

    /**
     * @param type $user_id
     * @param type $content
     * @return boolean
     * @throws \mysqli_sql_exception
     */
    public function post($user_id, $content)
    {
        try {
            $query = "INSERT INTO `message` (`content`, `uid`) VALUES('$content', $user_id);";
            $res = mysqli_query($this->conn, $query);
        } catch (\mysqli_sql_exception $e) {
            mysqli_close($this->conn);
            $_SESSION['chat_errors'] = ['Error occured. Please try again later.'];
            throw $e;
        }

        mysqli_close($this->conn);

        return true;
    }
}
