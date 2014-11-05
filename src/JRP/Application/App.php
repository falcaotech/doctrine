<?php

namespace JRP\Application;

use \Silex\Application;

class App extends Application {

    public function __construct(array $config = array())
    {
        parent::__construct($config);
    }

} 