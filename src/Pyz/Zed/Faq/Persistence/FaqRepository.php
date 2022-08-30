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

        $data = $this->getFactory()
            ->createFaqQuery()
            ->filterByEnabled(true)
            ->leftJoinWithPyzFaqVote()
            ->find();


        foreach ($data->getData() as $faq) {
            /** @var PyzFaqEntityTransfer $faq */
            $nFaq = (new FaqTransfer())
                ->fromArray($faq->toArray());

            $nFaq->setVoteCount(
                count($faq->getPyzFaqVotes())
            );

            $trans->addFaq($nFaq);
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


    public function getFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer {
        $res = $this->getFactory()
            ->createVoteQuery()
            ->filterByIdCustomer($trans->getIdCustomer())
            ->filterByIdFaq($trans->getIdFaq())
            ->find();

        $trans->setVoted(count($res->getData()) > 0);
        return $trans;
    }
}
