<?php
namespace Module\Http;

final class Cookie
{
    private ?array $_storage;

    public function get(?string $key = null)
    {
        if($this->_storage === null) {
            $this->_storage = [];
            $cookie = explode('; ', $_SERVER['HTTP_COOKIE']);
            foreach ($cookie as $cookie_item) {
                $value = explode('=', $cookie_item);
                $this->_storage[$value[0]] = $value[1];
            }
        }
        $result = ($key === null) ? $this->_storage : $this->_storage[$key];

        return $result;
    }

    public function set(string $key, string $value) :self
    {
        $result = $this->get($key);
        if($result !== $value) {
            $this->_storage[$key] = $value;
            setcookie($key,$value);
        }

        return $this;
    }

}