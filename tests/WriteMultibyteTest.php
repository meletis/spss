<?php

namespace SPSS\Tests;

use SPSS\Sav\Variable;
use SPSS\Sav\Writer;

class WriteMultibyteTest extends TestCase
{

//    public function testMultiByteLabel()
//    {
//        $data   = [
//            'header'    => [
//                'prodName'     => '@(#) IBM SPSS STATISTICS',
//                'layoutCode'   => 2,
//                'creationDate' => date('d M y'),
//                'creationTime' => date('H:i:s'),
//            ],
//            'variables' => [
//                [
//                    'name'   => 'longname_longerthanexpected',
//                    'label'  => 'Data zákończenia',
//                    'width'  => 16,
//                    'format' => 1,
//                ],
//                [
//                    'name'   => 'ccc',
//                    'label'  => 'áá345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901233á',
//                    'format' => 5,
//                    'values' => [
//                        1 => 'áá345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901233á',
//                    ],
//                ],
//            ],
//        ];
//        $writer = new Writer($data);
//
//        $buffer = $writer->getBuffer();
//        $buffer->rewind();
//
//        $reader = Reader::fromString($buffer->getStream())->read();
//
//        // Short variable label
//        $this->assertEquals($data['variables'][0]['label'], $reader->variables[0]->label);
//
//        // Long variable label
//        $this->assertEquals(mb_substr($data['variables'][1]['values'][1], 0, -2, 'UTF-8'), $reader->variables[1]->label);
//
//        // Long value label
//        $this->assertEquals(mb_substr($data['variables'][1]['label'], 0, -2, 'UTF-8'), $reader->valueLabels[0]->labels[0]['label']);
//    }
    
    /**
     * ISSUE #20
     * 
     * Chinese value labels seem to work fine, but free text does not work
     */
    public function testChinese()
    {
        $input = [
            'header'    => [
                'prodName'     => '@(#) SPSS DATA FILE - SurveyCTO',
                'creationDate' => '05 Oct 18',
                'creationTime' => '01:36:53',
                'weightIndex'  => 0,
            ],
            'variables' => [
                [
                    'name' => 'decimalVariable',
                    'format' => Variable::FORMAT_TYPE_F,
                    'width' => 15,
                    'decimals' => 0,
                    'label' => 'Decimal variable',
                    'values' => [
                        1 => "choice 1",
                        200000000 => "choice 2"
                    ],
                    'columns' => 10,
                    'alignment' => Variable::ALIGN_RIGHT,
                    'measure' => Variable::MEASURE_SCALE,
                    'attributes' => [
                        '$@Role' => Variable::ROLE_NONE,
                    ],
                    'data' => [
                    ],
                ],
                [
                    'name' => 'review_comments',
                    'format' => Variable::FORMAT_TYPE_A,
                    'width' => 500,
                    'label' => 'review_comments',
                    'columns' => 10,
                    'alignment' => Variable::ALIGN_LEFT,
                    'measure' => Variable::MEASURE_NOMINAL,
                    'attributes' => [
                        '$@Role' => Variable::ROLE_NONE,
                    ],
                    'data' => [
                    ],
                ],
            ],
        ];

        echo PHP_EOL;
        echo PHP_EOL;
        echo PHP_EOL;

        $writer = new Writer($input);
        
        // Uncomment if you want to really save and check the resulting file in SPSS
//        $writer->save('long_var_php.sav');
        $writer->save('huge_php_broken.sav');
//        $buffer = $writer->getBuffer();
//        $buffer->rewind();
//
//        $reader = Reader::fromString($buffer->getStream())->read();
//        $expected[0][0] = $input['variables'][0]['data'][0];
//        $expected[0][1] = $input['variables'][1]['data'][0];
//        $expected[1][0] = $input['variables'][0]['data'][1];
//        $expected[1][1] = $input['variables'][1]['data'][1];
//        $expected[2][0] = $input['variables'][0]['data'][2];
//        $expected[2][1] = $input['variables'][1]['data'][2];
//        $this->assertEquals($expected, $reader->data);
    }

}
