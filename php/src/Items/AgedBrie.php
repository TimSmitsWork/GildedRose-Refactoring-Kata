<?php

declare(strict_types=1);

namespace GildedRose\Items;

class AgedBrie extends DefaultItem
{
    public function updateQuality(): void
    {
        ++$this->item->quality;
        --$this->item->sell_in;

        if ($this->item->sell_in < 0) {
            ++$this->item->quality;
        }

        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        }
    }
}
