<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqDataTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\PyzFaqEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method FaqPersistenceFactory getFactory()
 */
class FaqRepository extends AbstractRepository implements FaqRepositoryInterface {

    public function findFaqEntityById(int $id): ?FaqTransfer {

        $data = $this->getFactory()
            ->createFaqQuery()
            ->filterByIdFaq($id)
            ->findOne();

       if($data === null) {
           return null;
       }

       return (new FaqTransfer())->fromArray(
           $data->toArray(),
           true,
       );
    }

    public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer {

        $data = $this->getFactory()
            ->createFaqQuery()
            ->filterByEnabled(true)
            ->find();

        foreach ($data->getData() as $faq) {
            $faq = (new FaqTransfer())
                ->fromArray($faq->toArray());

            $trans->addFaq($faq);
        }

        return $trans;
    }

    public function getFaqCollectionPaginated(FaqDataCollectionTransfer $trans): FaqDataCollectionTransfer {

        $userLogged = $trans->getFaqCustomer() !== null;


        $data = $this->getFactory()
            ->createFaqQuery()
            ->filterByEnabled(true)
            ->leftJoinPyzFaqVote()
            ->paginate(
                $trans->getPagination()->getPage(),
                $trans->getPagination()->getLimit())
            ->getResults();

        foreach ($data as $faq) {
            /** @var $faq PyzFaqEntityTransfer */
            $nFaq = (new FaqDataTransfer())
                ->fromArray($faq->toArray(), true);

            $nFaq->setVoteCount(count($faq->getPyzFaqVotes()));

            if($userLogged) {
                $uid = $trans->getFaqCustomer()->getCustomerId();

                foreach ($faq->getPyzFaqVotes() as $vote) {
                    if($vote->getIdCustomer() === $uid) {
                        $nFaq->setUserVoted(true);
                        break;
                    }
                }
            }

            $trans->addFaqData($nFaq);
        }

        return $trans;
    }
}
