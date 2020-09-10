<?php

namespace app\controllers;


class _Controller
{

    public function __construct($request, $payload) {
        $this->route($request, $payload);
    }

    public function route($request, $payload){}

}