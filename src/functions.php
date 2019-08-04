<?php

    use Application\WebApplication as WebApplication;
    use Handler\WebHandler;

    function __getWebApplication() :string
    {
        $application = getenv('_APPLICATION') ?: WebHandler::DEFAULT_APPLICATION;
        $application = ucfirst($application);

        return (string) $application;
    }

    function __getWebController() :string
    {
        $controller = getenv('_CONTROLLER') ?: WebHandler::DEFAULT_CONTROLLER;

        return (string) $controller;
    }

    function __getWebAction() :string
    {
        $action = getenv('_ACTION') ?: WebHandler::DEFAULT_ACTION;

        return (string) $action;
    }

    function __getWebData() :array
    {
        $input = (string) getenv('_DATA');
        $data = json_decode (
            $input,
            true
        );
        if ($data === null) $data = [];

        return $data;
    }

    function startWebApplication(
        ?string $application = null,
        ?string $controller = null,
        ?string $action = null,
        ?array $data = null
    )
    {
        $application = $application ?: __getWebApplication();
        $controller = $controller ?: __getWebController();
        $action = $action ?: __getWebAction();
        $data = $data ?: __getWebData();

        /** @var WebApplication $app */
        (new WebApplication())
        ->handle(
            (new WebHandler(
                $application,
                $controller,
                $action)
            ),
            ...array_values($data)
        )
        ->render(
            View::getRender()
        );
    }