<?php 

namespace App\Controllers;

class Pages extends BaseController
{
	public function home()
	{
		$data = [
			'title' =>  'Home'
		];
		echo view ('page/home',$data);
	}
	public function about()
	{
		$data = [
			'title' =>  'About'
		];
		echo view ('page/about',$data);
	}
    
    public function contact()
	{
		$data = [
			'title' =>  'Contact',
			'alamat'=>[
				[
					'tipe'=>'Rumah',
					'alamat'=>'JL. Pantura No. 23',
					'kota'=> 'Rembang'


				],
				[
					'tipe'=>'Kantor',
					'alamat'=>'JL. Melati No. 13',
					'kota'=> 'Rembang'

				]
			]
		];
		echo view ('page/contact',$data);
	}

	
    
}