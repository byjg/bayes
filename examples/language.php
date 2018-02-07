<?php

require "../vendor/autoload.php";

use Fieg\Bayes\Classifier;
use Fieg\Bayes\Tokenizer\WhitespaceAndPunctuationTokenizer;

$tokenizer = new WhitespaceAndPunctuationTokenizer();
$classifier = new Classifier($tokenizer);

$classifier->train('english', file_get_contents('training_data/language/en.txt'));
$classifier->train('french', file_get_contents('training_data/language/fr.txt'));
$classifier->train('italy', file_get_contents('training_data/language/it.txt'));

$result = $classifier->classify('il testo che vogliamo classificare.');
print_r($result);
$result = $classifier->classify('This is english');
print_r($result);
$result = $classifier->classify('Je suis Hollandais');
print_r($result);
