<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Transformers\UserTransformer;

class UserController extends ApiController
{
	 public function __construct()
    {
        $this->userTransformer = New UserTransformer();
    }
    public function list()
    {
    	try
    	{
            $users = $this->getDoctrine()->getRepository(User::class)->findall();
            $data = $this->userTransformer->transformCollection($users);
        } catch (Exception $e)
        {
            $data = NULL;
        }
        if (!$data) {
          $data = ['message' => 'No Users exists'];
        }
        return $this->respond($data);
    }

    public function index(User $user)
    {
    	if(!$user) {
    		throw New NotFoundHttpException("User Not found.");
		} else {
    		return $this->respond($this->userTransformer->transform($user));
		}
    }

    public function create(Request $request)
    {
        $user = new User();
        if($request->isMethod('POST')){
            $data = $this->processForm($request, UserType::class, $user, 'POST');
            return $this->respond($this->userTransformer->transform($data));
        }
    }
}
