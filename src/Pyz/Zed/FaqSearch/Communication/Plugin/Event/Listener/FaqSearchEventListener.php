<?php

namespace Pyz\Zed\FaqSearch\Communication\Plugin\Event\Listener;

use Pyz\Zed\Faq\Dependency\FaqEvents;
use Pyz\Zed\FaqSearch\Business\FaqSearchFacadeInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method FaqSearchFacadeInterface getFacade()
 */
class FaqSearchEventListener extends AbstractPlugin implements EventHandlerInterface {
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param string $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void {
        /** @var \Generated\Shared\Transfer\EventEntityTransfer $transfer */
        if ($eventName === FaqEvents::ENTITY_PYZ_FAQ_CREATE) {
            $this->getFacade()->publish($transfer->getId());
        }
    }
}
