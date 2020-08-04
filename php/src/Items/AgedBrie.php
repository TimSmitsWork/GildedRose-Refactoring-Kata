<?php

declare(strict_types=1);

namespace GildedRose\Items;

class AgedBrie extends DefaultItem
{
    public function updateQuality(): void
    {
        $this->increaseQuality();
        $this->decreaseSellIn();

        if ($this->item->sell_in < self::MIN_SELL_IN) {
            $this->increaseQuality();
        }

        if ($this->item->quality > self::MAX_QUALITY) {
            $this->setQuality(self::MAX_QUALITY);
        }
    }
}
