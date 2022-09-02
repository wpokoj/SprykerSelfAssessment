<?php

namespace PyzTest\Zed\Faq\Communication;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\FaqErrorTransfer;
use Pyz\Zed\Faq\Communication\Validator\IdCustomerValidator\IdCustomerValidator;

class IdCustomerValidatorTest extends Unit {

    public function testValidIdPass() {

        $ids = [1, 5, 327, 7, 172368];

        $res = [];
        $validator = new IdCustomerValidator();

        foreach ($ids as $id) {
            $res[] = $validator->validateIdCustomer($id);
        }

        foreach ($res as $t) {
            $this->assertNull($t);
        }
    }

    public function testInvalidIdFail() {

        $ids = [-1, -5, -327, -7, -172368, 0];

        $res = [];
        $validator = new IdCustomerValidator();

        foreach ($ids as $id) {
            $res[] = $validator->validateIdCustomer($id);
        }

        foreach ($res as $t) {
            $this->assertInstanceOf(FaqErrorTransfer::class, $t);
        }
    }
}
