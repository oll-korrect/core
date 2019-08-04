<?php
    namespace Traits;

    use ReflectionClass;
    use ReflectionException;
    use ReflectionProperty;

    trait ArrayConvert {

        /**
         * @param array $array
         *
         * @return $this
         */
        public function fromArray(array $array) :self
        {
            $result = clone $this;
            try {
                $class = new ReflectionClass($result);
            } catch (ReflectionException $exception) {
                return $result;
            }
            $publicProps = $class->getProperties(ReflectionProperty::IS_PUBLIC);
            foreach ($publicProps as $prop) {
                $propName = $prop->name;
                if (isset($array[$propName])) {
                    $prop->setValue($result, $array[$propName]);
                }
                else {
                    $prop->setValue($result, null);
                }
            }

            return $result;
        }

        /**
         * @return array
         */
        public function toArray() :array
        {
            $array = [];
            try {
                $class = new ReflectionClass($this);
            } catch (ReflectionException $exception) {
                return $array;
            }
            $publicProps = $class->getProperties(ReflectionProperty::IS_PUBLIC);
            foreach ($publicProps as $prop) {
                $propName = $prop->name;
                $value = $prop->getValue($this);
                $array[$propName] = $value;
            }

            return $array;
        }
    }