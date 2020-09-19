<?php
namespace ReceiptPrintHq\EscposTools\Parser\Command;

use ReceiptPrintHq\EscposTools\Parser\Command\CommandOneArg;
use ReceiptPrintHq\EscposTools\Parser\Command\LineBreak;

class PrintAndFeedLinesCmd extends CommandOneArg implements LineBreak
{
    public function getLineCount()
    {
        return intval($this->getArg());
    }
}
