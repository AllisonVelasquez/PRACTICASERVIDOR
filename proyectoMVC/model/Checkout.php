<?php
class Checkout
{
    private $idUser, $idBook, $dateP, $dateD;

    function __construct($idUser, $idBook)
    {
        $this->idUser = $idUser;
        $this->idBook = $idBook;
        $this->dateP = time();
        $this->dateD = time() + 1296000;
    }
}
