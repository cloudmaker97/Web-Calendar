<?php
namespace App\Calendar\Table;
use App\Calendar\Builder\StringBuilderTrait;
use App\Interfaces\IHtmlOutput;

/**
 * This class describes a html table wich may contain rows, wich may contain columns.
 * The table can be returned as built HTML table via the IHtmlOutput interface
 */
class Table implements IHtmlOutput
{
    /** @var string HTML tag of a table element */
    private const HTML_TAG = "table";
    /** Trait for building strings */
    use StringBuilderTrait;
    /** @var Row[] The containing rows */
    private array $_Rows;

    public function __construct()
    {
        $this->_Rows = [];
    }

    /**
     * Get the rows of the table
     * @return Row[]
     */
    private function getRows(): array
    {
        return $this->_Rows;
    }

    /**
     * Creates a table row wich can be added
     * @return Row
     */
    public function createRow(): Row
    {
        return new Row();
    }

    /**
     * Adds a row to the table
     * @param Row $row
     * @return void
     */
    public function addRow(Row $row)
    {
        $this->_Rows[] = $row;
    }

    /**
     * @inheritDoc
     */
    public function getHtml(): string
    {
        $this->resetTbText();
        $this->addTbText(sprintf("<%s>", self::HTML_TAG));
        foreach ($this->getRows() as $row) {
            $this->addTbText($row->getHtml());
        }
        $this->addTbText(sprintf("</%s>", self::HTML_TAG));
        return $this->getTbText();
    }
}