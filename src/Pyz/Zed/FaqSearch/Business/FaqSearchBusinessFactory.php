<?php

namespace Pyz\Zed\FaqSearch\Business;

use Pyz\Zed\FaqSearch\Business\Writer\FaqSearchWriter;

class FaqSearchBusinessFactory {

    public function createFaqSearchWriter(): FaqSearchWriter {
        return new FaqSearchWriter();
    }
}
