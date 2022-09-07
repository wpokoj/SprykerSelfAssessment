<?php

namespace Pyz\Zed\FaqSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method FaqSearchBusinessFactory getFactory()
 */
class FaqSearchFacade extends AbstractFacade implements FaqSearchFacadeInterface {

    public function publish(int $id): void {
        $this->getFactory()
            ->createFaqSearchWriter()
            ->publish($id);
    }
}
