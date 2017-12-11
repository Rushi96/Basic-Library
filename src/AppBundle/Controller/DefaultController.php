<?php

namespace AppBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use AppBundle\Entity\Book;

    class DefaultController extends Controller
    {
        public function indexAction(Request $request)
        {
           
             $em = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()
                    ->getRepository('AppBundle:Book');
                $allbooks = $repository->findAll();
            return $this->render('AppBundle:Default:index.html.twig',  array('db' => $allbooks)); 
        }

        public function addAction(Request $request)
        {
            // echo $bookId;
            $em = $this->getDoctrine()->getManager();
            $bname = $request->get('bname');
            $aname = $request->get('aname');
            $cat = $request->get('cat');
            $ssn = $request->get('ssn');
            $book = new Book();
            $book->setName($bname);
            $book->setCat($cat);
            $book->setAuthor($aname);
            $book->setSSN($ssn);
            $em->persist($book);
            $em->flush();
            $repository = $this->getDoctrine()
                    ->getRepository('AppBundle:Book');
            $allbooks = $repository->findAll();

            //$response = $this->forward('AppBundle:Default:index');
             return $this->redirect($this->generateUrl("index"));
       
                //return $this->render(
                //    'AppBundle:Default:index.html.twig',
                  //  array('db' => $allbooks)
                //);

        }


         public function editAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $bookId = $request->get('bid');   
            $book = $em->getRepository('AppBundle:Book')->find($bookId);
            $repository = $this->getDoctrine()
                    ->getRepository('AppBundle:Book');
                $allbooks = $repository->findAll();

            if (!$book) {
                throw $this->createNotFoundException(
                    'No book founjnknknnd for id '.$bookId
                 );
            }
            return $this->render(
                    'AppBundle:Default:edit.html.twig',
                    array('c' => $book, 'db' => $allbooks));
        }

        public function updateAction(Request $request)
        {
        $em = $this->getDoctrine()->getManager();
        $bookId = $request->get('id');
        $book = $em->getRepository('AppBundle:Book')->find($bookId);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book founjnknknnd for id '.$bookId
            );
        }
        $bname = $request->get('bname');
        $aname = $request->get('aname');
        $cat = $request->get('cat');
        $ssn = $request->get('ssn');

            $book->setName($bname);
            $book->setCat($cat);
            $book->setAuthor($aname);
            $book->setSSN($ssn);
            $em->persist($book);    
            $em->flush();
            // $repository = $this->getDoctrine()
              //      ->getRepository('AppBundle:Book');
               // $allbooks = $repository->findAll();

                //return $this->render(
                  //  'AppBundle:Default:index.html.twig',
                   // array('db' => $allbooks)
                //);
             $response = $this->forward('AppBundle:Default:index');
             return $this->redirect($this->generateUrl("index"));

        }

        public function deleteAction(Request $request)
        {
            //echo "kwjenjkn";
          //  echo $request->get('id');
        $em = $this->getDoctrine()->getManager();
         $bookId = $request->get('bid');
        $book = $em->getRepository('AppBundle:Book')->find($bookId);
        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$bookId
            );
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getReference('AppBundle:Book', $bookId);
        $em->remove($user);
        $em->flush();
        // $response = $this->forward('AppBundle:Default:index');
        return $this->redirect($this->generateUrl("index"));
        //    return $response;
                
    }


    }

