<?php

namespace App\Exports\Admin\Countries;

// use App\Models\User as ModelsUser;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CountriesUsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public $country_id; 

    public function __construct($country_id)
    {
        $this->country_id = $country_id;
    }

    public function headings(): array
    {
        
        return [
            ['Users Data'],
            [
                'First Name',
                'Last Name',
                'Mail',
                'Phone',
                'Gender',
                'Country',
                'Role',
                'Visit Num.',
            ]
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::where('country_id', $this->country_id)->get();
    }

    public function map($user): array
    {
        return [
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->phone ? $user->phone : 'N/A',
            $user->gender == 1 ? 'Male' : 'Female',
            $user->country->name,
            $user->getRoleNames()->first(),
            $user->visit_num ?: "0",
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:H1');
        $sheet->getDefaultRowDimension()->setRowHeight(25);
        $sheet->getPageSetup()->setOrientation('landscape');



        return [
            '1:2' => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'ffffff'
                    ]
                ]
            ],

            1 => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => 'd35400',
                    ]
                ]
            ],

            2 => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => 'e67e22',
                    ]
                ]
            ],

            'A:H' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],

            ],

            'A' => [
                'font' => ['bold' => true]
            ],
        ];
    }
}
