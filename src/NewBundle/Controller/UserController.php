<?php
namespace NewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends Controller
{
	var $api_key = 1234;
	
    public function getInfoAction(Request $req){
    	$api = $req->get('api');
    	$type=$req->get('type');
    	$id = $req->get('id');
    	$em=$this->getDoctrine()->getManager();
		$type = $req->get('type');
		$allbooks = $em->createQuery("
			SELECT B.id,B.name,B.cat,B.author, B.sSN
			FROM AppBundle:Book B 
			WHERE B.id =:id
		")->setParameter("id",$id)
		->getResult();
		if(sizeof($allbooks) > 0){	
			return new JsonResponse($allbooks);
		}	
		return new JsonResponse();
    }
    public function postAddentrysAction(Request $req){
    	$em=$this->getDoctrine()->getManager();
    	if($req->get('api') == $this->api_key){
    		$insertObj = new \AppBundle\Entity\Book();
    		$name=$req->get('name');
    		$cat=$req->get('cat');
    		$author=$req->get('author');  
    		$ssn = $req->get('sSN');
    		$insertObj->setName($name);
    		$insertObj->setCat($cat);
    		$insertObj->setAuthor($author);
    		$insertObj->setsSN($ssn);
    		$em->persist($insertObj);
    		$em->flush();
	    	return new JsonResponse($insertObj);	
    	    	}
    		return new JsonResponse();
    }
    public function postUpdatesAction(Request $req){
	    
    	$em=$this->getDoctrine()->getManager();
    	if($req->get('api') == $this->api_key){
	    		$id= $req->get('id');
	    		$bookid=$em->getRepository("AppBundle:Book")->findOneBy(
	    			array('id'=>$id)
	    		);
	    		if($bookid){
	    			$sSN=$req->get('sSN');
	    			$bookid->setsSN($sSN);
	    			$name=$req->get('name');
    			$cat=$req->get('cat');
    		$author=$req->get('author');  
    		$ssn = $req->get('sSN');
    		$bookid->setName($name);
    		$bookid->setCat($cat);
    		$bookid->setAuthor($author);
    		$bookid->setsSN($ssn);
	    			$em->flush();
	    			return new JsonResponse($bookid);
	    		}
	    		return new JsonResponse();
	    			}
    }
    public function postDeletesAction(Request $req){
	    
    	$em=$this->getDoctrine()->getManager();
    	if($req->get('api') == $this->api_key){	
	    		$id=$req->get('id');
	    		$bookid=$em->getRepository("AppBundle:Book")->findOneBy(array('id'=>$id));
	    		if($bookid)
	    		{
	    			$em->remove($bookid);
	    		}
	    		$em->flush();
	    		return new JsonResponse();
	    	}
    	return new JsonResponse();
    }
    
 }
