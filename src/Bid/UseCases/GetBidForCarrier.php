<?php

namespace FreightQuote\Bid\UseCases;

use FreightQuote\Bid\Bid;
use FreightQuote\Bid\BidRepository;
use InvalidArgumentException;

class GetBidForCarrier
{
    public function __construct(
        private BidRepository $bidRepo,
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function execute(GetBidForCarrierRequest $dto): Bid
    {
        $bid = $this->bidRepo->find($dto->id);
        if ($bid === null) {
            throw new InvalidArgumentException('Bid not found!');
        }
        return $bid;
    }
}
