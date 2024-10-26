<?php
class routerController
{
    private $url;

    public function process($params)
    {
        $this->url = $params[0];
    }

    public function renderView()
    {
        echo "Processing URL: " . $this->url;
    }
}
