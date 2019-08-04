<?php
    namespace Traits;

    trait Registry
    {
        private static array $_container = [];

        public static function __setData(string $key, $value)
        {
            self::$_container[$key] = $value;
        }

        public static function __getData(?string $key = null)
        {
            if($key !== null) return self::$_container[$key];

            return self::$_container;
        }

    }