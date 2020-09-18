<?php
namespace Oxylion\System;
use \PDO;

abstract class ModelAbstract
{
    protected array $config;
    protected $pdo;
    protected string $database_host;
    protected string $database_name;
    protected string $database_pass;

    public function __construct($di=null)
    {
        if (null==!$di) {
            $this->config = $di->config;
        } else {
            $this->config = [
                'database_driver' => "PDO_SQLITE",
                'database_host' => "127.0.0.1",
                'database_name' => "AbstractWeb",
                'database_user' => "root",
                'database_pass' => "empty",
                'db_encoding' => "UTF-8"
            ];
        }

        if ($this->database_driver == "PDO_MYSQL") {
            $this->config = ['pdo_dns' => 'mysql:dbname=' . $this->database_name.';host=' . $this->database_host];
            $this->config = ['pdo_user' => $this->database_user];
            $this->config = ['pdo_pass' => $this->database_pass];
        } elseif ($this->database_driver == "PDO_SQLITE") {
            $this->config['pdo_dns'] = "sqlite:" . $this->database_name.'.sqlite';
        } else {
            throw new \PDOException("undefined database driver");
        }

        try {
            if ($this->database_driver=="PDO_SQLITE") {
                $this->pdo = new PDO($this->pdo_dns);
            }
            elseif ($this->database_driver=="PDO_MYSQL") {
                $this->pdo = new PDO($this->pdo_dns, $this->pdo_user, $this->pdo_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND));
            }
            else {
                throw new \PDOException("Undefined db driver");
            }

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print $e->getMessage();
        }

        try {
            $this->pdo->exec("CREATE TABLE users (id int, name VARCHAR)");
            $this->pdo->exec("DELETE FROM users");
            $this->pdo->exec("INSERT INTO users (name) VALUES ('kermit')");
            $this->pdo->exec("INSERT INTO users (name) VALUES ('karamba')");
            $this->pdo->exec("INSERT INTO users (name) VALUES ('admin')");
        }
        catch (\PDOException $e) {
            print $e->getMessage();
        }

        $users = $this->pdo->query("SELECT * FROM users");

        foreach ($users as $user) {
            print "user_row:  ".$user['name']."\n";
        }

        print "<br><hr>";
        prt($users);
    }

    public function __get($key)
    {
        return $this->config[$key];
    }

    public function __isset($key)
    {
        return isset($key, $this->config);
    }

    public function has($key)
    {
        return isset($this->config[$key]);
    }
}
