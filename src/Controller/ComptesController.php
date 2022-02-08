<?php
namespace Tm\Controller;

use Tm\Router;
use Tm\Validator\ComptesValidator;

class ComptesController extends Controller
{
	public function index()
	{
		$data = $this->db()->query("SELECT cp.id,cp.created_at,cp.solde,cl.nom,cl.prenom,cl.telephone FROM comptes as cp INNER JOIN clients as cl ON cl.id = cp.client_id");
		$data = $data->fetchAll();
		return $this->render('comptes/index', compact('data'));
	}

	public function create(int $id)
	{
		$post = ComptesValidator::validate($_POST);
		$errors = ComptesValidator::is_valid();
		$data = $this->db()->query("SELECT * FROM clients WHERE id = $id")->fetch();
		if(!$data){
			return $this->notFoundResponse();
		}
		if(is_bool($errors) && $errors){
			$save = $this->db()->prepare("INSERT INTO comptes SET client_id = :client_id, code = :code, solde = :solde, created_at = :created_at");
			$save->execute([
				'client_id' => $data['id'],
				'code' => password_hash($post['code'], PASSWORD_BCRYPT),
				'solde' => 0.0,
				'created_at' => (new \DateTime())->format('Y-m-d')
			]);
			$this->addFlash('success', "Le compte a bien été rajouter au cient ".$data['nom']." ".$data['prenom']);
			return $this->redirectToRoute('comptes.show', ['id' => $this->db()->lastInsertId()]);
		}
		return $this->render('comptes/create', compact('data', 'post', 'errors'));
	}

	public function clients()
	{
		if(!empty($_POST['telephone'])){
			$telephone = htmlentities($_POST['telephone']);
			try{
				$data = $this->db()->query("SELECT id FROM clients WHERE telephone = $telephone")->fetch();
				if(is_bool($data)){				
					$this->addFlash('error', "Désolé aucun client correspondant à ce numero de telephone.");
					return $this->redirectToRoute('comptes.index');
				}
			}catch(\Error $e){
				$this->addFlash('error', "Désolé aucun client correspondant à ce numero de telephone.");
				return $this->redirectToRoute('comptes.index');
			}
			header("location: ". Router::generate('comptes.create', ['id' => $data['id']]));
			return;
		}
	}

	public function show(int $id)
	{
		try{
			$data = $this->db()->query("SELECT cl.id, cl.nom, cl.prenom, cl.telephone, cl.address, cl.created_at as created_at, cp.id, cp.solde, cp.created_at as createdAt FROM comptes as cp INNER JOIN clients as cl ON cp.client_id = cl.id WHERE cp.id = $id")->fetch();
			if(is_bool($data)){
				$this->addFlash('error', "Désolé ce compte n'existe pas.");
				return $this->redirectToRoute('comptes.index');
			}
			$opperations = $this->db()->query("SELECT * FROM opperations WHERE compte_id = $id")->fetchAll();

		}catch(\Error $e){
			$this->addFlash('error', "Désolé ce compte n'existe pas.");
			return $this->redirectToRoute('comptes.index');
		}
		return $this->render('comptes/show', compact('data', 'id', 'opperations'));
	}

	/**
	 * Fonction qui retire de l'argent sur un compte.
	 */
	public function onttrek(int $id)
	{
		try{
			$data = $this->db()->query("SELECT * FROM comptes as cp INNER JOIN clients as cl ON cp.client_id = cl.id WHERE cp.id = $id")->fetch();
			if(is_bool($data)){
				$this->addFlash('error', "Désolé ceci n'est pas un compte valid.");
				return $this->redirectToRoute('comptes.index');
			}
		}catch(\Error $e){
			$this->addFlash('error', "Désolé ceci n'est pas un compte valid.");
			return $this->redirectToRoute('comptes.index');
		}
		if(isset($_POST) && !empty($_POST['montant'])){
			if(!password_verify($_POST['code'], $data['code'])){
				$this->addFlash('error', "Désolé le retrait est impossible.");
				return $this->redirectToRoute('comptes.index');
			}
			if(!preg_match("/^[0-9.]+$/",$_POST['montant'])){
				$this->addFlash('error', "Désolé ceci n'est pas montant valid.");
				return $this->redirectToRoute('comptes.index');
			}
			if($data['solde'] > $_POST['montant']){
				try{
					$solde = (float) $data['solde'] - (float)$_POST['montant'];
					$this->db()->query("UPDATE comptes SET solde = $solde WHERE id = $id");
					$req = $this->db()->prepare("INSERT INTO opperations (compte_id,montant,type,created_at) VALUES (:compte_id,:montant,:type,:created_at)");
					$req->execute([
						'compte_id' => $id,
						'montant' => (float)$_POST['montant'],
						'type' => 'ret',
						'created_at' => (new \DateTime())->format('Y-m-d h:m:s')
					]);
				}catch(\Error $e){
					$this->addFlash('error', "Désolé il y'a eu une erreur.");
					return $this->redirectToRoute('comptes.index');
				}
				$this->addFlash('success', "Le retrait de ".$_POST['montant']." depuis le compte ".$data['id']." s'est bien passé. Le nouveau solde est de $solde");
				return $this->redirectToRoute('comptes.index');
			}else{
				$this->addFlash('error', "Impossible de retirer un montant supérieur au solde.");
				return $this->redirectToRoute('comptes.index');
			}
		}
		return $this->render('comptes/retire', compact('data'));
	}

	/**
	 * Fonction qui credite de l'argent sur un compte.
	 */
	public function krediet(int $id)
	{
		try{
			$data = $this->db()->query("SELECT * FROM comptes as cp INNER JOIN clients as cl ON cp.client_id = cl.id WHERE cp.id = $id")->fetch();
			if(is_bool($data)){
				$this->addFlash('error', "Désolé ceci n'est pas un compte valid.");
				return $this->redirectToRoute('comptes.index');
			}
		}catch(\Error $e){
			$this->addFlash('error', "Désolé ceci n'est pas un compte valid.");
			return $this->redirectToRoute('comptes.index');
		}
		if(isset($_POST) && !empty($_POST['montant'])){
			if(!preg_match("/^[0-9.]+$/",$_POST['montant'])){
				$this->addFlash('error', "Désolé ceci n'est pas montant valid.");
				return $this->redirectToRoute('comptes.index');
			}
			$solde = (float)$data['solde'] + (float)$_POST['montant'];
			$this->db()->query("UPDATE comptes SET solde = $solde WHERE id = $id");
			$req = $this->db()->prepare("INSERT INTO opperations (compte_id,montant,type,created_at) VALUES (:compte_id,:montant,:type,:created_at)");
			$req->execute([
				'compte_id' => $id,
				'montant' => (float)$_POST['montant'],
				'type' => 'dep',
				'created_at' => (new \DateTime())->format('Y-m-d h:m:s')
			]);
			$this->addFlash('success', "Le compte avec l'id $id a été credité de ".$_POST['montant']."FCFA, le nouveau solde est $solde.");
			return $this->redirectToRoute('comptes.index');
		}
		return $this->render('comptes/credit', compact('data'));
	}
}