<?php

namespace Aika\Utils\Collections;

use ArrayAccess;
use Iterator;

class Collection implements ArrayAccess, Iterator
{
    protected $items = [];
    protected $position = 0;
    protected $keys = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
        $this->keys = array_keys($items);
        $this->position = 0;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
        $this->keys = array_keys($this->items);
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
        $this->keys = array_keys($this->items);
    }

    public function current()
    {
        return $this->items[$this->keys[$this->position]];
    }

    public function key()
    {
        return $this->keys[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->keys[$this->position]);
    }

    public function get(string $key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function search($search, ?callable $searchFunction = null): array
    {
        $result = [];

        foreach ($this->items as $key => $data) {

            if ($searchFunction && $searchFunction($key, $data, $search)) {

                $result[$key] = $data;
                continue;
            }
            
            if (is_string($key)) {
                
                if (is_string($search) && strcasecmp($key, trim($search)) == 0) {
                    
                    $result[$key] = $data;
                    continue;

                }
            }

            if (is_string($data) && strcasecmp($data, trim($search)) == 0) {

                $result[$key] = $data;
                continue;

            }
            
        }

        return $result;
    }
}