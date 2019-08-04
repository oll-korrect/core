<?php
namespace Module\Http;

final class Remote
{
    private ?string $host;
    private ?int $port;

    /**
     * @return string
     */
    public function getHost() :string
    {
        if($this->host === null) $this->host = (string) $_SERVER['REMOTE_ADDR'];

        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort() :int
    {
        if($this->port === null) $this->port = (int) $_SERVER['REMOTE_PORT'];

        return $this->port;
    }

}