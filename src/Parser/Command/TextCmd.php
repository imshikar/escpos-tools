<?php
namespace ReceiptPrintHq\EscposTools\Parser\Command;

use ReceiptPrintHq\EscposTools\Parser\Command\Command;
use ReceiptPrintHq\EscposTools\Parser\Command\TextContainer;

class TextCmd extends Command implements TextContainer
{
    private $str = "";

    public function addChar($char)
    {
        if (isset(Printout::$tree[$char])) {
            // Reject ESC/POS control chars.
            return false;
        }
        $this->str .= $char;
        return true;
    }

    public function getText()
    {
        return mb_convert_encoding($this->str, "UTF-8", "Big5");
    }
}
