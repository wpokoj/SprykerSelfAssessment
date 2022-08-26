<?php

namespace Pyz\Client\Faq\Zed;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class FaqZedStub implements FaqZedStubInterface {

    protected ZedRequestClientInterface $zedRequestClient;

    public function __construct(ZedRequestClientInterface $zedRequestClient) {
        $this->zedRequestClient = $zedRequestClient;
    }

    public function getAllFaqs(FaqDataCollectionTransfer $trans): FaqDataCollectionTransfer {

        /** @var \Generated\Shared\Transfer\FaqDataCollectionTransfer $faqCollectionTransfer */

        $faqCollectionTransfer = $this->zedRequestClient->call(
            '/faq/gateway/get-faq-collection-paginated',
            $trans
        );

        return $faqCollectionTransfer;

    }

    public function sendVoteRequest(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer {

        /** @var \Generated\Shared\Transfer\FaqVoteRequestTransfer $faqCollectionTransfer */

        $faqCollectionTransfer = $this->zedRequestClient->call(
            '/faq/gateway/send-vote',
            $trans
        );

        return $faqCollectionTransfer;
    }
}
