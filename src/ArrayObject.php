<?php

namespace Sayla\Helper\Data;

use ArrayAccess;
use IteratorAggregate;

class ArrayObject implements ArrayAccess, IteratorAggregate, \JsonSerializable, \Countable
{
	protected $allowUndefinedKeys = true;
	private $data = [];

	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	public function count()
	{
		return count($this->data);
	}

	/**
	 * @return array
	 */
	public function getArrayCopy()
	{
		return $this->data;
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->data);
	}

	public function jsonSerialize()
	{
		return $this->toArray();
	}

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->data;
	}

	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->data);
	}

	public function offsetGet($offset)
	{
		if (!$this->allowUndefinedKeys && !$this->offsetExists($offset)) {
			throw new \UnexpectedValueException($offset . ' is not defined');
		}
		return $this->data[$offset];
	}

	public function offsetSet($offset, $value)
	{
		if (null === $offset) {
			$this->data[] = $value;
		} else {
			$this->data[$offset] = $value;
		}
	}

	public function offsetUnset($offset)
	{
		unset($this->data[$offset]);
	}

	/**
	 * Convert the object to its JSON representation.
	 *
	 * @param  int $options
	 * @return string
	 */
	public function toJson($options = 0)
	{
		return json_encode($this->data, $options);
	}

	protected function &getArrayData()
	{
		return $this->data;
	}

	protected function setArrayData(array $data)
	{
		$this->data = $data;
	}
}
