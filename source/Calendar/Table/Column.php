<?php
namespace App\Calendar\Table;
use App\Calendar\Builder\StringBuilderTrait;
use App\Interfaces\IHtmlOutput;

/**
 * This class describes a column of a row inside a table
 */
class Column implements IHtmlOutput
{
    /** @var string The HTML tag of a table column */
    private const HTML_TAG = "td";
    /** @var string The content of the column */
    private string $_Content = "";
    /** @var string[] CSS Classes */
    private array $CssClasses;
    /** Trait for building strings */
    use StringBuilderTrait;

    public function __construct()
    {
        $this->CssClasses = [];
    }

    /**
     * @inheritDoc
     */
    public function getHtml(): string
    {
        $this->resetTbText();
        if(count($this->getCssClasses()) == 0) {
            $this->addTbText(sprintf("<%s>", self::HTML_TAG));
        } else {
            $classesString = implode(" ", $this->getCssClasses());
            $this->addTbText(sprintf("<%s class='%s'>", self::HTML_TAG, $classesString));
        }
        $this->addTbText($this->getContent()??"");
        $this->addTbText(sprintf("</%s>", self::HTML_TAG));
        return $this->getTbText();
    }

    /**
     * Get the set content of the column
     * @return mixed
     */
    public function getContent(): string
    {
        return $this->_Content;
    }

    /**
     * Set the content of the column
     * @param mixed $Content
     */
    public function setContent(string $Content): Column
    {
        $this->_Content = $Content;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getCssClasses(): array
    {
        return $this->CssClasses;
    }

    /**
     * @param string[] $CssClasses
     */
    public function setCssClasses(array $CssClasses): self
    {
        $this->CssClasses = $CssClasses;
        return $this;
    }
}