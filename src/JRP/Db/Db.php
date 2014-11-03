<?php

namespace JRP\Db;


use Psr\Log\InvalidArgumentException;

class Db {

    private $dsn;
    private $credentials = ['user', 'password'];
    private $options;
    private $dbh;

    public function __construct($dsn, $user = null, $password = null, $options = null)
    {
        $this->setDsn($dsn);
        $this->setCredentials($user, $password);
        $this->setOptions($options);

        $this->setDbh(
            new \PDO($this->getDsn(),
            $this->getCredentials()['user'],
            $this->getCredentials()['password'],
            $this->getOptions())
        );
    }

    public function setDsn($dsn = "mysql:host=localhost")
    {
        if(empty($dsn))
        {
            throw new InvalidArgumentException("A dsn não pode ser vazia!");
        }

        $this->dsn = $dsn;
    }

    public function getDsn()
    {
        return $this->dsn;
    }

    public function setCredentials($user, $password)
    {
        $this->credentials['user'] = $user;
        $this->credentials['password'] = $password;
    }

    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options = null)
    {
        $this->options = $options;
    }

    /**
     * @param mixed $dbh
     */
    private function setDbh($dbh)
    {
        $this->dbh = $dbh;
    }

    public function getConn()
    {
        return $this->dbh;
    }

} 