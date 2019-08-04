<?php
    namespace Contract;

    interface HandlerInterface
    {
        public function setNextHandler(HandlerInterface $handler): HandlerInterface;
        public function handle(...$data);
    }