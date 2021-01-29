<?php

namespace App\Helpers;
use Lang;

class Document
{
    private $title;
    private $styles = [];
    private $scripts = [];
    private $breadcrumbs = [];

    public function setStyle($href, $rel = 'stylesheet', $media = 'screen')
    {
        $this->styles[] = [
            'href'  => $href,
            'rel'   => $rel,
            'media' => $media
        ];
    }

    public function getStyles()
    {
        return $this->styles;
    }

    public function setScript()
    {

    }

    public function getScripts()
    {

    }

    public function setBreadcrumb($title, $href)
    {
        $this->breadcrumbs[] = [
            'title' => $title,
            'href' => asset($href),
        ];
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

}
