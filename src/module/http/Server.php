<?php
namespace Module\Http;

final class Server
{
    private ?string $_name;
    private ?int $_port;
    private ?string $_address;

    /**
     * @return string
     */
    public function getName(): string
    {
        if($this->_name === null) $this->_name = (string) $_SERVER['SERVER_NAME'];

        return $this->_name;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        if($this->_port === null) $this->_port = (int) $_SERVER['SERVER_PORT'];

        return $this->_port;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        if($this->_address === null) $this->_address = (string) $_SERVER['SERVER_ADDR'];

        return $this->_address;
    }

}