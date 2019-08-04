<?php

    use Contract\ArrayConvertInterface;
    use Contract\EntityInterface;
    use Contract\JsonConvertInterface;

    abstract class Entity implements JsonConvertInterface, ArrayConvertInterface, EntityInterface
    {
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
                echo $exception->getTraceAsString();
                return $result;
            }

            foreach ($array as $fieldName => $fieldValue) {
                $setMethodName = 'set' . ucfirst($fieldName);
                try {
                    $method = $class->getMethod($setMethodName);
                } catch (ReflectionException $exception) {
                    continue;
                }
                if( $method->isPublic() === true ) {
                    $method->invoke($result, $fieldValue);
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
            $publicProps = $class->getProperties(
                ReflectionProperty::IS_PRIVATE
                | ReflectionProperty::IS_PROTECTED
                | ReflectionProperty::IS_PUBLIC
            );
            foreach ($publicProps as $prop) {
                $propName = $prop->name;
                $getMethodName = 'get' . ucfirst($propName);
                try {
                    $method = $class->getMethod($getMethodName);
                } catch (ReflectionException $exception) {
                    continue;
                }
                if( $method->isPublic() === true ) {
                    $value = $method->invoke($this);
                    $array[$propName] = $value;
                }
            }

            return $array;
        }

        /**
         * @param string $json
         *
         * @return $this
         */
        public function fromJson(string $json) :self
        {
            $arrayJson = json_decode($json, true);
            return $this->fromArray($arrayJson);
        }

        /**
         * @return string
         */
        public function toJson() :string
        {
            return json_encode(
                array_values(
                    $this->toArray()
                )
            );
        }

        public function __get($propName)
        {
            try {
                $value = null;
                $class = new ReflectionClass($this);
                $getMethodName = 'get' . ucfirst($propName);
                $method = $class->getMethod($getMethodName);
                if( $method->isPublic() === true ) {
                    $value = $method->invoke($this);
                }
            } catch (ReflectionException $exception) {
                user_error("undefined property $propName");
            }

            return $value;
        }

    }