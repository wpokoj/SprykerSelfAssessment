<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqDataTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
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

        $voteQuery = $this->getFactory()->createVoteQuery();

        // default results with pagination
        $data = $this->getFactory()
            ->createFaqQuery()
            ->filterByEnabled(true)
            ->paginate(
                $trans->getPagination()->getPage(),
                $trans->getPagination()->getLimit())
            ->getResults();

        foreach ($data as $faq) {
            // data repacking

            /** @var $faq PyzFaqEntityTransfer */
            $nFaq = (new FaqDataTransfer())
                ->fromArray($faq->toArray(), true);

            // count votes
            // due to pagination we can't left-join query :(
            $voteQuery->clear();

            $nFaq->setVoteCount(count(
                $votes = $voteQuery->filterByIdFaq($faq->getIdFaq())
                    ->find()->getData()
            ));

            // check whether logged-in user has voted for given entry
            if($userLogged) {
                $uid = $trans->getFaqCustomer()->getCustomerId();

                foreach ($votes as $vote) {
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

    public function findFaqVote(FaqVoteRequestTransfer $trans): bool {

        $res = $this->getFactory()
            ->createVoteQuery()
            ->filterByIdFaq($trans->getIdFaq())
            ->filterByIdCustomer($trans->getFaqCustomer()->getCustomerId())
            ->find();

        return count($res->getData()) > 0;
    }
}
