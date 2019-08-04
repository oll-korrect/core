<?php

    use Contract\RenderInterface;
    use Twig\Environment as TwigEnvironment;
    use Twig\Extension\DebugExtension;
    use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;

    final class View implements RenderInterface {

        const DEFAULT_EXTENSION = 'html.twig';
        const DEFAULT_LAYOUT = 'index';
        const DEFAULT_PAGE = 'index_index_index';

        /** @var TwigEnvironment|null $_render */
        private static ?TwigEnvironment $_render = null;
        private static ?RenderInterface $_instance = null;

        private function __construct() {
            if(self::$_render === null) {
                $twig_loader = new TwigFilesystemLoader(
                    $_SERVER['DOCUMENT_ROOT'] . '/../view/'
                );
                $twig = new TwigEnvironment($twig_loader, [
                    'cache' => $_SERVER['DOCUMENT_ROOT'] . '/../view/cache',
                    'debug' => true
                ]);

                $twig->addExtension(new DebugExtension());

                self::$_render = $twig;
            }
        }

        public static function getRender() :RenderInterface
        {
            if(self::$_instance === null) self::$_instance = new self();

            return self::$_instance;
        }

        /**
         * @param string $page
         * @param array|null $data
         *
         * @return string
         * @throws \Twig\Error\LoaderError
         * @throws \Twig\Error\RuntimeError
         * @throws \Twig\Error\SyntaxError
         */
        public function render(string $page = '', ?array $data = []) :string
        {
            $page = ($page === '') ? self::DEFAULT_PAGE : $page;
            $page .= '.' . self::DEFAULT_EXTENSION;
            $data['layout'] = ($data['layout'] === null) ? self::DEFAULT_LAYOUT : (string) $data['layout'];
            return self::$_render->render(
                $page,
                $data
            );
        }

    }