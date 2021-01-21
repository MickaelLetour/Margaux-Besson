<?php

namespace App\Entity;

class PhotoSearch {

    private $theme;

    private $header;
    

    /**
     * Get the value of theme
     */ 
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set the value of theme
     *
     * @return  self
     */ 
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get the value of header
     */ 
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */ 
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }
}