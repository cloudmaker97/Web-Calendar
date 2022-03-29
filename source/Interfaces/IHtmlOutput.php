<?php
namespace App\Interfaces;

/**
 * This class describes that an element contains a method
 * for returning its expected html source code.
 */
interface IHtmlOutput
{
    /**
     * Returns the HTML code of an element
     * @return string
     */
    public function getHtml(): string;
}