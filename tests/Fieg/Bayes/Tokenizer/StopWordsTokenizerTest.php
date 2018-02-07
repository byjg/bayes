<?php

if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

class StopWordsTokenizerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider tokenizeDataProvider
     * @param $string
     * @param $expected
     */
    public function testTokenize($string, $expected)
    {
        $tokenizer = new \Fieg\Bayes\Tokenizer\StopWordsTokenizer("is an of en la de UN");

        $result = $tokenizer->tokenize($string);

        $this->assertEquals($expected, $result);
    }

    public function tokenizeDataProvider()
    {
        return array(
            array(
                'This is an example of good choices',
                array(
                    0 => 'this',
                    3 => 'example',
                    5 => 'good',
                    6 => 'choices'
                )
            ),
            array(
                "This \nis an example \r\nof good \rchoices",
                array(
                    0 => 'this',
                    3 => 'example',
                    5 => 'good',
                    6 => 'choices'
                )
            ),
            array(
                "; Comment Should be ignored.\nThis is an example of good choices",
                array(
                    0 => 'this',
                    3 => 'example',
                    5 => 'good',
                    6 => 'choices'
                )
            ),
            array(
                "Un importante punto de inflexión en la historia de la ciencia filosófica primitiva",
                array(
                    1 => 'importante',
                    2 => 'punto',
                    4 => 'inflexión',
                    7 => 'historia',
                    10 => 'ciencia',
                    11 => 'filosófica',
                    12 => 'primitiva'
                )
            ),
        );
    }
}
