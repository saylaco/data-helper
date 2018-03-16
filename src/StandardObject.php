<?php

namespace Sayla\Helper\Data;

class StandardObject extends \stdClass implements \ArrayAccess
{
	/**
	 * @param iterable $data
	 * @return static
	 */
	public static function make($data)
	{
		$obj = new static();
		if (isset($data)) {
			foreach ($data as $k => $v) {
				$obj->$k = $v;
			}
		}
		return $obj;
	}

	/**
	 * Whether a offset exists
	 */
	public function offsetExists($offset)
	{
		return isset($this->{$offset});
	}

	/**
	 * Offset to retrieve
	 */
	public function offsetGet($offset)
	{
		return $this->{$offset};
	}

	/**
	 * Offset to set
	 */
	public function offsetSet($offset, $value)
	{
		$this->{$offset} = $value;
	}

	/**
	 * Offset to unset
	 */
	public function offsetUnset($offset)
	{
		unset($this->{$offset});
	}
}