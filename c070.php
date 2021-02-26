<?php
$cardsNum = trim(fgets(STDIN));
$cardCombination = [];

for ($i = 0; $i < $cardsNum; $i++) {
    $cards = trim(fgets(STDIN));
    $hand = new Hand($cards);
    $poker = new Poker();
    $cardCombination[] = $poker->checkHand($hand);
}

echo implode(PHP_EOL, $cardCombination);

class Hand
{
    private $cards;

    public function __construct(string $cards)
    {
        $this->cards = str_split($cards);
    }

    public function getCards()
    {
        return $this->cards;
    }
}

class Poker
{
    const FOUR_CARD = "Four Card";
    const THREE_CARD = "Three Card";
    const TWO_PAIR = "Two Pair";
    const ONE_PAIR = "One Pair";
    const NO_PAIR = "No Pair";
    const ONE_TYPE = 1;
    const TWO_TYPES = 2;
    const THREE_TYPES = 3;

    public function checkHand(Hand $hand)
    {
        $card = $hand->getCards();
        $soleCards = array_unique($card);
        $count = count($soleCards);

        if ($count === self::ONE_TYPE) return self::FOUR_CARD;
        if ($count === self::TWO_TYPES) {
            $cardsNum = array_count_values($card);
            $num = array_values($cardsNum);

            if ($num[0] != $num[1]) return self::THREE_CARD;
            return self::TWO_PAIR;
        }
        if ($count == self::THREE_TYPES) return self::ONE_PAIR;
        return self::NO_PAIR;
    }
}
