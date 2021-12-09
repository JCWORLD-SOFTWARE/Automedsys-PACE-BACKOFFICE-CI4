<?php

namespace App\Libraries;

use SimpleXMLElement;

class XmlProcessor
{
    private $output;
    private bool $isSanitized = false;

    public function __construct(string $value)
    {
        $this->output = $value;
    }

    public function sanitize()
    {
        $output = preg_replace("/<((?!xs:element|xs:sequence|xs:schema|diffgr:diffgram)([a-zA-Z][a-zA-Z0-9_:]*))[^>]*?(\/?)>/si", '<$2$3>', $this->output);
        $output = preg_replace("/([<\/])([a-zA-Z]*)(:)([a-zA-Z]*)/si", '$1$2$4', $output);
        $output = preg_replace("/([a-zA-Z]*)(:)([a-zA-Z]*)(=)/si", '$1$3$4', $output);
        $output = str_replace('encoding="utf-16"', 'encoding="utf-8"', $output);

        $this->isSanitized = true;
        $this->output = $output;

        return $this;
    }

    public function toArray()
    {
        if (!$this->isSanitized) {
            $this->sanitize();
        }

        $document = new SimpleXMLElement($this->output);

        $this->output = json_decode(json_encode($document), true);

        return $this;
    }

    public function jsonToArray()
    {
        $this->output = json_decode($this->output, true);

        return $this;
    }

    public function base64Decode()
    {
        $this->output = base64_decode((string) $this->output);

        return $this;
    }

    public function gzDecode()
    {
        $this->output = gzdecode($this->output);

        return $this;
    }

    public function get()
    {
        return $this->output;
    }
}
