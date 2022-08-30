<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Pyz\Zed\Faq\Business\FaqFacade;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method FaqFacade getFacade()
 */
class GatewayController extends AbstractGatewayController {

    public function sendVoteAction(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer {

        if($trans->getValue()) {
            if(!$this->getFacade()->findFaqVote($trans)) {
                return $this->getFacade()
                    ->addFaqVote($trans);
            }
        }
        else {
            $this->getFacade()
                ->revokeFaqVote($trans);
        }

        return $trans;
    }


    public function getFaqCollectionAction(FaqCollectionTransfer $trans): FaqCollectionTransfer {

        return $this->getFacade()
            ->getFaqCollection($trans);
    }

    public function getFaqEntityAction(FaqTransfer $trans): ?FaqTransfer {

        return $this->getFacade()
            ->getFaqEntity($trans);
    }

    public function updateFaqEntityAction(FaqTransfer  $trans): FaqTransfer {

        return $this->getFacade()
            ->updateFaqEntity($trans);
    }


    public function deleteFaqEntityAction(FaqTransfer  $trans): FaqTransfer {

        $this->getFacade()
            ->deleteFaqEntity($trans);

        return $trans;
    }


    public function createFaqEntityAction(FaqTransfer  $trans): FaqTransfer {

        return $this->getFacade()
            ->createFaqEntity($trans);
    }

    public function getFaqVoteCollectionAction(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer {
        return $this->getFacade()
            ->getFaqVoteCollection($trans);
    }

    public function getFaqVoteByIdAction(FaqVoteTransfer $trans): FaqVoteTransfer {
        return $this->getFacade()
            ->getFaqVoteById($trans);
    }

    public function setFaqVoteAction(FaqVoteTransfer $trans): FaqVoteTransfer {

        if($trans->getVoted()) {
            $res = $this->getFacade()->getFaqVoteById($trans);

            if (!$res->getVoted()) {
                $this->getFacade()->addFaqVote(
                    (new FaqVoteRequestTransfer())
                        ->setIdFaq($trans->getIdFaq())
                        ->setFaqCustomer((new FaqCustomerTransfer())
                            ->setCustomerId($trans->getIdCustomer()))
                );
            }

            $trans->setVoted(true);
        }
        else {
            $this->getFacade()->revokeFaqVote(
                (new FaqVoteRequestTransfer())
                    ->setIdFaq($trans->getIdFaq())
                    ->setFaqCustomer((new FaqCustomerTransfer())
                        ->setCustomerId($trans->getIdCustomer()))

            );

            $trans->setVoted(false);
        }

        return $trans;
    }
}
