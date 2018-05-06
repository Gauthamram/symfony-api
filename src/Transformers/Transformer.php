<?php

namespace App\Transformers;

abstract Class Transformer
{

	public function transformCollection(array $items)
	{
		return array_map([$this, 'transform'], $items);
	}

	abstract public function transform($item);
}