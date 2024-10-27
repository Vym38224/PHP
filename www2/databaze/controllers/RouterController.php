<?php
class routerController
{
    private $url;

    public function process($params)
    {
        $this->url = $params[0];
    }
}
