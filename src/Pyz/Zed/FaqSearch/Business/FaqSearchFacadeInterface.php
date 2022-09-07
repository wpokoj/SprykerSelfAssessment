<?php

namespace Pyz\Zed\FaqSearch\Business;

interface FaqSearchFacadeInterface {
    public function publish(int $id): void;
}
