<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method FaqFactory getFactory()
 */
class FaqClient extends AbstractClient implements FaqClientInterface {


    public function getAllFaqs(FaqCollectionTransfer $trans): FaqCollectionTransfer {

        return  $this->getFactory()->createFaqZedStub()->getAllFaqs($trans);
    }

    public function sendVoteRequest(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer {

        return $this->getFactory()->createFaqZedStub()->sendVoteRequest($trans);
    }
}
