<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\ApiController;
use App\Entity\Apartment;
use App\Form\ApartmentType;

class ApartmentController extends ApiController
{
    public function list()
    {
    	try {
            $data = $this->getDoctrine()->getRepository(Apartment::class)->findall();
        } catch (Exception $e) {
            $data = NULL;
        }
        if (!$data) {
          $data = ['message' => 'No List of Apartments Available'];
        }
        return $this->respond($data);
    }

    public function index(Request $request, int $id = NULL)
    {
        $apartment = $this->getDoctrine()->getRepository(Apartment::class)->find($id);

    	if($request->isMethod('PUT'))
    	{
            $record = $this->processForm($request, ApartmentType::class, $apartment, 'PUT');
            return $this->respond($apartment);
    	} else {
    		if (!$apartment) {
    			throw New NotFoundHttpException("Apartment Not found.");
    		} else {
        		return $this->respond($apartment);
    		}
    	}
    }

    public function create(Request $request)
    {
        $apartment = new Apartment();
        if($request->isMethod('POST')){
            $data = $this->processForm($request, ApartmentType::class, $apartment, 'POST');
            return $this->respond($data);
        }
    }
}
