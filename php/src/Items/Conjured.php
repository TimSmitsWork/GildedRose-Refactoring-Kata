<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Conjured extends DefaultItem
{
    private const QUALITY_MULTIPLIER = 2;

    public function updateQuality(): void
    {
        if ($this->item->quality > self::MIN_QUALITY) {
            $this->decreaseQuality(self::QUALITY_MULTIPLIER);
        }

        $this->decreaseSellIn();

        if ($this->item->sell_in < self::MIN_SELL_IN && $this->item->quality > self::MIN_QUALITY) {
            $this->decreaseQuality(self::QUALITY_MULTIPLIER);
        }

        if ($this->item->quality < self::MIN_QUALITY) {
            $this->setQuality(self::MIN_QUALITY);
        }
    }
}
