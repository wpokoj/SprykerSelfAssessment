<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Pyz\Client\Faq\FaqClientInterface;
use Pyz\Yves\Faq\FaqFactory;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Kernel\View\View;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqClientInterface getClient()
 * @method FaqFactory getFactory()
 */
class IndexController extends AbstractController {

    public function indexAction(Request $req): View {

        $customerValidator = $this->getFactory()->createCustomerValidator();

        var_dump($customerValidator->isCustomerLogged());
        var_dump($customerValidator->getLoggedCustomerId());

        $limit = intval($req->query->get('items-per-page') ?? 10);
        $page  = intval($req->query->get('page') ?? 1);

        $questions = [];

        $req = (new FaqCollectionTransfer())
            ->setPagination((new PaginationTransfer())
                ->setLimit($limit)
                ->setPage($page));

        if($customerValidator->isCustomerLogged()) {
            $req->setIdCustomer($customerValidator->getLoggedCustomerId());
        }

        $data = $this->getClient()->getAllFaqs($req);

        foreach($data->getFaqs() as $faq) {
            $questions[] = $faq->toArray();
        }


        return $this->view(
            [
                'logged' => $customerValidator->isCustomerLogged(),
                'questions' => $questions,
                'itemsPerPage' => $limit,
                'page' => $page,
                'nextPage' => $page + 1,
                'prevPage' => $page > 1 ? $page - 1 : 1,
            ],
            [],
            '@Faq/views/index/index.twig'
        );
    }
}
