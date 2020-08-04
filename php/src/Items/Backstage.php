<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Backstage extends DefaultItem
{
    public function updateQuality(): void
    {
        $this->increaseQuality();

        if ($this->item->sell_in <= 10) {
            $this->increaseQuality();
        }

        if ($this->item->sell_in <= 5) {
            $this->increaseQuality();
        }

        if ($this->item->quality > 50) {
            $this->setQuality(50);
        }

        $this->decreaseSellIn();

        if ($this->item->sell_in < 0) {
            $this->setQuality(0);
        }
    }
}
