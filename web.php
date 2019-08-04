<?php
    try {
        startWebApplication();
    } catch (Exception $exception) {
        Controller::setError(500, $exception);
    }