<?php

namespace Sayla\Helper\Data;

class FreezableObject extends StandardObject
{
	private $frozen = false;

	public function freeze()
	{
		$this->frozen = true;
		return $this;
	}

	public function offsetSet($offset, $value)
	{
		if ($this->frozen) {
			throw new \BadMethodCallException('Object is frozen');
		}
		parent::offsetSet($offset, $value);
	}

	public function offsetUnset($offset)
	{
		if ($this->frozen) {
			throw new \BadMethodCallException('Object is frozen');
		}
		parent::offsetUnset($offset);
	}
}