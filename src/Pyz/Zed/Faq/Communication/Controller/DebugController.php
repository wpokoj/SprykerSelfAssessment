<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Pyz\Zed\Faq\Persistence\FaqEntityManager;
use Spryker\Zed\AuthRestApi\Business\AuthRestApiFacade;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method FaqCommunicationFactory getFactory()
 */
class DebugController extends AbstractController {

    public function indexAction() {
        for($i = 0; $i <= 30; $i++) {
            var_dump((new AuthRestApiFacade())
                ->createAccessToken(
                    (new OauthRequestTransfer())
                        ->setGrantType(null)
                        ->setClientId($i)
                        ->setPassword('change123')
                )->getError()->getMessage());
            echo '<br><br>';
        }
        die();
    }

    public function  tableAction(): JsonResponse {


    }
}
