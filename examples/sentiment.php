<?php

require "../vendor/autoload.php";

use Fieg\Bayes\Classifier;
use Fieg\Bayes\Tokenizer\StopWordsTokenizer;

$tokenizer = new StopWordsTokenizer(file_get_contents("stop_words/english.txt"));
$classifier = new Classifier($tokenizer);

$classifier->train('negative', file_get_contents('training_data/sentiment/negative-words.txt'));
$classifier->train('positive', file_get_contents('training_data/sentiment/positive-words.txt'));

$result = $classifier->classify('I hate you from the bottom of my heart');
print_r($result);
$result = $classifier->classify('I love you from the bottom of my heart');
print_r($result);
