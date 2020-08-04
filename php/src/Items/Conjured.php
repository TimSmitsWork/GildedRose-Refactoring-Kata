<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Conjured extends DefaultItem
{
    public function updateQuality(): void
    {
        if ($this->item->quality > 0) {
            $this->decreaseQuality(2);
        }

        $this->decreaseSellIn();

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
            $this->decreaseQuality(2);
        }

        if ($this->item->quality < 0) {
            $this->setQuality(0);
        }
    }
}
