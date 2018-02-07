<?php

require "../vendor/autoload.php";

use Fieg\Bayes\Classifier;
use Fieg\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;

$tokenizer = new WhitespaceAndPunctuationTokenizer();
$classifier = new Classifier($tokenizer);

$classifier->addStopWordFromDocument(file_get_contents("stop_words/english.txt"));
$classifier->trainDocument('negative', file_get_contents('training_data/sentiment/negative-words.txt'));
$classifier->trainDocument('positive', file_get_contents('training_data/sentiment/positive-words.txt'));

// $classifier->train('en', 'This is english');
// $classifier->train('fr', 'Je suis Hollandais');

$result = $classifier->classify('I hate you from the bottom of my heart');
print_r($result);
$result = $classifier->classify('I love you from the bottom of my heart');
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
