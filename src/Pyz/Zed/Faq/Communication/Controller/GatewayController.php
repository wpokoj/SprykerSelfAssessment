<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqErrorTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Pyz\Zed\Faq\Business\FaqFacade;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method FaqFacade getFacade()
 * @method FaqCommunicationFactory getFactory()
 */
class GatewayController extends AbstractGatewayController {

    public function setFaqVoteAction(FaqVoteTransfer $trans): FaqVoteTransfer {

        $setTo = $trans->getVoted();
        $setFrom = $this->getFacade()->getFaqVoteById($trans)->getVoted();

        if($setFrom !== $setTo) {
            if($setTo) { // vote
                return $this->getFacade()->addFaqVote($trans);
            }
            else {
                $this->getFacade()->revokeFaqVote($trans);
            }
        }

        return $trans;
    }


    public function getFaqCollectionAction(FaqCollectionTransfer $trans): FaqCollectionTransfer {

        $res = $this->getFactory()->createPaginationValidator()->validate($trans->getPagination())
            ?? $this->getFactory()->createIdCustomerValidator()->validateIdCustomer($trans->getIdCustomer())
            ?? $this->getFacade()->getFaqCollection($trans);

        if($res instanceof FaqErrorTransfer) {
            return $trans->setFaqError($res);
        }

        return $trans;
    }

    public function getFaqEntityAction(FaqTransfer $trans): ?FaqTransfer {

        if(!($this->getFacade()->findFaqEntityById($trans->getIdFaq()))) {
            return $trans->setFaqError(
                (new FaqErrorTransfer())
                    ->setStatus(404)
                    ->setCode('001')
                    ->setDetail('Resource not found')
            );
        }

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
}
