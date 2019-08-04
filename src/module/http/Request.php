<?php
namespace Module\Http;

use Contract\RequestInterface;

final class Request implements RequestInterface
{
    private ?string $_method;
    private ?string $_scheme;
    private ?string $_protocol;
    private ?string $_host;
    private ?string $_url;
    private ?string $_userAgent;
    private ?Cookie $_cookie;
    private ?string $_language;
    private ?Server $_server;
    private ?string $_content;
    private ?Remote $_remote;
    private ?Session $_session;

    /**
     * @return string
     */
    public function getMethod(): string
    {
        if($this->_method === null) $this->_method = (string) $_SERVER['REQUEST_METHOD'];

        return $this->_method;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        if($this->_scheme === null) $this->_scheme = (string) $_SERVER['REQUEST_SCHEME'];

        return $this->_scheme;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        if($this->_protocol === null) $this->_protocol = (string) $_SERVER['SERVER_PROTOCOL'];

        return $this->_protocol;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        if($this->_url === null) $this->_url = new Url();

        return $this->_url;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        if($this->_userAgent === null) $this->_userAgent = (string) $_SERVER['HTTP_USER_AGENT'];

        return $this->_userAgent;
    }

    /**
     * @return Cookie
     */
    public function getCookie() :Cookie
    {
        if($this->_cookie === null) $this->_cookie = new Cookie();

        return $this->_cookie;
    }

    /**
     * @return string
     */
    public function getLanguage() :string
    {
        if($this->_language === null) $this->_language = (string) $_SERVER['HTTP_ACCEPT_LANGUAGE'];

        return $this->_language;
    }

    /**
     * @return Server
     */
    public function getServer() :Server
    {
        if($this->_server === null) $this->_server = new Server();

        return $this->_server;
    }

    /**
     * @return Content
     */
    public function getContent() :Content
    {
        if($this->_content === null) $this->_content = new Content();

        return $this->_content;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        if($this->_host === null) $this->_host = (string) $_SERVER['HTTP_HOST'];

        return $this->_host;
    }

    /**
     * @return Remote
     */
    public function getRemote() :Remote
    {
        if($this->_remote === null) $this->_remote = new Remote();

        return $this->_remote;
    }

    /**
     * @return Session
     */
    public function getSession() :Session
    {
        if($this->_session === null) $this->_session = new Session();

        return $this->_session;
    }

}