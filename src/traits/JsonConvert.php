<?php
    namespace Traits;

    use ReflectionClass as ReflectionClassAlias;
    use ReflectionException;
    use ReflectionProperty;

    trait JsonConvert
    {

        /**
         * @param string $json
         *
         * @return $this
         */
        public function fromJson(string $json) :self
        {
            $result = clone $this;
            $objJson = json_decode($json);
            try {
                $class = new ReflectionClassAlias($result);
            } catch (ReflectionException $exception) {
                return $result;
            }
            $publicProps = $class->getProperties(ReflectionProperty::IS_PUBLIC);
            foreach ($publicProps as $prop) {
                $propName = $prop->name;
                if (isset($objJson->$propName)) {
                    $prop->setValue($result, $objJson->$propName);
                }
                else {
                    $prop->setValue($result, null);
                }
            }

            return $result;
        }

        /**
         * @return string
         */
        public function toJson() :string
        {
            return json_encode($this);
        }
    }