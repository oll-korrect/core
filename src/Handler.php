<?php

    use Contract\HandlerInterface;

    /**
     * Поведение цепочки по умолчанию может быть реализовано внутри базового класса
     * обработчика.
     */
    abstract class Handler implements HandlerInterface
    {
        /**
         * @var HandlerInterface|null ?HandlerInterface $nextHandler
         */
        private ?HandlerInterface $nextHandler = null;

        public function setNextHandler(HandlerInterface $handler): HandlerInterface
        {
            $this->nextHandler = $handler;

            return $handler;
        }

        /**
         * @return HandlerInterface|null
         */
        public function getNextHandler(): ?HandlerInterface
        {
            return $this->nextHandler;
        }

        /**
         * @param mixed $data
         *
         * @return mixed|null
         */
        public function handle(...$data)
        {
            if(is_array($data) === true) {
                return $this->nextHandler->handle(...array_values($data));
            } elseif($data !== null) {
                return $this->nextHandler->handle($data);
            }

            return $this->nextHandler->handle();
        }
    }