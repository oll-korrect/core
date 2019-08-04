<?php
namespace Module\Http;

final class Content
{
    private ?string $length;
    private ?string $type;
    private ?string $body;
    private ?array $requestData;

    /**
     * @return string
     */
    public function getLength(): string
    {
        if($this->length === null) {
            $this->length = $_SERVER['CONTENT_LENGTH'];
        }

        return $this->length;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        if($this->type === null) {
            $this->type = $_SERVER['CONTENT_TYPE'];
        }

        return $this->type;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        if($this->body === null) {
            $this->body = file_get_contents('php://input');
        }

        return $this->body;
    }

    /**
     * @return array | null
     */
    public function getRequestData(): ?array
    {
        if($this->requestData === null) {
            $this->requestData = $_REQUEST;
        }

        return $this->requestData;
    }

}