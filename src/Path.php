<?php

namespace Sayla\Helper\Data;

class Path
{
	/** @var string */
	public $directory;
	/** @var string */
	public $basename;
	/** @var string */
	public $extension;
	/** @var string */
	public $filename;

	public function __construct($path)
	{
		foreach (pathinfo($path) as $k => $v) {
			if ($k == 'dirname') {
				$this->directory = $v;
			} else {
				$this->{$k} = $v;
			}
		}
	}

	public function __toString()
	{
		return $this->render();
	}

	/**
	 * @return string
	 */
	public function render()
	{
		return $this->directory . DIRECTORY_SEPARATOR . $this->filename . ($this->extension ? '.' . $this->extension : '');
	}

	public function copy()
	{
		return clone $this;
	}

	public function getFilenameAfter(string $needle)
	{
		return substr($this->filename, strrpos($this->filename, $needle) + 1);
	}

	public function getFilenameBefore(string $needle)
	{
		$pos = strpos($this->filename, $needle);
		if ($pos === false) {
			return null;
		}
		return substr($this->filename, 0, $pos);
	}

	public function getFolder(): string
	{
		return basename($this->directory) ?? '';
	}

	/**
	 * @param string $basename
	 * @return Path
	 */
	public function setBasename(string $basename): Path
	{
		$this->basename = $basename;
		return $this;
	}

	/**
	 * @param string $directory
	 * @return Path
	 */
	public function setDirectory(string $directory): Path
	{
		$this->directory = $directory;
		return $this;
	}

	/**
	 * @param string $extension
	 * @return Path
	 */
	public function setExtension(string $extension): Path
	{
		$this->extension = $extension;
		return $this;
	}

	/**
	 * @param string $filename
	 * @return Path
	 */
	public function setFilename(string $filename): Path
	{
		$this->filename = $filename;
		return $this;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}

	/**
	 * @return string
	 */
	public function withoutExtension()
	{
		return $this->directory . DIRECTORY_SEPARATOR . $this->filename;
	}
}

