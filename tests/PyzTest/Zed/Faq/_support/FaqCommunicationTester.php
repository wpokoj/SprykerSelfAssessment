<?php
namespace PyzTest\Zed\Faq;

use Pyz\Zed\Faq\Communication\Validator\PaginationTransferValidator\PaginationTransferValidator;
use Pyz\Zed\Faq\Communication\Validator\PaginationTransferValidator\PaginationTransferValidatorInterface;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class FaqCommunicationTester extends \Codeception\Actor
{
    use _generated\FaqCommunicationTesterActions;

    /**
     * Define custom actions here
     */

    public function getPaginationTransferValidator(): PaginationTransferValidatorInterface {
        return new PaginationTransferValidator();
    }
}
