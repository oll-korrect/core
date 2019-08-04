<?php
    namespace Handler;

    use Closure;
    use Contract\HandlerInterface;
    use Controller;
    use Handler as MainHandler;

    final class WebHandler extends MainHandler implements HandlerInterface {

        private ?Closure $_handler;

        const DEFAULT_APPLICATION = 'Index';
        const DEFAULT_CONTROLLER = 'Index';
        const DEFAULT_ACTION = 'index';

        public function __construct (
            string $application = self::DEFAULT_APPLICATION,
            string $controller = self::DEFAULT_CONTROLLER,
            string $action = self::DEFAULT_ACTION
        )
        {
            $application = ucfirst($application);
            $namespace = explode('/', $controller);
            $controllerPage = $controller;
            if ( is_array($namespace) === true ) {
                $controller = '';
                foreach ($namespace as $key => $class) {
                    if($class !== '') {
                        if ($key !== 0) $controller .= '\\';
                        $controller .= ucfirst($class);
                    }
                }
                $controllerPage = implode('-', $namespace);
                unset($namespace);
            }

            $class = 'Application\\'. $application .'\\Controller\\' . $controller;
            if(class_exists($class) !== true) {
                $class = 'Application\\' . self::DEFAULT_APPLICATION . '\\Controller\\' . $application . '\\' . $controller;
                if(class_exists($class) !== true) {
                    $class = 'Application\\' . self::DEFAULT_APPLICATION . '\\Controller\\' . self::DEFAULT_CONTROLLER;
                    $action = self::DEFAULT_ACTION;
                }
            }

            if ( method_exists($class, $action) !== true ) {
                $class = 'Application\\' . self::DEFAULT_APPLICATION . '\\Controller\\' . self::DEFAULT_CONTROLLER;
                $action = self::DEFAULT_ACTION;
            }

            $page = implode(
                '_',
                [
                    $application,
                    $controllerPage,
                    $action
                ]
            );

            $page = strtolower($page);

            Controller::__setData('page', $page);

            $this->_handler = function (...$data) use ($class, $action) {
                $handler = new $class();
                return $handler->$action(...$data);
            };
        }

        public function handle(...$data)
        {
            $handler = $this->_handler;
            if(is_array($data) === true) {
                $result = $handler(...array_values($data));
            } elseif($data !== null) {
                $result = $handler($data);
            } else {
                $result = $handler();
            }

            if ($this->getNextHandler() === null) {
                return $result;
            }

            if(is_array($result) === true) {
                return parent::handle(...array_values($result));
            } elseif($result !== null) {
                return parent::handle($result);
            }

            return parent::handle();
        }
    }