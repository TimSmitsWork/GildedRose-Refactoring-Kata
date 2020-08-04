<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Backstage extends DefaultItem
{
    public function updateQuality(): void
    {
        ++$this->item->quality;

        if ($this->item->sell_in <= 10) {
            ++$this->item->quality;
        }

        if ($this->item->sell_in <= 5) {
            ++$this->item->quality;
        }

        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        }

        --$this->item->sell_in;

        if ($this->item->sell_in < 0) {
            $this->item->quality = 0;
        }
    }
}
