<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 4,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 5,
            ),
            4 => 
            array (
                'permission_id' => 1,
                'role_id' => 6,
            ),
            5 => 
            array (
                'permission_id' => 1,
                'role_id' => 7,
            ),
            6 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            8 => 
            array (
                'permission_id' => 2,
                'role_id' => 4,
            ),
            9 => 
            array (
                'permission_id' => 2,
                'role_id' => 5,
            ),
            10 => 
            array (
                'permission_id' => 2,
                'role_id' => 6,
            ),
            11 => 
            array (
                'permission_id' => 2,
                'role_id' => 7,
            ),
            12 => 
            array (
                'permission_id' => 2,
                'role_id' => 8,
            ),
            13 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            14 => 
            array (
                'permission_id' => 3,
                'role_id' => 3,
            ),
            15 => 
            array (
                'permission_id' => 3,
                'role_id' => 4,
            ),
            16 => 
            array (
                'permission_id' => 3,
                'role_id' => 5,
            ),
            17 => 
            array (
                'permission_id' => 3,
                'role_id' => 6,
            ),
            18 => 
            array (
                'permission_id' => 3,
                'role_id' => 7,
            ),
            19 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            20 => 
            array (
                'permission_id' => 4,
                'role_id' => 3,
            ),
            21 => 
            array (
                'permission_id' => 4,
                'role_id' => 4,
            ),
            22 => 
            array (
                'permission_id' => 4,
                'role_id' => 5,
            ),
            23 => 
            array (
                'permission_id' => 4,
                'role_id' => 6,
            ),
            24 => 
            array (
                'permission_id' => 4,
                'role_id' => 7,
            ),
            25 => 
            array (
                'permission_id' => 5,
                'role_id' => 7,
            ),
            26 => 
            array (
                'permission_id' => 6,
                'role_id' => 7,
            ),
            27 => 
            array (
                'permission_id' => 7,
                'role_id' => 7,
            ),
            28 => 
            array (
                'permission_id' => 8,
                'role_id' => 7,
            ),
            29 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            30 => 
            array (
                'permission_id' => 9,
                'role_id' => 3,
            ),
            31 => 
            array (
                'permission_id' => 9,
                'role_id' => 4,
            ),
            32 => 
            array (
                'permission_id' => 9,
                'role_id' => 5,
            ),
            33 => 
            array (
                'permission_id' => 9,
                'role_id' => 6,
            ),
            34 => 
            array (
                'permission_id' => 9,
                'role_id' => 7,
            ),
            35 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            36 => 
            array (
                'permission_id' => 10,
                'role_id' => 3,
            ),
            37 => 
            array (
                'permission_id' => 10,
                'role_id' => 4,
            ),
            38 => 
            array (
                'permission_id' => 10,
                'role_id' => 5,
            ),
            39 => 
            array (
                'permission_id' => 10,
                'role_id' => 6,
            ),
            40 => 
            array (
                'permission_id' => 10,
                'role_id' => 7,
            ),
            41 => 
            array (
                'permission_id' => 10,
                'role_id' => 8,
            ),
            42 => 
            array (
                'permission_id' => 11,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 11,
                'role_id' => 3,
            ),
            44 => 
            array (
                'permission_id' => 11,
                'role_id' => 4,
            ),
            45 => 
            array (
                'permission_id' => 11,
                'role_id' => 5,
            ),
            46 => 
            array (
                'permission_id' => 11,
                'role_id' => 6,
            ),
            47 => 
            array (
                'permission_id' => 11,
                'role_id' => 7,
            ),
            48 => 
            array (
                'permission_id' => 12,
                'role_id' => 2,
            ),
            49 => 
            array (
                'permission_id' => 12,
                'role_id' => 3,
            ),
            50 => 
            array (
                'permission_id' => 12,
                'role_id' => 4,
            ),
            51 => 
            array (
                'permission_id' => 12,
                'role_id' => 5,
            ),
            52 => 
            array (
                'permission_id' => 12,
                'role_id' => 6,
            ),
            53 => 
            array (
                'permission_id' => 12,
                'role_id' => 7,
            ),
            54 => 
            array (
                'permission_id' => 13,
                'role_id' => 5,
            ),
            55 => 
            array (
                'permission_id' => 13,
                'role_id' => 7,
            ),
            56 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            57 => 
            array (
                'permission_id' => 14,
                'role_id' => 3,
            ),
            58 => 
            array (
                'permission_id' => 14,
                'role_id' => 4,
            ),
            59 => 
            array (
                'permission_id' => 14,
                'role_id' => 5,
            ),
            60 => 
            array (
                'permission_id' => 14,
                'role_id' => 6,
            ),
            61 => 
            array (
                'permission_id' => 14,
                'role_id' => 7,
            ),
            62 => 
            array (
                'permission_id' => 14,
                'role_id' => 8,
            ),
            63 => 
            array (
                'permission_id' => 15,
                'role_id' => 5,
            ),
            64 => 
            array (
                'permission_id' => 15,
                'role_id' => 7,
            ),
            65 => 
            array (
                'permission_id' => 16,
                'role_id' => 5,
            ),
            66 => 
            array (
                'permission_id' => 16,
                'role_id' => 7,
            ),
            67 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            68 => 
            array (
                'permission_id' => 17,
                'role_id' => 3,
            ),
            69 => 
            array (
                'permission_id' => 17,
                'role_id' => 4,
            ),
            70 => 
            array (
                'permission_id' => 17,
                'role_id' => 5,
            ),
            71 => 
            array (
                'permission_id' => 17,
                'role_id' => 6,
            ),
            72 => 
            array (
                'permission_id' => 17,
                'role_id' => 7,
            ),
            73 => 
            array (
                'permission_id' => 18,
                'role_id' => 2,
            ),
            74 => 
            array (
                'permission_id' => 18,
                'role_id' => 3,
            ),
            75 => 
            array (
                'permission_id' => 18,
                'role_id' => 4,
            ),
            76 => 
            array (
                'permission_id' => 18,
                'role_id' => 5,
            ),
            77 => 
            array (
                'permission_id' => 18,
                'role_id' => 6,
            ),
            78 => 
            array (
                'permission_id' => 18,
                'role_id' => 7,
            ),
            79 => 
            array (
                'permission_id' => 18,
                'role_id' => 8,
            ),
            80 => 
            array (
                'permission_id' => 19,
                'role_id' => 2,
            ),
            81 => 
            array (
                'permission_id' => 19,
                'role_id' => 3,
            ),
            82 => 
            array (
                'permission_id' => 19,
                'role_id' => 4,
            ),
            83 => 
            array (
                'permission_id' => 19,
                'role_id' => 5,
            ),
            84 => 
            array (
                'permission_id' => 19,
                'role_id' => 6,
            ),
            85 => 
            array (
                'permission_id' => 19,
                'role_id' => 7,
            ),
            86 => 
            array (
                'permission_id' => 20,
                'role_id' => 2,
            ),
            87 => 
            array (
                'permission_id' => 20,
                'role_id' => 3,
            ),
            88 => 
            array (
                'permission_id' => 20,
                'role_id' => 4,
            ),
            89 => 
            array (
                'permission_id' => 20,
                'role_id' => 5,
            ),
            90 => 
            array (
                'permission_id' => 20,
                'role_id' => 6,
            ),
            91 => 
            array (
                'permission_id' => 20,
                'role_id' => 7,
            ),
            92 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            93 => 
            array (
                'permission_id' => 21,
                'role_id' => 3,
            ),
            94 => 
            array (
                'permission_id' => 21,
                'role_id' => 4,
            ),
            95 => 
            array (
                'permission_id' => 21,
                'role_id' => 5,
            ),
            96 => 
            array (
                'permission_id' => 21,
                'role_id' => 6,
            ),
            97 => 
            array (
                'permission_id' => 21,
                'role_id' => 7,
            ),
            98 => 
            array (
                'permission_id' => 21,
                'role_id' => 8,
            ),
            99 => 
            array (
                'permission_id' => 24,
                'role_id' => 4,
            ),
            100 => 
            array (
                'permission_id' => 24,
                'role_id' => 5,
            ),
            101 => 
            array (
                'permission_id' => 24,
                'role_id' => 6,
            ),
            102 => 
            array (
                'permission_id' => 24,
                'role_id' => 7,
            ),
            103 => 
            array (
                'permission_id' => 24,
                'role_id' => 8,
            ),
            104 => 
            array (
                'permission_id' => 27,
                'role_id' => 4,
            ),
            105 => 
            array (
                'permission_id' => 27,
                'role_id' => 5,
            ),
            106 => 
            array (
                'permission_id' => 27,
                'role_id' => 6,
            ),
            107 => 
            array (
                'permission_id' => 27,
                'role_id' => 7,
            ),
            108 => 
            array (
                'permission_id' => 27,
                'role_id' => 8,
            ),
            109 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            110 => 
            array (
                'permission_id' => 29,
                'role_id' => 3,
            ),
            111 => 
            array (
                'permission_id' => 29,
                'role_id' => 4,
            ),
            112 => 
            array (
                'permission_id' => 29,
                'role_id' => 5,
            ),
            113 => 
            array (
                'permission_id' => 29,
                'role_id' => 6,
            ),
            114 => 
            array (
                'permission_id' => 29,
                'role_id' => 7,
            ),
            115 => 
            array (
                'permission_id' => 29,
                'role_id' => 8,
            ),
            116 => 
            array (
                'permission_id' => 30,
                'role_id' => 5,
            ),
            117 => 
            array (
                'permission_id' => 30,
                'role_id' => 7,
            ),
            118 => 
            array (
                'permission_id' => 30,
                'role_id' => 8,
            ),
            119 => 
            array (
                'permission_id' => 31,
                'role_id' => 7,
            ),
            120 => 
            array (
                'permission_id' => 31,
                'role_id' => 8,
            ),
            121 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            122 => 
            array (
                'permission_id' => 38,
                'role_id' => 3,
            ),
            123 => 
            array (
                'permission_id' => 38,
                'role_id' => 4,
            ),
            124 => 
            array (
                'permission_id' => 38,
                'role_id' => 5,
            ),
            125 => 
            array (
                'permission_id' => 38,
                'role_id' => 6,
            ),
            126 => 
            array (
                'permission_id' => 38,
                'role_id' => 7,
            ),
            127 => 
            array (
                'permission_id' => 39,
                'role_id' => 4,
            ),
            128 => 
            array (
                'permission_id' => 39,
                'role_id' => 7,
            ),
        ));
        
        
    }
}