<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\InvalidFormException;
use App\Entity\Apartment;
use App\Form\ApartmentType;

class ApiController extends Controller
{
	/**
	 * Response method to alaways be in json
	 * @return response data
	 */
    public function respond($data)
    {
        return $this->json($data);
    }

    /**
     * [processForm description]
     * @param  Apartment $apartment
     * @param  array     $parameters
     * @param  string    $method
     * @return [inserted apartment object]
     */
    protected function processForm(Request $request, $objectType, object $object, $method = 'PUT')
    {
		$form = $this->createForm($objectType, $object);
		$form->submit($request->request->all());

		if ($form->isSubmitted() && $form->isValid()) {
		  $data = $form->getData();
		  $em = $this->getDoctrine()->getManager();
		  $em->persist($data);
		  $em->flush();

		  return $data;
		}
		throw new InvalidFormException($form, 'Invalid submitted data');
	}

}
