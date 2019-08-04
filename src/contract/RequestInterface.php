<?php
    namespace Contract;

    use Module\Http\Content;
    use Module\Http\Cookie;
    use Module\Http\Remote;
    use Module\Http\Server;
    use Module\Http\Url;

    interface RequestInterface {
        /**
         * @return string
         */
        public function getMethod(): string;
        /**
         * @return string
         */
        public function getScheme(): string;
        /**
         * @return string
         */
        public function getProtocol(): string;
        /**
         * @return Url
         */
        public function getUrl(): Url;
        /**
         * @return string
         */
        public function getUserAgent(): string;
        /**
         * @return mixed
         */
        public function getCookie() :Cookie;
        /**
         * @return string
         */
        public function getLanguage() :string;
        /**
         * @return mixed
         */
        public function getServer() :Server;
        /**
         * @return Content
         */
        public function getContent() :Content;

        /**
         * @return string
         */
        public function getHost(): string;

        /**
         * @return Remote
         */
        public function getRemote() :Remote;

        /**
         * @return mixed
         */
        public function getSession();
    }