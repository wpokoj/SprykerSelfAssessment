<?php

namespace Pyz\Client\FaqsRestApi\Zed;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class FaqsRestApiZedStub implements FaqsRestApiZedStubInterface {

    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param FaqCollectionTransfer $faqCollectionTransfer
     * @return \Generated\Shared\Transfer\FaqCollectionTransfer
     */
    public function getFaqCollection(
        FaqCollectionTransfer $faqCollectionTransfer
    ): FaqCollectionTransfer
    {
        /** @var \Generated\Shared\Transfer\FaqCollectionTransfer $faqCollectionTransfer */

        $faqCollectionTransfer = $this->zedRequestClient->call(
            '/faq/gateway/get-faq-collection',
            $faqCollectionTransfer
        );

        return $faqCollectionTransfer;
    }

    public function getFaqEntity(FaqTransfer $trans): ?FaqTransfer {

        try {
            /** @var null|\Generated\Shared\Transfer\FaqTransfer $trans */

            $trans = $this->zedRequestClient->call(
                '/faq/gateway/get-faq-entity',
                $trans
            );
        }
        catch(\Exception $e) { // not found
            return null;
        }

        return $trans;
    }

    protected function boolRequest(FaqTransfer $trans, string $endpoint): bool {
        try {
            /** @var null|\Generated\Shared\Transfer\FaqTransfer $trans */

            $trans = $this->zedRequestClient->call(
                $endpoint,
                $trans
            );
        }
        catch(\Exception $e) { // not found
            return false;
        }

        return true;
    }

    public function createFaqEntity(FaqTransfer $trans): bool {
        return $this->boolRequest($trans, '/faq/gateway/create-faq-entity');
    }

    public function deleteFaqEntity(FaqTransfer $trans): bool {
        return $this->boolRequest($trans, '/faq/gateway/delete-faq-entity');
    }

    public function updateFaqEntity(FaqTransfer $trans): bool {
        return $this->boolRequest($trans, '/faq/gateway/update-faq-entity');
    }



    public function getUserVotesCollection(FaqVoteCollectionTransfer $coll): FaqVoteCollectionTransfer {
        try {
            /** @var \Generated\Shared\Transfer\FaqVoteCollectionTransfer $coll */
            $coll = $this->zedRequestClient->call(
                '/faq/gateway/get-faq-vote-collection',
                $coll
            );
        }
        catch(\Exception $e) { // not found
            return $coll;
        }

        return $coll;
    }

    public function getUserVoteByFaqId(FaqVoteTransfer $trans): FaqVoteTransfer {
        try {
            /** @var \Generated\Shared\Transfer\FaqVoteTransfer $trans */
            $trans = $this->zedRequestClient->call(
                '/faq/gateway/get-faq-vote-by-id',
                $trans
            );
        }
        catch(\Exception $e) { // not found
            return $trans;
        }

        return $trans;
    }

    public function setUserVote(FaqVoteTransfer $trans): FaqVoteTransfer {

        //var_dump($trans);

        try {
            /** @var \Generated\Shared\Transfer\FaqVoteTransfer $trans */
            $trans = $this->zedRequestClient->call(
                '/faq/gateway/set-faq-vote',
                $trans
            );
        }
        catch(\Exception $e) { // not found
            var_dump($e->getMessage());
            return $trans;
        }

        return $trans;
    }
}
