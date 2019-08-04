<?php

    namespace Contract;

    interface JsonConvertInterface
    {
        /**
         * @param string $json
         */
        public function fromJson(string $json);

        /**
         * @return string
         */
        public function toJson() :string;

    }