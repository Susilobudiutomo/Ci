<?php

namespace App\Database\Seeds;

// harus import ini sebelum buat created_at dan Updated_at
use CodeIgniter\I18n\Time;

class orangSeeder extends \CodeIgniter\Database\Seeder
{

    public function run()
    {
        // contoh input banyak data
        // $data = [
        //     [
        //         'nama' => 'uuk',
        //         'alamat' => 'karanglincak',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //         // use CodeIgniter\I18n\Time; import ini sebelum membuat time now
        //     ],
        //     [
        //         'nama' => 'opal',
        //         'alamat' => 'karanglincak',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];


        //  contoh input satu data
        // $data = [

        //     'nama' => 'uuk',
        //     'alamat' => 'karanglincak',
        //     'created_at' => Time::now(),
        //     'updated_at' => Time::now()
        //     // use CodeIgniter\I18n\Time; import ini sebelum membuat time now

        // // ];
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {

            $data = [
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::createFromTimestamp($faker->unixTime())
            ];
            //apabila yang diinput cuma satu data
            $this->db->table('orang')->insert($data);
        }

        // simple query

        // $this->db->query(

        //     "INSERT INTO orang (nama,alamat,created_at,updated_at) VALUE (:nama:,:alamat:,:created_at:,:updated_at:)",
        //     $data
        // );
        // /////////////////////////////////////////////////////////////////

        // query builder

        // apabila yang di input datanya banyak
        // $this->db->table('orang')->insertBatch($data);

    }
}
