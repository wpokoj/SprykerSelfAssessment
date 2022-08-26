<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method FaqFactory getFactory()
 */
class FaqClient extends AbstractClient implements FaqClientInterface {


    public function getAllFaqs(FaqDataCollectionTransfer $trans): FaqDataCollectionTransfer {

        return  $this->getFactory()->createFaqZedStub()->getAllFaqs($trans);
    }
}
