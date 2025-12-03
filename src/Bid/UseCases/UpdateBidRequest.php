<?php

namespace FreightQuote\Bid\UseCases;

class UpdateBidRequest
{
    /**
     * @param string[] $fileAttachments
     */
    public function __construct(
        public int $bidId,
        public int $cost,
        public bool $isClosed,
        public string $notes,
        public array $fileAttachments,
    ) {}
}
