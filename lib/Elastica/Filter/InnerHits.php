<?php
namespace Elastica\Filter;

use Elastica\Exception\InvalidException;
use Elastica\ArrayableInterface;

/**
 * inner_hits params
 *
 * Class InnerHits
 * @package Elastica\Filter
 */
class InnerHits implements ArrayableInterface
{
    private $size;
    private $from;
    private $name;
    private $sort;

    public function toArray() {
        $data = array();

        if (!empty($this->size))
            $data['size'] = $this->size;

        if (!empty($this->from))
            $data['from'] = $this->from;

        if (!empty($this->name))
            $data['name'] = $this->name;

        if (!empty($this->sort))
            $data['sort'] = $this->sort;

        //empty array "[]" is incorrect for "inner_hits", that's why "new \stdClass()", for "{}"
        return !empty($data) ? $data : new \stdClass();
    }

    public function setSize($size) {
        $size = intval($size);

        if (empty($size) || $size < 0) {
            throw new InvalidException('Invalid parameter. Has to be a positive integer');
        }

        $this->size = (integer) $size;
    }

    public function setFrom($from) {
        $from = intval($from);

        if (empty($from) || $from < 0) {
            throw new InvalidException('Invalid parameter. Has to be a positive integer');
        }

        $this->from = (integer) $from;
    }

    public function setSort($sort) {
        $sort = (array) $sort;

        if (empty($sort)) {
            throw new InvalidException('Invalid parameter. Has to be a non empty array');
        }

        $this->sort = (array) $sort;
    }

    public function setName($name) {
        $name = (string) $name;

        if (empty($name)) {
            throw new InvalidException('Invalid parameter. Has to be a non empty string');
        }

        $this->name = (string) $name;
    }
}
