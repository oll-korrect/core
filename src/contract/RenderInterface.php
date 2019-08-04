<?php
    namespace Contract;

    interface RenderInterface {
        /**
         * @param string $page
         * @param array|null $data
         *
         * @return string
         */
        public function render(string $page = '', ?array $data = []) :string;
    }