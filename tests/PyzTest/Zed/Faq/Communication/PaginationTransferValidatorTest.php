<?php

namespace PyzTest\Zed\Faq\Communication;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\FaqBuilder;
use Generated\Shared\DataBuilder\PaginationBuilder;
use Generated\Shared\Transfer\FaqErrorTransfer;
use Generated\Shared\Transfer\FaqTransfer;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group StringReverser
 * @group Business
 * @group Facade
 * @group StringReverserFacadeTest
 * Add your own group annotations below this line
 */
class PaginationTransferValidatorTest extends Unit
{
    /**
     * @var \PyzTest\Zed\Faq\FaqCommunicationTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testSkipsNull(): void
    {
        $trans = null;

        $res = $this->tester->getPaginationTransferValidator()->validate($trans);

        $this->assertNull($res);
    }

    public function testInvalidatesNullParameters(): void {
        $trans = (new PaginationBuilder([
            'page' => null,
            'limit' => null,
        ]))->build();

        $res = $this->tester->getPaginationTransferValidator()->validate($trans);

        $this->assertInstanceOf(FaqErrorTransfer::class ,$res);
    }

    public function testInvalidatesNonPositiveIntegers(): void {
        $trans = (new PaginationBuilder([
            'page' => -1,
            'limit' => 0,
        ]))->build();

        $res = $this->tester->getPaginationTransferValidator()->validate($trans);

        $this->assertInstanceOf(FaqErrorTransfer::class ,$res);
    }

    public function testValidatesCorrectParameters(): void {
        $trans = (new PaginationBuilder([
            'page' => 10,
            'limit' => 5,
        ]))->build();

        $res = $this->tester->getPaginationTransferValidator()->validate($trans);

        $this->assertNull($res);
    }

}
