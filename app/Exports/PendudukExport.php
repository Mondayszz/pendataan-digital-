<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PendudukExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penduduk::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'NIK',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Pekerjaan',
            'Umur',
            'Status',
            'Agama',
            'Pendidikan',
            'Jaga',
            'Created At',
            'Updated At'
        ];
    }

    /**
     * @param mixed $penduduk
     * @return array
     */
    public function map($penduduk): array
    {
        return [
            $penduduk->id,
            $penduduk->nama,
            $penduduk->nik,
            $penduduk->tanggal_lahir->format('d-m-Y'),
            $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $penduduk->alamat,
            $penduduk->pekerjaan ?: '-',
            $penduduk->umur ? $penduduk->umur . ' tahun' : '-',
            $penduduk->status_perkawinan ?: '-',
            $penduduk->agama ?: '-',
            $penduduk->pendidikan ?: '-',
            $penduduk->jaga ?: '-',
            $penduduk->created_at->format('d-m-Y H:i:s'),
            $penduduk->updated_at->format('d-m-Y H:i:s'),
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        return [
            // Style untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F81BD'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],

            // Style untuk data rows
            'A2:N'.$lastRow => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],

            // Auto-size columns dengan spacing yang lebih luas
            'A' => ['width' => 12],
            'B' => ['width' => 35],
            'C' => ['width' => 30],
            'D' => ['width' => 22],
            'E' => ['width' => 22],
            'F' => ['width' => 40],
            'G' => ['width' => 30],
            'H' => ['width' => 15],
            'I' => ['width' => 30],
            'J' => ['width' => 22],
            'K' => ['width' => 30],
            'L' => ['width' => 22],
            'M' => ['width' => 25],
            'N' => ['width' => 25],
        ];
    }
}
