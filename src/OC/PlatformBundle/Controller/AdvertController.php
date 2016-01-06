<?php
// src/OC/PlatformBundle/Controller/AdvertController.php
namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends Controller {
	public function indexAction() {
		$content = $this->get ( 'templating' )->render ( 'OCPlatformBundle:Advert:index.html.twig', array (
				'nom' => 'Poupinette',
				'but' => "s'occuper des bébés" 
		) );
		return new Response ( $content );
	}
	
	/**
	 * La route fait appel à OCPlatformBundle:Advert:view,
	 * on doit donc définir la méthode viewAction.
	 * On donne à cette méthode l'argument $id, pour
	 * correspondre au paramètre {id} de la route
	 * 
	 * @param number $id        	
	 * @return Response
	 */
	public function viewAction($id, Request $request) {
		$lResponse = new Response ( $this->render ( 'OCPlatformBundle:Advert:view.html.twig', array (
				'id' => $id 
		) ) );
		// $lResponse->headers->set('Content-Type', 'text/html');
		
		$lSession = $request->getSession ();
		$lSession->set ( 'USER_ID', 54 );
		
		return $lResponse;
	}
	
	// Ajoutez cette méthode :
	public function addAction(Request $request) {
		$session = $request->getSession ();
		// Bien sûr, cette méthode devra réellement ajouter l'annonce
		// Mais faisons comme si c'était le cas
		$session->getFlashBag ()->add ( 'info', 'Annonce bien enregistrée' );
		// Le « flashBag » est ce qui contient les messages flash dans la session
		// Il peut bien sûr contenir plusieurs messages :
		$session->getFlashBag ()->add ( 'info', 'Oui oui, elle est bien enregistrée !' );
		// Puis on redirige vers la page de visualisation de cette annonce
		return $this->redirectToRoute ( 'oc_platform_view', array (
				'id' => 5 
		) );
	}
	
	// On récupère tous les paramètres en arguments de la méthode
	public function viewSlugAction($slug, $year, $_format) {
		/*
		 * return new Response(
		 * "On pourrait afficher l'annonce correspondant au
		 * slug '".$slug."', créée en ".$year." et au format ".$_format."."
		 * );
		 */
		$content = $this->get ( 'templating' )->render ( 'OCPlatformBundle:Advert:view1.html.twig', array (
				'id_advert' => $year 
		) );
		return new Response ( $content );
	}
}
