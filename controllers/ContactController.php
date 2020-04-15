<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/**
 * Class ContactController; connects with the contact view
 */
class ContactController extends BaseController
{
    public $file = './views/contact/';
    public $style = 'src/css/';

    public function index()
    {
        $this->file .= "contact.view.php";
        $this->style .= "contact.css";
        $this->render();
    }
}