<?php

declare(strict_types=1);

namespace GildedRose\Items;

class AgedBrie extends DefaultItem
{
    public function updateQuality(): void
    {
        $this->increaseQuality();
        $this->decreaseSellIn();

        if ($this->item->sell_in < 0) {
            $this->increaseQuality();
        }

        if ($this->item->quality > 50) {
            $this->setQuality(50);
        }
    }
}
