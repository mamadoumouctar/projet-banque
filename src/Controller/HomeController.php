<?php

namespace Tm\Controller;

class HomeController extends Controller
{
	public function index()
	{		
		return $this->render('home/index');
	}
}
