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
            switch ($k) {
                case'dirname':
                    $this->directory = $v;
                    break;
                case 'basename':
                    continue 2;
                default:
                    $this->{$k} = $v;
                    break;
            }
        }
    }

    public function __toString()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->directory . DIRECTORY_SEPARATOR . $this->filename . ($this->extension ? '.' . $this->extension : '');
    }

    public function append(string $string)
    {
        return new self($this->value() . DIRECTORY_SEPARATOR . $string);
    }

    public function copy()
    {
        return clone $this;
    }

    /**
     * @return string
     */
    public function getBasename(): string
    {
        return pathinfo($this->value(), PATHINFO_BASENAME);
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
     * @return string
     */
    public function getValueWithoutExtension()
    {
        return $this->directory . DIRECTORY_SEPARATOR . $this->filename;
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
}

