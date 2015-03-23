<?php

namespace Soliloquy\UserBundle\Document;

class User
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $dumps;

    public function __construct()
    {
        $this->imports = array();
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getDumps()
    {
        return $this->dumps;
    }

    /**
     * @param array $dumps
     */
    public function setDumps($dumps)
    {
        $this->dumps = $dumps;
    }

    /**
     * @param Dump $dump
     */
    public function addDump($dump)
    {
        $this->dumps[] = $dump;
    }
}
