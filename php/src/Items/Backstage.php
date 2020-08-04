<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Backstage extends DefaultItem
{
    private const SELL_IN_FIRST_INCREASE = 10;

    private const SELL_IN_SECOND_INCREASE = 5;

    public function updateQuality(): void
    {
        $this->increaseQuality();

        if ($this->item->sell_in <= self::SELL_IN_FIRST_INCREASE) {
            $this->increaseQuality();
        }

        if ($this->item->sell_in <= self::SELL_IN_SECOND_INCREASE) {
            $this->increaseQuality();
        }

        if ($this->item->quality > self::MAX_QUALITY) {
            $this->setQuality(self::MAX_QUALITY);
        }

        $this->decreaseSellIn();

        if ($this->item->sell_in < self::MIN_SELL_IN) {
            $this->setQuality(self::MIN_QUALITY);
        }
    }
}
