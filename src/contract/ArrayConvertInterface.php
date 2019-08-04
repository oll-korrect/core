<?php

    namespace Contract;

    interface ArrayConvertInterface
    {
        /**
         * @param array $array
         */
        public function fromArray(array $array);

        /**
         * @return array
         */
        public function toArray() :array;

    }