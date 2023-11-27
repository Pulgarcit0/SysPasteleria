<?php

class HTMLPage
{
    private $title;
    private $cssFiles;

    public function __construct($title, $cssFiles = [])
    {
        $this->title = $title;
        $this->cssFiles = $cssFiles;
    }

    public function start()
    {
        echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='utf-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <meta name='description' content='' />
        <meta name='author' content='' />
        
        <title>{$this->title}</title>";

        foreach ($this->cssFiles as $cssFile) {
            echo "<link href='{$cssFile}' rel='stylesheet' />";
        }

        echo "</head>
    <body>";
    }

    public function end()
    {
        echo "</body></html>";
    }
}
