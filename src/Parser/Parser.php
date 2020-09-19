<?php
namespace ReceiptPrintHq\EscposTools\Parser;

use ReceiptPrintHq\EscposTools\Parser\Command\Printout;
use ReceiptPrintHq\EscposTools\Parser\Context\ParserContextImpl;

/**
 * API to parse files and iterate the results..
 *
 * Note that the actual parser has a character-only interface.
 */
class Parser
{
    protected $printout;

    public function __construct($profileName = "default")
    {
        $context = ParserContextImpl::byProfileName($profileName);
        $this->printout = new Printout($context);
    }

    public function getCommands()
    {
        return $this->printout->commands;
    }

    public function addFile($fp)
    {
        while (!feof($fp) && is_resource($fp)) {
            $block = fread($fp, 8192);
            for ($i = 0; $i < strlen($block); $i++) {
                $this->printout->addChar($block[$i]);
            }
        }
    }

    public function addBinRaw($raw)
    {
        $hex = '1b401b64021b21002020a6a8bbf5b0b7b164a8c6b77ea6b3adada4bda5710a1b21002020202020204e4f2e36343337323630330a1b2100bb4fab6ea5aba677ab6eb0cfaaf8b7cbb8f4a440ac71323736b8b90a1b2100202020202054454c3a30362d323536303236330a1b21002020323032302f30392f31372031333a35383a35330a1b64021b2100a4f2a47920202020202020202020202020203130302054580a1b21003d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d3d0a1b21002020202020202020202020a658ad703a20202020243130300a1b64011b21002020202020202020202020a549b27b3a20202020243130300a1b21002020202020202020202020a7e4b9733a20202020202024300a0c';
        $bin = str_split(pack("H*", $hex));
        foreach ($bin as $char) {
            $this->printout->addChar($char);
        }
    }
}
