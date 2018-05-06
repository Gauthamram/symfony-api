<?php
namespace App\Transformers;

Class ApartmentTransformer extends Transformer
{
	public function transform($item)
	{
		return [
            'apartmentId' => $item->getId(),
            'moveInDate' => $item->getMoveInDate(),
            'street' => $item->getStreet(),
            'postCode' => $item->getPostCode(),
            'town' => $item->getTown(),
            'country' => $item->getCountry(),
            'email' => $item->getContactEmail(),
            'owner' => $item->getUser()->getName()
        ];
	}
}