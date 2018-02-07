<?php

if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

class WhitespaceAndPunctuationTokenizerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider tokenizeDataProvider
     * @param $string
     * @param $expected
     */
    public function testTokenize($string, $expected)
    {
        $tokenizer = new \Fieg\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer();

        $result = $tokenizer->tokenize($string);

        $this->assertEquals($expected, $result);
    }

    public function tokenizeDataProvider()
    {
        return array(
            array(
                'This is an example of good choices',
                array(
                    'this',
                    'is',
                    'an',
                    'example',
                    'of',
                    'good',
                    'choices'
                )
            ),
            array(
                "This \nis an example \r\nof good \rchoices",
                array(
                    'this',
                    'is',
                    'an',
                    'example',
                    'of',
                    'good',
                    'choices'
                )
            ),
            array(
                "; Comment Should be ignored.\nThis is an example of good choices",
                array(
                    'this',
                    'is',
                    'an',
                    'example',
                    'of',
                    'good',
                    'choices'
                )
            ),
            array(
                "Un importante punto de inflexión en la historia de la ciencia filosófica primitiva",
                array(
                    'un',
                    'importante',
                    'punto',
                    'de',
                    'inflexión',
                    'en',
                    'la',
                    'historia',
                    'de',
                    'la',
                    'ciencia',
                    'filosófica',
                    'primitiva'
                )
            ),
        );
    }
}
