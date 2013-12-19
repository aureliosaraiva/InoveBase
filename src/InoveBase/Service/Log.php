<?php

namespace InoveBase\Service;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class Log extends Logger {

    public function __construct() {
        parent::__construct();
        
        $stream = fopen('data/inoverh.log', 'a', false);
        if (!$stream) {
            throw new Exception('Failed to open stream');
        }

        $writer = new Stream($stream);
        
        $this->addWriter($writer);
    }

}
