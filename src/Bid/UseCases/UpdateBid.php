<?php

namespace FreightQuote\Bid\UseCases;

use FreightQuote\Bid\BidRepository;

class UpdateBid
{
    public function __construct(
        private BidRepository $bidRepo,
    ) {}

    public function execute(UpdateBidRequest $dto): void
    {
        $bid = $this->bidRepo->find($dto->bidId);
        $bid->setCost($dto->data['cost']);
        $bid->setIsClosed($dto->data['isClosed']);
        $bid->setNotes($dto->data['notes']);
        $bid->setFileAttachments($dto->data['fileAttachments']);
        $this->bidRepo->save($bid);
    }
}
