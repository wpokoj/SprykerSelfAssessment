<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqDataTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\PyzFaqEntityTransfer;
use Orm\Zed\Planet\Persistence\PyzFaqVote;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method FaqPersistenceFactory getFactory()
 */
class FaqRepository extends AbstractRepository implements FaqRepositoryInterface {

    public function findFaqEntityById(int $id): ?FaqTransfer {

        $data = $this->getFactory()
            ->createFaqQuery()
            ->filterByIdFaq($id)
            ->filterByEnabled(true)
            ->leftJoinWithPyzFaqVote()
            ->find();

       if(count($data->getData()) === 0) {
           return null;
       }

       $res = (new FaqTransfer())->fromArray(
           ($entry = ($data->getData())[0])->toArray(),
           true,
       );

       /** @var PyzFaqEntityTransfer $entry */
       $res->setVoteCount(count($entry->getPyzFaqVotes()));

       return $res;
    }

    public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer {

        $uid = $trans->getIdCustomer();

        $voteQuery = $this->getFactory()->createVoteQuery();

        $query = $this->getFactory()
            ->createFaqQuery()
            ->filterByEnabled(true);

        if(($page = $trans->getPagination()) !== null) {

            $data = $query->paginate($page->getPage(), $page->getLimit())->getResults();
        }
        else {

            $data = $query->find();
        }

        foreach ($data->getData() as $faq) {
            /** @var PyzFaqEntityTransfer $faq */
            $nFaq = (new FaqTransfer())
                ->fromArray($faq->toArray());

            $voteQuery->clear();

            $nFaq->setVoteCount(count(
                $votes = $voteQuery->filterByIdFaq($nFaq->getIdFaq())->find()->getData()
            ));

            if($uid !== null) {
                $found = false;

                foreach($votes as $vote) {
                    /** @var PyzFaqVote $vote */
                    if($vote->getIdCustomer() === $uid) {
                        $found = true;
                        break;
                    }
                }

                $nFaq->setUserVoted($found);
            }

            $trans->addFaq($nFaq);
        }


        return $trans;
    }


    public function getFaqVoteCollection(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer {

        $uid = $trans->getCustomerId();

        $data = $this->getFactory()
            ->createVoteQuery()
            ->filterByIdCustomer($uid)
            ->find();

        foreach ($data->getData() as $vote) {
            /** @var PyzFaqVote $vote */

            $trans->addFaq(
                (new FaqVoteTransfer())->fromArray(
                    $vote->toArray(),
                    true
                )
                ->setVoted(true)
            );
        }

        return $trans;
    }


    public function findFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer {
        $res = $this->getFactory()
            ->createVoteQuery()
            ->filterByIdCustomer($trans->getIdCustomer())
            ->filterByIdFaq($trans->getIdFaq())
            ->find();

        $trans->setVoted(count($res->getData()) > 0);
        return $trans;
    }
}
