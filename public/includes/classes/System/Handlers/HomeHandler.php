<?php

namespace System\Handlers;

/**
 * Class HomeHandler
 * @package System\Handlers
 */

class HomeHandler extends BaseHandler
{

    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        //Return info
        $this->renderTemplate([
            'pageTitle' => 'Home',
        ]);
    }
}