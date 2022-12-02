<?php
namespace App\Calendar\Builder;

/**
 * This trait helps especially with the creation
 * of strings and offers the service for storing it local
 */
trait StringBuilderTrait
{
    /** @var string The string wich is composed by this trait */
    private $_BuiltString = "";

    /**
     * Add text to a built string
     * @param string $Text
     * @return void
     */
    private function addTbText(string $Text): void
    {
        $this->_BuiltString .= $Text;
    }

    /**
     * Reset the content from the built string
     * @return void
     */
    private function resetTbText(): void
    {
        unset($this->_BuiltString);
    }

    /**
     * Get the content from the built string
     * @return string
     */
    private function getTbText(): string
    {
        return $this->_BuiltString??"";
    }
}