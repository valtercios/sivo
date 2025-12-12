<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrgaosEmissoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        
        \DB::table('orgaos_emissores')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sigla' => 'ABNC',
                'nome' => 'Academia Brasileira de Neurocirurgia',
                'tipo' => '1',
            ),
            1 => 
            array (
                'id' => 2,
                'sigla' => 'AGU',
                'nome' => 'Advocacia-Geral da União',
                'tipo' => '1',
            ),
            2 => 
            array (
                'id' => 3,
                'sigla' => 'ANAC',
                'nome' => 'Agência Nacional de Aviação Civil',
                'tipo' => '1',
            ),
            3 => 
            array (
                'id' => 4,
                'sigla' => 'CAER',
                'nome' => 'Clube de Aeronáutica',
                'tipo' => '1',
            ),
            4 => 
            array (
                'id' => 5,
                'sigla' => 'CAU',
                'nome' => 'Conselho de Arquitetura e Urbanismo',
                'tipo' => '1',
            ),
            5 => 
            array (
                'id' => 6,
                'sigla' => 'CBM',
                'nome' => 'Corpo de Bombeiro Militar',
                'tipo' => '2',
            ),
            6 => 
            array (
                'id' => 7,
                'sigla' => 'CFA',
                'nome' => 'Conselho Federal Administração',
                'tipo' => '1',
            ),
            7 => 
            array (
                'id' => 8,
                'sigla' => 'CFB',
                'nome' => 'Conselho Federal de Biblioteconomia',
                'tipo' => '1',
            ),
            8 => 
            array (
                'id' => 9,
                'sigla' => 'CFBIO',
                'nome' => 'Conselho Federal de Biologia',
                'tipo' => '1',
            ),
            9 => 
            array (
                'id' => 10,
                'sigla' => 'CFBM',
                'nome' => 'Conselho Federal de Biomedicina',
                'tipo' => '1',
            ),
            10 => 
            array (
                'id' => 11,
                'sigla' => 'CFC',
                'nome' => 'Conselho Federal de Contabilidade',
                'tipo' => '1',
            ),
            11 => 
            array (
                'id' => 12,
                'sigla' => 'CFESS',
                'nome' => 'Conselho Federal de Serviço Social',
                'tipo' => '1',
            ),
            12 => 
            array (
                'id' => 13,
                'sigla' => 'CFF',
                'nome' => 'Conselho Regional de Farmácia',
                'tipo' => '2',
            ),
            13 => 
            array (
                'id' => 14,
                'sigla' => 'CFFA',
                'nome' => 'Conselho Federal de Fonoaudiologia',
                'tipo' => '1',
            ),
            14 => 
            array (
                'id' => 15,
                'sigla' => 'CFM',
                'nome' => 'Conselho Federal de Medicina',
                'tipo' => '1',
            ),
            15 => 
            array (
                'id' => 16,
                'sigla' => 'CFMV',
                'nome' => 'Conselho Federal de Medicina Veterinária',
                'tipo' => '1',
            ),
            16 => 
            array (
                'id' => 17,
                'sigla' => 'CFN',
                'nome' => 'Conselho Federal de Nutrição',
                'tipo' => '1',
            ),
            17 => 
            array (
                'id' => 18,
                'sigla' => 'CFO',
                'nome' => 'Conselho Federal de Odontologia',
                'tipo' => '1',
            ),
            18 => 
            array (
                'id' => 19,
                'sigla' => 'CFP',
                'nome' => 'Conselho Federal de Psicologia',
                'tipo' => '1',
            ),
            19 => 
            array (
                'id' => 20,
                'sigla' => 'CFQ',
                'nome' => 'Conselho Regional de Química',
                'tipo' => '2',
            ),
            20 => 
            array (
                'id' => 21,
                'sigla' => 'CFT',
                'nome' => 'Conselho Federal dos Técnicos Industriais',
                'tipo' => '1',
            ),
            21 => 
            array (
                'id' => 22,
                'sigla' => 'CFTA',
                'nome' => 'Conselho Federal dos Técnicos Agrícolas',
                'tipo' => '1',
            ),
            22 => 
            array (
                'id' => 23,
                'sigla' => 'CGPI',
                'nome' => 'Coordenação Geral de Privilégios e Imunidades',
                'tipo' => '1',
            ),
            23 => 
            array (
                'id' => 24,
                'sigla' => 'CGPMAF',
                'nome' => 'Coordenadoria Geral de Polícia Marítima, Aeronáutica e de Fronteiras',
                'tipo' => '1',
            ),
            24 => 
            array (
                'id' => 25,
                'sigla' => 'CIPC',
                'nome' => 'Centro de Inteligência da Polícia Civil',
                'tipo' => '1',
            ),
            25 => 
            array (
                'id' => 26,
                'sigla' => 'CNIG',
                'nome' => 'Conselho Nacional de Imigração',
                'tipo' => '1',
            ),
            26 => 
            array (
                'id' => 27,
                'sigla' => 'CNT',
                'nome' => 'Confederação Nacional do Transporte',
                'tipo' => '1',
            ),
            27 => 
            array (
                'id' => 28,
                'sigla' => 'CNTV',
                'nome' => 'Confederação Nacional de Vigilantes & Prestadores de Serviços',
                'tipo' => '1',
            ),
            28 => 
            array (
                'id' => 29,
                'sigla' => 'COFECI',
                'nome' => 'Conselho Federal de Corretores de Imóveis',
                'tipo' => '1',
            ),
            29 => 
            array (
                'id' => 30,
                'sigla' => 'COFECON',
                'nome' => 'Conselho Federal de Economia',
                'tipo' => '1',
            ),
            30 => 
            array (
                'id' => 31,
                'sigla' => 'COFEM',
                'nome' => 'Conselho Federal de Museologia',
                'tipo' => '1',
            ),
            31 => 
            array (
                'id' => 32,
                'sigla' => 'COFEN',
                'nome' => 'Conselho Federal de Enfermagem',
                'tipo' => '1',
            ),
            32 => 
            array (
                'id' => 33,
                'sigla' => 'COFFITO',
                'nome' => 'Conselho Regional de Fisioterapia e Terapia Ocupacional',
                'tipo' => '2',
            ),
            33 => 
            array (
                'id' => 34,
                'sigla' => 'COMAER',
                'nome' => 'Comando da Aeronáutica',
                'tipo' => '1',
            ),
            34 => 
            array (
                'id' => 35,
                'sigla' => 'CONFE',
                'nome' => 'Conselho Federal de Estatística',
                'tipo' => '1',
            ),
            35 => 
            array (
                'id' => 36,
                'sigla' => 'CONFEA',
                'nome' => 'Conselho Federal de Engenharia e Agronomia',
                'tipo' => '1',
            ),
            36 => 
            array (
                'id' => 37,
                'sigla' => 'CONFEF',
                'nome' => 'Conselho Federal de Educação Física',
                'tipo' => '1',
            ),
            37 => 
            array (
                'id' => 38,
                'sigla' => 'CONFERE',
                'nome' => 'Conselho Federal dos Representantes Comerciais',
                'tipo' => '1',
            ),
            38 => 
            array (
                'id' => 39,
                'sigla' => 'CONRE',
                'nome' => 'Conselho Regional de Estatística',
                'tipo' => '2',
            ),
            39 => 
            array (
                'id' => 40,
                'sigla' => 'CONRERP',
                'nome' => 'Conselho Federal de Profissionais de Relações Públicas',
                'tipo' => '1',
            ),
            40 => 
            array (
                'id' => 41,
                'sigla' => 'CORE',
                'nome' => 'Conselho Regional dos Representantes Comerciais',
                'tipo' => '2',
            ),
            41 => 
            array (
                'id' => 42,
                'sigla' => 'CORECON',
                'nome' => 'Conselho Regional de Economia',
                'tipo' => '2',
            ),
            42 => 
            array (
                'id' => 43,
                'sigla' => 'COREM',
                'nome' => 'Conselho Regional de Museologia',
                'tipo' => '2',
            ),
            43 => 
            array (
                'id' => 44,
                'sigla' => 'COREN',
                'nome' => 'Conselho Regional de Enfermagem',
                'tipo' => '2',
            ),
            44 => 
            array (
                'id' => 45,
                'sigla' => 'CRA',
                'nome' => 'Conselho Regional de Administração',
                'tipo' => '2',
            ),
            45 => 
            array (
                'id' => 46,
                'sigla' => 'CRAS',
                'nome' => 'Centro de Referência de Assistência Social',
                'tipo' => '1',
            ),
            46 => 
            array (
                'id' => 47,
                'sigla' => 'CRB',
                'nome' => 'Conselho Regional de Biblioteconomia',
                'tipo' => '2',
            ),
            47 => 
            array (
                'id' => 48,
                'sigla' => 'CRBIO',
                'nome' => 'Conselho Regional de Biologia',
                'tipo' => '2',
            ),
            48 => 
            array (
                'id' => 49,
                'sigla' => 'CRBM',
                'nome' => 'Conselho Regional de Biomedicina',
                'tipo' => '2',
            ),
            49 => 
            array (
                'id' => 50,
                'sigla' => 'CRC',
                'nome' => 'Conselho Regional de Contabilidade',
                'tipo' => '2',
            ),
            50 => 
            array (
                'id' => 51,
                'sigla' => 'CREA',
                'nome' => 'Conselho Regional de Engenharia e Agronomia',
                'tipo' => '2',
            ),
            51 => 
            array (
                'id' => 52,
                'sigla' => 'CRECI',
                'nome' => 'Conselho Regional de Corretores de Imóveis',
                'tipo' => '2',
            ),
            52 => 
            array (
                'id' => 53,
                'sigla' => 'CREF',
                'nome' => 'Conselho Regional de Educação Física',
                'tipo' => '2',
            ),
            53 => 
            array (
                'id' => 54,
                'sigla' => 'CREFITO',
                'nome' => 'Conselho Regional de Fisioterapia e Terapia Ocupacional',
                'tipo' => '2',
            ),
            54 => 
            array (
                'id' => 55,
                'sigla' => 'CRESS',
                'nome' => 'Conselho Regional de Serviço Social',
                'tipo' => '2',
            ),
            55 => 
            array (
                'id' => 56,
                'sigla' => 'CRF',
                'nome' => 'Conselho Regional de Farmácia',
                'tipo' => '2',
            ),
            56 => 
            array (
                'id' => 57,
                'sigla' => 'CRFA',
                'nome' => 'Conselho Regional de Fonoaudiologia',
                'tipo' => '2',
            ),
            57 => 
            array (
                'id' => 58,
                'sigla' => 'CRM',
                'nome' => 'Conselho Regional de Medicina',
                'tipo' => '2',
            ),
            58 => 
            array (
                'id' => 59,
                'sigla' => 'CRMV',
                'nome' => 'Conselho Regional de Medicina Veterinária',
                'tipo' => '2',
            ),
            59 => 
            array (
                'id' => 60,
                'sigla' => 'CRN',
                'nome' => 'Conselho Regional de Nutrição',
                'tipo' => '2',
            ),
            60 => 
            array (
                'id' => 61,
                'sigla' => 'CRO',
                'nome' => 'Conselho Regional de Odontologia',
                'tipo' => '2',
            ),
            61 => 
            array (
                'id' => 62,
                'sigla' => 'CRP',
                'nome' => 'Conselho Regional de Psicologia',
                'tipo' => '2',
            ),
            62 => 
            array (
                'id' => 63,
                'sigla' => 'CRPRE',
                'nome' => 'Conselho Regional de Profissionais de Relações Públicas',
                'tipo' => '2',
            ),
            63 => 
            array (
                'id' => 64,
                'sigla' => 'CRQ',
                'nome' => 'Conselho Regional de Química',
                'tipo' => '2',
            ),
            64 => 
            array (
                'id' => 65,
                'sigla' => 'CRT',
                'nome' => 'Conselho Regional dos Técnicos Industriais',
                'tipo' => '2',
            ),
            65 => 
            array (
                'id' => 66,
                'sigla' => 'CRTA',
                'nome' => 'Conselho Regional de Técnicos de Administração',
                'tipo' => '2',
            ),
            66 => 
            array (
                'id' => 67,
                'sigla' => 'CTPS',
                'nome' => 'Carteira de Trabalho e Previdência Social',
                'tipo' => '2',
            ),
            67 => 
            array (
                'id' => 68,
                'sigla' => 'CV',
                'nome' => 'Cartório Civil',
                'tipo' => '3',
            ),
            68 => 
            array (
                'id' => 69,
                'sigla' => 'DELEMIG',
                'nome' => 'Delegacia de Polícia de Imigração',
                'tipo' => '2',
            ),
            69 => 
            array (
                'id' => 70,
                'sigla' => 'DETRAN',
                'nome' => 'Departamento Estadual de Trânsito',
                'tipo' => '2',
            ),
            70 => 
            array (
                'id' => 71,
                'sigla' => 'DGPC',
                'nome' => 'Diretoria Geral da Polícia Civil',
                'tipo' => '2',
            ),
            71 => 
            array (
                'id' => 72,
                'sigla' => 'DIC',
                'nome' => 'Diretoria de Identificação Civil',
                'tipo' => '2',
            ),
            72 => 
            array (
                'id' => 73,
                'sigla' => 'DICC',
                'nome' => 'Diretoria de Identificação Civil e Criminal',
                'tipo' => '2',
            ),
            73 => 
            array (
                'id' => 74,
                'sigla' => 'DIREX',
                'nome' => 'Diretoria Executiva',
                'tipo' => '1',
            ),
            74 => 
            array (
                'id' => 75,
                'sigla' => 'DPF',
                'nome' => 'Departamento de Polícia Federal',
                'tipo' => '1',
            ),
            75 => 
            array (
                'id' => 76,
                'sigla' => 'DPMAF',
                'nome' => 'Divisão de Polícia Marítima, Aérea e de Fronteiras',
                'tipo' => '1',
            ),
            76 => 
            array (
                'id' => 77,
                'sigla' => 'DPT',
                'nome' => 'Departamento de Polícia Técnica Geral',
                'tipo' => '1',
            ),
            77 => 
            array (
                'id' => 78,
                'sigla' => 'DPTC',
                'nome' => 'Departamento de Polícia Técnico Científica',
                'tipo' => '1',
            ),
            78 => 
            array (
                'id' => 79,
                'sigla' => 'DREX',
                'nome' => 'Delegacia Regional Executiva',
                'tipo' => '2',
            ),
            79 => 
            array (
                'id' => 80,
                'sigla' => 'DRT',
                'nome' => 'Delegacia Regional do Trabalho',
                'tipo' => '2',
            ),
            80 => 
            array (
                'id' => 81,
                'sigla' => 'EB',
                'nome' => 'Exército Brasileiro',
                'tipo' => '1',
            ),
            81 => 
            array (
                'id' => 82,
                'sigla' => 'FAB',
                'nome' => 'Força Aérea Brasileira',
                'tipo' => '1',
            ),
            82 => 
            array (
                'id' => 83,
                'sigla' => 'FENAJ',
                'nome' => 'Federação Nacional dos Jornalistas',
                'tipo' => '1',
            ),
            83 => 
            array (
                'id' => 84,
                'sigla' => 'FGTS',
                'nome' => 'Fundo de Garantia do Tempo de Serviço',
                'tipo' => '1',
            ),
            84 => 
            array (
                'id' => 85,
                'sigla' => 'FIPE',
                'nome' => 'Fundação Instituto de Pesquisas Econômicas',
                'tipo' => '1',
            ),
            85 => 
            array (
                'id' => 86,
                'sigla' => 'FLS',
                'nome' => 'Fundação Lyndolpho Silva',
                'tipo' => '1',
            ),
            86 => 
            array (
                'id' => 87,
                'sigla' => 'FUNAI',
                'nome' => 'Fundação Nacional do Índio',
                'tipo' => '1',
            ),
            87 => 
            array (
                'id' => 88,
                'sigla' => 'GEJSP',
                'nome' => 'Gerência de Estado de Justiça, Segurança Pública e Cidadania',
                'tipo' => '1',
            ),
            88 => 
            array (
                'id' => 89,
                'sigla' => 'GEJSPC',
                'nome' => 'Gerência de Estado de Justiça, Segurança Pública e Cidadania',
                'tipo' => '1',
            ),
            89 => 
            array (
                'id' => 90,
                'sigla' => 'GEJUSPC',
                'nome' => 'Gerência de Estado de Justiça, Segurança Pública e Cidadania',
                'tipo' => '1',
            ),
            90 => 
            array (
                'id' => 91,
                'sigla' => 'GESP',
                'nome' => 'Gerência de Estado de Segurança Pública',
                'tipo' => '1',
            ),
            91 => 
            array (
                'id' => 92,
                'sigla' => 'GOVGO',
                'nome' => 'Governo do Estado de Goiás',
                'tipo' => '1',
            ),
            92 => 
            array (
                'id' => 93,
                'sigla' => 'I CLA',
                'nome' => 'Carteira de Identidade Classista',
                'tipo' => '1',
            ),
            93 => 
            array (
                'id' => 94,
                'sigla' => 'ICP',
                'nome' => 'Instituto de Polícia Científica',
                'tipo' => '1',
            ),
            94 => 
            array (
                'id' => 95,
                'sigla' => 'IDAMP',
                'nome' => 'Instituto de Identificação Dr. Aroldo Mendes Paiva',
                'tipo' => '1',
            ),
            95 => 
            array (
                'id' => 96,
                'sigla' => 'IFP',
                'nome' => 'Instituto Félix Pacheco',
                'tipo' => '1',
            ),
            96 => 
            array (
                'id' => 97,
                'sigla' => 'IGP',
                'nome' => 'Instituto Geral de Perícias',
                'tipo' => '1',
            ),
            97 => 
            array (
                'id' => 98,
                'sigla' => 'IIACM',
                'nome' => 'Instituto de Identificação Aderson Conceição de Melo',
                'tipo' => '1',
            ),
            98 => 
            array (
                'id' => 99,
                'sigla' => 'IICC',
                'nome' => 'Instituto de Identificação Civil e Criminal',
                'tipo' => '1',
            ),
            99 => 
            array (
                'id' => 100,
                'sigla' => 'IICCECF',
                'nome' => 'Instituto de Identificação Civil e Criminal Engrácia da Costa Francisco',
                'tipo' => '1',
            ),
            100 => 
            array (
                'id' => 101,
                'sigla' => 'IICM',
                'nome' => 'Instituto de Identificação Carlos Menezes',
                'tipo' => '1',
            ),
            101 => 
            array (
                'id' => 102,
                'sigla' => 'IIGP',
                'nome' => 'Instituto de Identificação Gonçalo Pereira',
                'tipo' => '1',
            ),
            102 => 
            array (
                'id' => 103,
                'sigla' => 'IIJDM',
                'nome' => 'Instituto de Identificação João de Deus Martins',
                'tipo' => '1',
            ),
            103 => 
            array (
                'id' => 104,
                'sigla' => 'IIRGD',
                'nome' => 'Instituto de Identificação Ricardo Gumbleton Daunt',
                'tipo' => '1',
            ),
            104 => 
            array (
                'id' => 105,
                'sigla' => 'IIPC',
                'nome' => 'Instituto de Identificação da Polícia Civil',
                'tipo' => '1',
            ),
            105 => 
            array (
                'id' => 106,
                'sigla' => 'IIPM',
                'nome' => 'Instituto de Identificação Pedro Mello',
                'tipo' => '1',
            ),
            106 => 
            array (
                'id' => 107,
                'sigla' => 'IIRHM',
                'nome' => 'Instituto de Identificação Raimundo Hermínio de Melo',
                'tipo' => '1',
            ),
            107 => 
            array (
                'id' => 108,
                'sigla' => 'IITB',
                'nome' => 'Instituto de Identificação Tavares Buril',
                'tipo' => '1',
            ),
            108 => 
            array (
                'id' => 109,
                'sigla' => 'IML',
                'nome' => 'Instituto Médico-Legal',
                'tipo' => '1',
            ),
            109 => 
            array (
                'id' => 110,
                'sigla' => 'INI',
                'nome' => 'Instituto Nacional de Identificação',
                'tipo' => '1',
            ),
            110 => 
            array (
                'id' => 111,
                'sigla' => 'IPF',
                'nome' => 'Instituto Pereira Faustino',
                'tipo' => '1',
            ),
            111 => 
            array (
                'id' => 112,
                'sigla' => 'ITCP',
                'nome' => 'Instituto Técnico-Científico de Perícia',
                'tipo' => '1',
            ),
            112 => 
            array (
                'id' => 113,
                'sigla' => 'ITEP',
                'nome' => 'Instituto Técnico-Científico de Perícia',
                'tipo' => '1',
            ),
            113 => 
            array (
                'id' => 114,
                'sigla' => 'MAER',
                'nome' => 'Ministério da Aeronáutica',
                'tipo' => '1',
            ),
            114 => 
            array (
                'id' => 115,
                'sigla' => 'MB',
                'nome' => 'Marinha do Brasil',
                'tipo' => '1',
            ),
            115 => 
            array (
                'id' => 116,
                'sigla' => 'MD',
                'nome' => 'Ministério da Defesa',
                'tipo' => '1',
            ),
            116 => 
            array (
                'id' => 117,
                'sigla' => 'MDS',
                'nome' => 'Ministério da Cidadania',
                'tipo' => '1',
            ),
            117 => 
            array (
                'id' => 118,
                'sigla' => 'MEC',
                'nome' => 'Ministério da Educação e Cultura',
                'tipo' => '1',
            ),
            118 => 
            array (
                'id' => 119,
                'sigla' => 'MEX',
                'nome' => 'Ministério do Exército',
                'tipo' => '1',
            ),
            119 => 
            array (
                'id' => 120,
                'sigla' => 'MINDEF',
                'nome' => 'Ministério da Defesa',
                'tipo' => '1',
            ),
            120 => 
            array (
                'id' => 121,
                'sigla' => 'MJ',
                'nome' => 'Ministério da Justiça',
                'tipo' => '1',
            ),
            121 => 
            array (
                'id' => 122,
                'sigla' => 'MM',
                'nome' => 'Ministério da Marinha',
                'tipo' => '1',
            ),
            122 => 
            array (
                'id' => 123,
                'sigla' => 'MMA',
                'nome' => 'Ministério da Marinha',
                'tipo' => '1',
            ),
            123 => 
            array (
                'id' => 124,
                'sigla' => 'MP',
                'nome' => 'Ministério Público',
                'tipo' => '1',
            ),
            124 => 
            array (
                'id' => 125,
                'sigla' => 'MPAS',
                'nome' => 'Ministério da Previdência e Assistência Social',
                'tipo' => '1',
            ),
            125 => 
            array (
                'id' => 126,
                'sigla' => 'MPE',
                'nome' => 'Ministério Público Estadual',
                'tipo' => '1',
            ),
            126 => 
            array (
                'id' => 127,
                'sigla' => 'MPF',
                'nome' => 'Ministério Público Federal',
                'tipo' => '1',
            ),
            127 => 
            array (
                'id' => 128,
                'sigla' => 'MPT',
                'nome' => 'Ministério Público do Trabalho',
                'tipo' => '1',
            ),
            128 => 
            array (
                'id' => 129,
                'sigla' => 'MRE',
                'nome' => 'Ministério das Relações Exteriores',
                'tipo' => '1',
            ),
            129 => 
            array (
                'id' => 130,
                'sigla' => 'MT',
                'nome' => 'Ministério do Trabalho',
                'tipo' => '1',
            ),
            130 => 
            array (
                'id' => 131,
                'sigla' => 'MTE',
                'nome' => 'Ministério da Economia',
                'tipo' => '1',
            ),
            131 => 
            array (
                'id' => 132,
                'sigla' => 'MTPS',
                'nome' => 'Ministério do Trabalho e Previdência Social',
                'tipo' => '1',
            ),
            132 => 
            array (
                'id' => 133,
                'sigla' => 'NUMIG',
                'nome' => 'Núcleo de Polícia de Imigração',
                'tipo' => '2',
            ),
            133 => 
            array (
                'id' => 134,
                'sigla' => 'OAB',
                'nome' => 'Ordem dos Advogados do Brasil',
                'tipo' => '1',
            ),
            134 => 
            array (
                'id' => 135,
                'sigla' => 'OMB',
                'nome' => 'Ordens dos Músicos do Brasil',
                'tipo' => '1',
            ),
            135 => 
            array (
                'id' => 136,
                'sigla' => 'PC',
                'nome' => 'Polícia Civil',
                'tipo' => '2',
            ),
            136 => 
            array (
                'id' => 137,
                'sigla' => 'PF',
                'nome' => 'Polícia Federal',
                'tipo' => '1',
            ),
            137 => 
            array (
                'id' => 138,
                'sigla' => 'PGFN',
                'nome' => 'Procuradoria Geral da Fazenda Nacional',
                'tipo' => '1',
            ),
            138 => 
            array (
                'id' => 139,
                'sigla' => 'PM',
                'nome' => 'Polícia Militar',
                'tipo' => '2',
            ),
            139 => 
            array (
                'id' => 140,
                'sigla' => 'POLITEC',
                'nome' => 'Perícia Oficial e Identificação Técnica',
                'tipo' => '1',
            ),
            140 => 
            array (
                'id' => 141,
                'sigla' => 'PRF',
                'nome' => 'Polícia Rodoviária Federal',
                'tipo' => '1',
            ),
            141 => 
            array (
                'id' => 142,
                'sigla' => 'PTC',
                'nome' => 'Polícia Tecnico-Científica',
                'tipo' => '1',
            ),
            142 => 
            array (
                'id' => 143,
                'sigla' => 'SCC',
                'nome' => 'Secretaria de Estado da Casa Civil',
                'tipo' => '2',
            ),
            143 => 
            array (
                'id' => 144,
                'sigla' => 'SCJDS',
                'nome' => 'Secretaria Coordenadora de Justiça e Defesa Social',
                'tipo' => '2',
            ),
            144 => 
            array (
                'id' => 145,
                'sigla' => 'SDS',
                'nome' => 'Secretaria de Defesa Social',
                'tipo' => '2',
            ),
            145 => 
            array (
                'id' => 146,
                'sigla' => 'SECC',
                'nome' => 'Secretaria de Estado da Casa Civil',
                'tipo' => '2',
            ),
            146 => 
            array (
                'id' => 147,
                'sigla' => 'SECCDE',
                'nome' => 'Secretaria de Estado da Casa Civil e Desenvolvimento Econômico',
                'tipo' => '2',
            ),
            147 => 
            array (
                'id' => 148,
                'sigla' => 'SEDS',
                'nome' => 'Secretaria de Estado da Defesa Social',
                'tipo' => '2',
            ),
            148 => 
            array (
                'id' => 149,
                'sigla' => 'SEGUP',
                'nome' => 'Secretaria de Estado da Segurança Pública e da Defesa Social',
                'tipo' => '2',
            ),
            149 => 
            array (
                'id' => 150,
                'sigla' => 'SEJSP',
                'nome' => 'Secretaria de Estado de Justiça e Segurança Pública',
                'tipo' => '2',
            ),
            150 => 
            array (
                'id' => 151,
                'sigla' => 'SEJUC',
                'nome' => 'Secretaria de Estado da Justica',
                'tipo' => '2',
            ),
            151 => 
            array (
                'id' => 152,
                'sigla' => 'SEJUSP',
                'nome' => 'Secretaria de Estado de Justiça e Segurança Pública',
                'tipo' => '2',
            ),
            152 => 
            array (
                'id' => 153,
                'sigla' => 'SEPC',
                'nome' => 'Secretaria de Estado da Polícia Civil',
                'tipo' => '2',
            ),
            153 => 
            array (
                'id' => 154,
                'sigla' => 'SES',
                'nome' => 'Secretaria de Estado da Segurança',
                'tipo' => '2',
            ),
            154 => 
            array (
                'id' => 155,
                'sigla' => 'SESC',
                'nome' => 'Secretaria de Estado da Segurança e Cidadania',
                'tipo' => '2',
            ),
            155 => 
            array (
                'id' => 156,
                'sigla' => 'SESDC',
                'nome' => 'Secretaria de Estado da Segurança, Defesa e Cidadania',
                'tipo' => '2',
            ),
            156 => 
            array (
                'id' => 157,
                'sigla' => 'SESDEC',
                'nome' => 'Secretaria de Estado da Segurança, Defesa e Cidadania',
                'tipo' => '2',
            ),
            157 => 
            array (
                'id' => 158,
                'sigla' => 'SESEG',
                'nome' => 'Secretaria Estadual de Segurança',
                'tipo' => '2',
            ),
            158 => 
            array (
                'id' => 159,
                'sigla' => 'SESP',
                'nome' => 'Secretaria de Estado da Segurança Pública',
                'tipo' => '2',
            ),
            159 => 
            array (
                'id' => 160,
                'sigla' => 'SESPAP',
                'nome' => 'Secretaria de Estado da Segurança Pública e Administração Penitenciária',
                'tipo' => '2',
            ),
            160 => 
            array (
                'id' => 161,
                'sigla' => 'SESPDC',
                'nome' => 'Secretaria de Estado de Segurança Publica e Defesa do Cidadão',
                'tipo' => '2',
            ),
            161 => 
            array (
                'id' => 162,
                'sigla' => 'SESPDS',
                'nome' => 'Secretaria de Estado de Segurança Pública e Defesa Social',
                'tipo' => '2',
            ),
            162 => 
            array (
                'id' => 163,
                'sigla' => 'SGPC',
                'nome' => 'Superintendência Geral de Polícia Civil',
                'tipo' => '1',
            ),
            163 => 
            array (
                'id' => 164,
                'sigla' => 'SGPJ',
                'nome' => 'Superintendência Geral de Polícia Judiciária',
                'tipo' => '1',
            ),
            164 => 
            array (
                'id' => 165,
                'sigla' => 'SIM',
                'nome' => 'Serviço de Identificação da Marinha',
                'tipo' => '1',
            ),
            165 => 
            array (
                'id' => 166,
                'sigla' => 'SJ',
                'nome' => 'Secretaria da Justiça',
                'tipo' => '2',
            ),
            166 => 
            array (
                'id' => 167,
                'sigla' => 'SJCDH',
                'nome' => 'Secretaria da Justiça e dos Direitos Humanos',
                'tipo' => '2',
            ),
            167 => 
            array (
                'id' => 168,
                'sigla' => 'SJDS',
                'nome' => 'Secretaria Coordenadora de Justiça e Defesa Social',
                'tipo' => '2',
            ),
            168 => 
            array (
                'id' => 169,
                'sigla' => 'SJS',
                'nome' => 'Secretaria da Justiça e Segurança',
                'tipo' => '2',
            ),
            169 => 
            array (
                'id' => 170,
                'sigla' => 'SJTC',
                'nome' => 'Secretaria da Justiça do Trabalho e Cidadania',
                'tipo' => '2',
            ),
            170 => 
            array (
                'id' => 171,
                'sigla' => 'SJTS',
                'nome' => 'Secretaria da Justiça do Trabalho e Segurança',
                'tipo' => '2',
            ),
            171 => 
            array (
                'id' => 172,
                'sigla' => 'SNJ',
                'nome' => 'Secretaria Nacional de Justiça / Departamento de Estrangeiros',
                'tipo' => '2',
            ),
            172 => 
            array (
                'id' => 173,
                'sigla' => 'SPMAF',
                'nome' => 'Serviço de Polícia Marítima, Aérea e de Fronteiras',
                'tipo' => '2',
            ),
            173 => 
            array (
                'id' => 174,
                'sigla' => 'SPTC',
                'nome' => 'Secretaria de Polícia Técnico-Científica',
                'tipo' => '2',
            ),
            174 => 
            array (
                'id' => 175,
                'sigla' => 'SRDPF',
                'nome' => 'Superintendência Regional do Departamento de Polícia Federal',
                'tipo' => '2',
            ),
            175 => 
            array (
                'id' => 176,
                'sigla' => 'SRF',
                'nome' => 'Receita Federal',
                'tipo' => '1',
            ),
            176 => 
            array (
                'id' => 177,
                'sigla' => 'SRTE',
                'nome' => 'Superintendência Regional do Trabalho',
                'tipo' => '2',
            ),
            177 => 
            array (
                'id' => 178,
                'sigla' => 'SSDC',
                'nome' => 'Secretaria da Segurança, Defesa e Cidadania',
                'tipo' => '2',
            ),
            178 => 
            array (
                'id' => 179,
                'sigla' => 'SSDS',
                'nome' => 'Secretaria da Segurança e da Defesa Social',
                'tipo' => '2',
            ),
            179 => 
            array (
                'id' => 180,
                'sigla' => 'SSI',
                'nome' => 'Secretaria de Segurança e Informações',
                'tipo' => '2',
            ),
            180 => 
            array (
                'id' => 181,
                'sigla' => 'SSP',
                'nome' => 'Secretaria de Segurança Pública',
                'tipo' => '2',
            ),
            181 => 
            array (
                'id' => 182,
                'sigla' => 'SSPCGP',
                'nome' => 'Secretaria de Segurança Pública e Coordenadoria Geral de Perícias',
                'tipo' => '2',
            ),
            182 => 
            array (
                'id' => 183,
                'sigla' => 'SSPDC',
                'nome' => 'Secretaria de Segurança Pública e Defesa do Cidadão',
                'tipo' => '2',
            ),
            183 => 
            array (
                'id' => 184,
                'sigla' => 'SSPDS',
                'nome' => 'Secretaria de Segurança Pública e Defesa Social',
                'tipo' => '2',
            ),
            184 => 
            array (
                'id' => 185,
                'sigla' => 'SSPPC',
                'nome' => 'Secretaria de Segurança Pública Polícia Civil',
                'tipo' => '2',
            ),
            185 => 
            array (
                'id' => 186,
                'sigla' => 'SUSEP',
                'nome' => 'Superintendência de Seguros Privados',
                'tipo' => '1',
            ),
            186 => 
            array (
                'id' => 187,
                'sigla' => 'SUSEPE',
                'nome' => 'Superintendência dos Serviços Penitenciários',
                'tipo' => '2',
            ),
            187 => 
            array (
                'id' => 188,
                'sigla' => 'TJ',
                'nome' => 'Tribunal de Justiça',
                'tipo' => '1',
            ),
            188 => 
            array (
                'id' => 189,
                'sigla' => 'TJAEM',
                'nome' => 'Tribunal Arbitral e Mediação dos Estados Brasileiros',
                'tipo' => '1',
            ),
            189 => 
            array (
                'id' => 190,
                'sigla' => 'TRE',
                'nome' => 'Tribunal Regional Eleitoral',
                'tipo' => '2',
            ),
            190 => 
            array (
                'id' => 191,
                'sigla' => 'TRF',
                'nome' => 'Tribunal Regional Federal',
                'tipo' => '2',
            ),
            191 => 
            array (
                'id' => 192,
                'sigla' => 'TSE',
                'nome' => 'Tribunal Superior Eleitoral',
                'tipo' => '1',
            ),
            192 => 
            array (
                'id' => 193,
                'sigla' => 'XXX',
                'nome' => 'Orgão Estrangeiro',
                'tipo' => '4',
            ),
            193 => 
            array (
                'id' => 194,
                'sigla' => 'ZZZ',
                'nome' => 'Outro',
                'tipo' => '4',
            ),
        ));
        
        
    }
}