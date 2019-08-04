<?php
    namespace Application\Admin\Controller;

    use Controller;

    class Index extends Controller {

        public function index()
        {
            self::__setData('awesome', 42);
        }
    }