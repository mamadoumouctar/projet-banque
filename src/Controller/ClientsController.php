<?php
namespace Tm\Controller;

use Tm\Router;
use Tm\Validator\ClientsValidator;

class ClientsController extends Controller
{
	public function index()
	{
		$data = $this->db()->query("select * FROM clients")->fetchAll();
		return $this->render("clients/index", compact('data'));
	}

	public function create()
	{
		$data = ClientsValidator::validate($_POST);
		$errors = ClientsValidator::is_valid();
		if(is_bool($errors) && $errors){
			$data['created_at'] = (new \DateTime())->format("Y-m-d");
			$prepare = $this->db()->prepare("INSERT INTO clients (`nom`,`prenom`,`telephone`,`address`,`created_at`) VALUES (:nom,:prenom,:telephone,:address, :created_at)");
			$prepare->execute($data);
			$this->addFlash('success', "Le client a bien été créé.");
			return $this->redirectToRoute('clients.show', ['id' => $this->db()->lastInsertId()]);
		}
		return $this->render('clients/create', compact('data', 'errors'));
	}

	public function show(int $id)
	{
		$data = $this->db()->prepare("select * FROM clients WHERE id = :id");
		$data->execute(['id' => $id]);
		$data = $data->fetch();
		if(empty($data)){
			return $this->notFoundResponse();
		}
		$comptes = $this->db()->query("SELECT * FROM comptes WHERE client_id = ".$data['id'])->fetchAll();
		$data['comptes'] = $comptes;
		return $this->render("clients/show", compact('data'));
	}

	public function edit(int $id)
	{
		$prepare = $this->db()->query("SELECT * FROM clients WHERE id = $id");
		if(!is_bool($prepare)){	$client = $prepare->fetch(); }
		if(is_bool($client) && !$client){
			return $this->notFoundResponse();
		}
		$pass = !empty($_POST) ? $_POST : $client;
		$data = ClientsValidator::validate($pass);
		$errors = ClientsValidator::is_valid($id);
		if(is_bool($errors) && $errors && !empty($_POST)){
			$prepare = $this->db()->prepare("UPDATE clients SET `nom` = :nom,`prenom` = :prenom,`telephone` = :telephone,`address` = :address WHERE id = $id");
			$prepare->execute($data);
			$this->addFlash('info', "Le client a bien été modifié.");
			$this->redirectToRoute('clients.show', ['id' => $client['id']]);
		}
		return $this->render('clients/edit', compact('errors', 'data'));
	}

	public function delate(int $id)
	{
		$client = $this->db()->query("SELECT id FROM clients WHERE id = $id")->fetch();
		if(!empty($client)){
			try{
				$data = $this->db()->query("SELECT id FROM comptes WHERE client_id = $id")->fetch();
			}catch(\Error $e){
				$this->addFlash('error', "Impossible de supprimmé un client possedant des comptes.");
				return $this->redirectToRoute('clients.index');
			}
			if(is_bool($data)){
				$this->db()->query("DELETE FROM clients WHERE id = $id");
				$this->addFlash('info', "Le client a bien supprimmé avec succès.");
			}else{
				$this->addFlash('error', "Impossible de supprimmé un client possedant des comptes.");
			}
			return $this->redirectToRoute('clients.index');
		}else{
			$this->addFlash('error', "Vous pouvez pas supprimmé un client qui n'existe pas.");
		}
		return $this->redirectToRoute('clients.index');
	}
}
