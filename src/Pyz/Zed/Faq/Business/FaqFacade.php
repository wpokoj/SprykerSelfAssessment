<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method FaqBusinessFactory getFactory()
 */
class FaqFacade extends AbstractFacade implements FaqFacadeInterface {

    public function createFaqEntity(FaqTransfer $trans): FaqTransfer {

        return $this->getFactory()
            ->createFaqWriter()
            ->createFaqEntity($trans);
    }

    public function updateFaqEntity(FaqTransfer $trans): FaqTransfer {

        return $this->getFactory()
            ->createFaqUpdater()
            ->updateFaqEntity($trans);
    }

    public function deleteFaqEntity(FaqTransfer $trans): void {

        $this->getFactory()
            ->createFaqDeleter()
            ->deleteFaqEntity($trans);
    }

    public function findFaqEntityById(int $id): ?FaqTransfer {

        return $this->getFactory()
            ->createFaqReader()
            ->findFaqEntityById($id);
    }

    public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer {

        return $this->getFactory()
            ->createFaqReader()
            ->getFaqCollection($trans);
    }

    public function getFaqEntity(FaqTransfer $trans): ?FaqTransfer {

        $res = $this->findFaqEntityById($trans->getIdFaq());

        if($res === null) {
            return null;
        }

        return $trans->fromArray($res->toArray());
    }

    public function addFaqVote(FaqVoteTransfer $trans): FaqVoteTransfer {

        return $this->getFactory()
            ->createVoteAdder()
            ->addVote($trans);
    }

    public function revokeFaqVote(FaqVoteTransfer $trans): void {
        $this->getFactory()
            ->createVoteDeleter()
            ->deleteVote($trans);
    }

    public function findFaqVote(FaqVoteRequestTransfer $trans): bool {
        return $this->getFactory()
            ->createVoteFinder()
            ->findVote($trans);
    }

    public function getFaqVoteCollection(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer {

        return $this->getFactory()
            ->createVoteFinder()
            ->getFaqVoteCollection($trans);
    }

    public function getFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer {

        return $this->getFactory()
            ->createVoteFinder()
            ->getFaqVoteById($trans);
    }

    public function setFaqVote(FaqVoteTransfer $trans): FaqVoteTransfer {

        return $this->getFactory()
            ->createVoteAdder()
            ->setFaqVote($trans);
    }
}
