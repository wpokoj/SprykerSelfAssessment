<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Client\Faq\FaqClientInterface;
use Pyz\Yves\Faq\FaqFactory;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqFactory getFactory()
 * @method FaqClientInterface getClient()
 */
class VoteController extends AbstractController {

    private function sendVote(Request $req, bool $val): \Symfony\Component\HttpFoundation\RedirectResponse {
        $validator = $this->getFactory()->createCustomerValidator();

        if(!$validator->isCustomerLogged()) {
            $this->addErrorMessage('You must be logged in to perform this action');
            return $this->redirectResponseInternal('/faq');
        }

        $faqId = $req->request->get('id-faq');

        if($faqId === null) {
            $this->addErrorMessage('Missing id');
            return $this->redirectResponseInternal('/faq');
        }

        $faqId = intval($faqId);

        $data = (new FaqVoteTransfer())
            ->setIdCustomer($validator->getLoggedCustomerId())
            ->setIdFaq($faqId)
            ->setVoted($val);

        $this->getClient()->sendVoteRequest($data);

        $this->addSuccessMessage('Vote updated successfully');
        return $this->redirectResponseInternal('/faq');
    }

    public function revokeAction(Request $req): \Symfony\Component\HttpFoundation\RedirectResponse {
        return $this->sendVote($req, false);
    }

    public function voteAction(Request $req): \Symfony\Component\HttpFoundation\RedirectResponse {
        return $this->sendVote($req, true);
    }
}
