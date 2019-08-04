<?php
    namespace Application;

    use Contract\ApplicationInterface;
    use Contract\HandlerInterface;
    use Contract\RenderInterface;
    use Exception;
    use Controller;

    final class WebApplication implements ApplicationInterface {

        /**
         * @param \Contract\HandlerInterface $handler
         * @param mixed ...$data
         *
         * @return $this
         */
        public function handle(HandlerInterface $handler, ...$data)
        {
            $handler->handle(...$data);

            return $this;
        }

        /**
         * @param RenderInterface $view
         */
        public function render(RenderInterface $view)
        {
            $data['layout'] = Controller::__getData('layout');
            $page = (string) Controller::__getData('page');
            $data = Controller::__getData();
            try {
                $render = $view->render(
                    $page,
                    $data
                );
                echo $render;
            } catch (Exception $exception) {
                Controller::setError(404, $exception);
            }

            fastcgi_finish_request();
        }

    }