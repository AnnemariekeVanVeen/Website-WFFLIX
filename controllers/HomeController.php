<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/**
 * Class HomeController; connects with the home view
 */
class HomeController extends BaseController
{

    public $file = './views/home/';
    public $style = 'src/css/';

    public function index()
    {
        $this->file .= 'home.view.php';
        $this->style .= 'home.css';
        $this->render();
    }
}