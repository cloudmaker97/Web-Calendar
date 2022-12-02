<?php
namespace App\Calendar\Table;
use App\Calendar\Builder\StringBuilderTrait;
use App\Interfaces\IHtmlOutput;

/**
 * This class describes a row of a table, wich
 * may contain columns with content
 */
class Row implements IHtmlOutput
{
    /** @var string The HTML tag of a table row */
    private const HTML_TAG = "tr";
    /** @var Column[] The containing columns */
    private array $Columns;
    /** @var string[] CSS Classes */
    private array $CssClasses;
    /** Trait for building strings */
    use StringBuilderTrait;

    public function __construct()
    {
        $this->Columns = [];
        $this->CssClasses = [];
    }

    /**
     * Adds a column to the row
     * @param Column $column
     * @return void
     */
    public function addColumn(Column $column)
    {
        $this->Columns[] = $column;
    }

    /**
     * Get the columns of the row
     * @return Column[]
     */
    public function getColumns(): array
    {
        return $this->Columns;
    }

    /**
     * Creates a column wich can be added
     * @return Column
     */
    public function createColumn(): Column
    {
        return new Column();
    }

    /**
     * @inheritDoc
     */
    public function getHtml(): string
    {
        $this->resetTbText();
        /** @var Column $column */
        if(count($this->getCssClasses()) == 0) {
            $this->addTbText(sprintf("<%s>", self::HTML_TAG));
        } else {
            $classesString = implode(" ", $this->getCssClasses());
            $this->addTbText(sprintf("<%s class='%s'>", self::HTML_TAG, $classesString));
        }
        foreach ($this->getColumns() as $column) {
            $this->addTbText($column->getHtml());
        }
        $this->addTbText(sprintf("</%s>", self::HTML_TAG));
        return $this->getTbText();
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
    public function setCssClasses(array $CssClasses): void
    {
        $this->CssClasses = $CssClasses;
    }

    public function hasColumns(): bool
    {
        return count($this->Columns) !== 0;
    }

}