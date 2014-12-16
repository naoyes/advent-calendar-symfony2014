<?php

namespace MyApp\VichUploaderDemoBundle\Controller;

use MyApp\VichUploaderDemoBundle\Entity\Product;
use MyApp\VichUploaderDemoBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 *
 * @Route("/products")
 * @package MyApp\VichUploaderDemoBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * @Route(
     *      "/new",
     *      name="product_form"
     * )
     * @Method({"GET"})
     * @Template()
     * @return array
     */
    public function newAction()
    {
        $form = $this->createForm(new ProductType(), null, ['method' => 'POST']);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route(
     *      "",
     *      name="product_create"
     * )
     * @Method({"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(new ProductType(), $product);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect($this->generateUrl('product_list'));
        }

        return $this->redirect($this->generateUrl('product_form'));
    }

    /**
     * @Route(
     *      "",
     *      name="product_list"
     * )
     * @Method({"GET"})
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $products = $this->getDoctrine()->getManager()->getRepository('MyAppVichUploaderDemoBundle:Product')->findAll();

        return [
            'products' => $products,
        ];
    }

    /**
     * @Route(
     *      "/{id}",
     *      requirements = {"id" = "\d+"},
     *      name="product_delete"
     * )
     * @Method({"DELETE"})
     * @ParamConverter("product", class="MyAppVichUploaderDemoBundle:Product")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('product_list'));
    }
}
