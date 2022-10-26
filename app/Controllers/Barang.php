<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Validation\StrictRules\Rules;
use Config\Validation;

$barangModel = new \App\Models\BarangModel();

class Barang extends BaseController
{


	protected $barangModel;
	public function __construct()
	{
		$this->barangModel = new BarangModel();
	}

	// halaman barang
	public function index()
	{
		// conek db tanpa model
		// $db = \config\Database::connect();
		// $barang = $db->query("SELECT * FROM barang");
		// $data['barangs'] = $barang;

		// $barang = $this->barangModel->findAll();
		$data = [

			'title' => 'Daftar Barang',
			'barang' => $this->barangModel->getBarang()
		];
		return  view('barang/index', $data);
	}

	//fungsi Detail
	public function detail($slug)
	{

		$data = [
			'title' => 'Detail Barang',
			'barang' => $this->barangModel->getBarang($slug)
		];

		//jika komik tidak ada di table
		if (empty($data['barang'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Barang ' . $slug . 'Tidak Ada.');
		}
		return view('barang/detail', $data);
	}

	//halaman create
	public function create()
	{

		$data = [
			'validation' => \Config\Services::validation(),
			'title' => 'From Tambah Data Barang'
		];

		return view('barang/create', $data);
	}


	//proses insert data
	public function save()
	{
		// validasi input

		if (!$this->validate([
			'nama_barang' => [
				'rules' => 'required|is_unique[barang.nama_barang]',
				'errors' => [
					'required' => 'Nama Barang Harus Disi',
					'is_unique' => 'Nama Barang Sudah Ada'
				]
			],
			'harga' => [
				'rules' => 'required[barang.harga]',
				'errors' => [
					'required' => 'Harga Harus Disi'
				]
			],
			'stok' => [
				'rules' => 'required[barang.stok]',
				'errors' => [
					'required' => 'Stok Harus Disi'
				]
			],
			'gambar' => [
				'rules' => 'max_size[gambar,1024]|is_image[gambar]
				|mime_in[gambar,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Gambar Terlalu besar',
					'is_image' => 'Yang Anda Masukan Bukan Gambar',
					'mime_in'  => 'Format Gambar Tidak Mendukung (Harus jpg,jpeg,png)'
				]
			]
		])) {

			// $validation = \Config\Services::validation();
			// return redirect()->to('/barang/create')->withInput()->with('validation', $validation);
			return redirect()->to('/barang/create')->withInput();
		}

		// ambil gambar
		$filegambar = $this->request->getFile('gambar');
		// apakah tidak ada gambar diupload
		if ($filegambar->getError() == 4) {
			$namagambar = 'default.jpg';
		} else {
			// pindah file gambar ke folder img
			$filegambar->move('img');

			// ambil nama file
			$namagambar = $filegambar->getName();
		}
		// generate nama gambar random 
		// $namagambar = $filegambar->getRandomName();



		$slug = url_title($this->request->getVar('nama_barang'), '-', true);

		$this->barangModel->save([
			'nama_barang' => $this->request->getVar('nama_barang'),
			'slug' => $slug,
			'harga' => $this->request->getVar('harga'),
			'stok' => $this->request->getVar('stok'),
			'gambar' => $namagambar
		]);

		session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');
		return redirect()->to('/barang');
	}


	// proses delet
	public function delete($id)
	{
		// cari gambar berdasarkan id 
		$barang = $this->barangModel->find($id);

		// hapus gambar di aplikasi cari dulu berdasarkan id seperti di atas
		// apabila ada gambar default 
		if ($barang['gambar'] != 'default.jpg') {
			unlink('img/' . $barang['gambar']);
		}

		$this->barangModel->delete($id);
		session()->setFlashdata('Pesan', 'Data Berhasil Dihapus.');
		return redirect()->to('/barang');
	}

	// phalaman edit
	public function edit($slug)
	{

		$data = [
			'validation' => \Config\Services::validation(),
			'title' => 'From Edit Data Barang',
			'barang' => $this->barangModel->getBarang($slug)
		];

		return view('barang/edit', $data);
	}

	// proses edit
	public function update($id)
	{
		// cek judul dulu
		$baranglama = $this->barangModel->getBarang($this->request->getVar('slug'));
		if ($baranglama['nama_barang'] == $this->request->getVar('nama_barang')) {
			$rule_judul = 'required';
		} else {
			$rule_judul = 'required|is_unique[barang.nama_barang]';
		}


		if (!$this->validate([
			'nama_barang' => [
				'rules' => $rule_judul,
				'errors' => [
					'required' => 'Nama Barang Harus Disi',
					'is_unique' => 'Nama Barang Sudah Ada'
				]
			],
			'harga' => [
				'rules' => 'required[barang.harga]',
				'errors' => [
					'required' => 'Harga Harus Disi'
				]
			],
			'stok' => [
				'rules' => 'required[barang.stok]',
				'errors' => [
					'required' => 'Stok Harus Disi'
				]
			],
			'gambar' => [
				'rules' => 'max_size[gambar,1024]|is_image[gambar]
				|mime_in[gambar,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Gambar Terlalu besar',
					'is_image' => 'Yang Anda Masukan Bukan Gambar',
					'mime_in'  => 'Format Gambar Tidak Mendukung (Harus jpg,jpeg,png)'
				]
			]
		])) {

			// $validation = \Config\Services::validation();


			return redirect()->to('/barang/edit/' . $this->request->getVar('slug'))->withInput();
		}
		// kelola file edit setelah melewati validasi
		$filegambar = $this->request->getFile('gambar');

		// cek gambar apakah tetap gambar lama
		if ($filegambar->getError() == 4) {
			// apabila masih pakai sampul lama dan parameter gambarlama ada di input hidden
			$namagambar = $this->request->getVar('gambarlama');
		} else {
			// generate name
			$namagambar = $filegambar->getName();
			// upload gambar
			$filegambar->move('img');
			// dan apabila file baru maka hapus file lama
			unlink('img/' . $this->request->getVar('gambarlama'));
		}

		$slug = url_title($this->request->getVar('nama_barang'), '-', true);

		$this->barangModel->save([
			'id_barang' => $id,
			'nama_barang' => $this->request->getVar('nama_barang'),
			'slug' => $slug,
			'harga' => $this->request->getVar('harga'),
			'stok' => $this->request->getVar('stok'),
			'gambar' => $namagambar
		]);

		session()->setFlashdata('Pesan', 'Data Berhasil Diubah.');
		return redirect()->to('/barang');
	}
}
