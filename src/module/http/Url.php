<?php
namespace Module\Http;

final class Url
{
    private ?string $_url;
    private ?string $_queryString;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        if($this->_url === null) {
            $this->_url = rawurldecode($_SERVER['REQUEST_URI']);
            $this->_url = explode('?', $_SERVER['REQUEST_URI'])[0];
        }

        return $this->_url;
    }

    /**
     * @return string
     */
    public function getQueryString(): string
    {
        if ($this->_queryString === null) $this->_queryString = (string) $_SERVER['QUERY_STRING'];

        return $this->_queryString;
    }

}