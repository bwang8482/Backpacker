<?php
include 'Opinion.php';
$op = new Opinion();
$op->addToIndex(__DIR__ . '/rt-polarity.neg', 'neg');
$op->addToIndex(__DIR__ . '/rt-polarity.pos', 'pos');


$text="did we really act this way twenty years ago ? of course not";
$sentences = explode(".", $text);
$score = array('pos' => 0, 'neg' => 0);
foreach($sentences as $sentence) {
        if(strlen(trim($sentence))) {
                $polarity = $op->classify($sentence);
                $score[$polarity]++;
        }
}
var_dump($score);




//$string = "This movie was noting else but a huge disappointment.";
//echo "Classifying '$string' - " . $op->classify($string) . "\n";
//$string = "Twilight was an atrocious movie, filled with stumbling, awful dialogue, and ridiculous story telling.";
//echo "Classifying '$string' - " . $op->classify($string) . "\n";
//$string = "Loving this wheater";
//echo "Classifying '$string' - " . $op->classify($string) . "\n";
?>
