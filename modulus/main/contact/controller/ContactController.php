<?php 

namespace modulus\main\contact\controller;
use modulus\main\contact\model\contactModel;
use core\controller;

class ContactController extends controller
{
    public $contact;
    
    public function __construct()
    {
        $this->contact = new ContactModel();
    }

    public function ContactPage()
    {
        $this->layout('main', 'main', 'contact', 'contact', []);
    }

    public function SendMessage()
    {
        $this->contact->SendMessage();
    }
}
