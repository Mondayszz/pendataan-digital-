<?php

namespace App\Exports;

use App\Models\Kk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class KkExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $jaga;

    public function __construct($jaga = null)
    {
        $this->jaga = $jaga;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Kk::with('penduduks');
        
        if ($this->jaga) {
            $query->where('jaga', $this->jaga);
        }
        
        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID KK',
            'Kepala Keluarga',
            'Alamat',
            'Jaga',
            'Jumlah Anggota',
            'Nama Anggota',
            'NIK',
            'Status Keluarga',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Umur',
            'Pendidikan',
            'Pekerjaan',
            'Status Perkawinan'
        ];
    }

    /**
     * @param mixed $kk
     * @return array
     */
    public function map($kk): array
    {
        $rows = [];
        
        if ($kk->penduduks->isEmpty()) {
            $rows[] = [
                $kk->id,
                $kk->kepala_keluarga,
                $kk->alamat,
                $kk->jaga ?: '-',
                0,
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-',
                '-'
            ];
        } else {
            foreach ($kk->penduduks as $index => $penduduk) {
                $rows[] = [
                    $index === 0 ? $kk->id : '',
                    $index === 0 ? $kk->kepala_keluarga : '',
                    $index === 0 ? $kk->alamat : '',
                    $index === 0 ? ($kk->jaga ?: '-') : '',
                    $index === 0 ? $kk->penduduks->count() : '',
                    $penduduk->nama,
                    $penduduk->nik,
                    $penduduk->status_keluarga ?: '-',
                    $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y'),
                    \Carbon\Carbon::parse($penduduk->tanggal_lahir)->age . ' tahun',
                    $penduduk->pendidikan ?: '-',
                    $penduduk->pekerjaan ?: '-',
                    $penduduk->status_perkawinan ?: '-'
                ];
            }
        }
        
        return $rows;
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
                    'startColor' => ['rgb' => '343a40'],
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
        ];
    }
}
