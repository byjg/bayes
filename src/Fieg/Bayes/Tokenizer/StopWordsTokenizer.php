<?php

namespace Fieg\Bayes\Tokenizer;

class StopWordsTokenizer extends WhitespaceAndPunctuationTokenizer
{
    protected $stopWords = array();

    public function __construct($words)
    {
        $this->stopWords = parent::tokenize($words);
    }

    public function tokenize($string)
    {
        $words = parent::tokenize($string);
        return array_diff($words, $this->stopWords);
    }
}
