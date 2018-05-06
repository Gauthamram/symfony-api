<?php
namespace App\Transformers;

Class UserTransformer extends Transformer
{
	public function transform($item)
	{
		return [
            'id' => $item->getId(),
            'name' => $item->getName(),
            'email' => $item->getContactEmail(),
            'contact' => $item->getContactNumber()
        ];
	}
}