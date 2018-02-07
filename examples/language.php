<?php

require "../vendor/autoload.php";

use Fieg\Bayes\Classifier;
use Fieg\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;

$tokenizer = new WhitespaceAndPunctuationTokenizer();
$classifier = new Classifier($tokenizer);

$classifier->train('english', file_get_contents('training_data/language/en.txt'));
$classifier->train('french', file_get_contents('training_data/language/fr.txt'));
$classifier->train('italy', file_get_contents('training_data/language/it.txt'));

// $classifier->train('en', 'This is english');
// $classifier->train('fr', 'Je suis Hollandais');

$result = $classifier->classify('il testo che vogliamo classificare.');
print_r($result);
$result = $classifier->classify('This is english');
print_r($result);
$result = $classifier->classify('Je suis Hollandais');
print_r($result);

/**
 * @param Classifier $classifier
 * @param $label
 * @param $document
 */
function trainDocument($classifier, $label, $document)
{
    $lines = explode("\n", $document);
    foreach ($lines as $line) {
        $line = trim(str_replace("\r", "", $line));
        if (empty($line) || strpos($line, ";") === 0) {
            continue;
        }
        $classifier->train($label, $line);
    }
}
