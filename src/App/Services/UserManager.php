<?php

namespace App\Services;

use App\Modele\DBFactory;

/**
 * UserManager
 */
class UserManager
{
    /**
     * @var App\Modele\DatabaseInterface
     */
    private $conn;

    public function __construct()
    {
        $this->conn = DBFactory::create('mysql')->connect();
    }

    /**
     * @return boolean
     */
    public function userLoggedIn()
    {
	if (isset($_SESSION['uid'])
            && !empty($_SESSION['uid'])
            && ((int) $_SESSION['uid']) != 0
        ) {
            return true;
	}

        return false;
    }

    /**
     * @param type $uname
     * @param type $passwd
     * @return boolean
     */
    public function login($uname, $passwd)
    {
	$query = "SELECT uid FROM user"
            . " WHERE lower(uname) = lower('".\mysqli_real_escape_string($this->conn, $uname)."')"
            . " AND passwd = '".md5($passwd)."';";

	$res = mysqli_query($this->conn, $query);

	if ($res === false) {
            mysqli_close($this->conn);
            $_SESSION['login_errors'] = ['Error occured. Please try again later.'];
            return false;
	} else if (mysqli_affected_rows($this->conn) != 1) {
            mysqli_close($this->conn);
            $_SESSION['login_errors'] = ['Bad credentials !'];
            return -1;
	} else {
            $res = mysqli_fetch_assoc($res);
            $_SESSION['uid'] = (int) $res['uid'];
            $_SESSION['login_errors'] = [];
            mysqli_close($this->conn);
            return true;
	}
    }

    /**
     * @param type $uname
     * @param type $passwd
     * @return boolean
     */
    public function register($uname, $passwd)
    {
	$username = mysqli_real_escape_string($this->conn, $uname);
	$query = "SELECT uid FROM user WHERE uname = '$username';";

	$res = mysqli_query($this->conn, $query);

	if($res === false) {
            $_SESSION['register_errors'] = ['Error occured. Please try again later.'];
	} else if (mysqli_affected_rows($this->conn) >= 1) {
            $_SESSION['register_errors'] = ['Username already exists .'];
        }

        if($res === false || mysqli_affected_rows($this->conn) >= 1) {
            mysqli_close($this->conn);
            return false;
        }

	$query = "INSERT INTO user (uname, passwd) VALUES('$username', '".md5($passwd)."');";
	$res = mysqli_query($this->conn, $query);

	if ($res === false || (mysqli_affected_rows($this->conn) != 1)) {
            mysqli_close($this->conn);
            return false;
	} else {
            mysqli_close($this->conn);
            return true;
	}
    }

    public function logout()
    {
        if (isset($_GET["csrf"]) && $_GET["csrf"] == $_SESSION["token"]) {
            $_SESSION = array();
            session_destroy();
        }
    }

    public function getUserFilterById($id)
    {
        $query = "SELECT distinct user FROM user WHERE uid = '$id' LIMIT 1;";
        $res = mysqli_query($this->conn, $query);

        if($res === false || mysqli_affected_rows($this->conn) == 0) {
            mysqli_close($this->conn);
            return null;
        }

        var_dump($res);
        die;
    }
}
