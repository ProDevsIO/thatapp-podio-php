<?php

class PodioItemCollection extends PodioCollection
{
    public $filtered;
    public $total;

    /**
     * @param $items An array of PodioItem objects
     * @param $filtered Count of items in current selected
     * @param $total Total number of items if no filters were to apply
     */
    public function __construct(PodioClient $podio_client, $items = array(), $filtered = null, $total = null)
    {
        $this->filtered = $filtered;
        $this->total = $total;

        parent::__construct($podio_client, $items);
    }

    // Array access
    public function offsetSet($offset, $value): void
    {
        if (!is_a($value, 'PodioItem')) {
            throw new PodioDataIntegrityError("Objects in PodioItemCollection must be of class PodioItem");
        }
        parent::offsetSet($offset, $value);
    }
}
