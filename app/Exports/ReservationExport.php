<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReservationExport implements WithHeadings, FromCollection, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $reservations = Reservation::with([
            'approvals',
            'approvals.approver',
            'vehicle',
            'driver',
            'mine',
            'admin'
        ])->get();

        foreach($reservations as $reservation)
        {
            $reservation['vehicle_id'] = $reservation->vehicle->vehicle_name;
            $reservation['admin_id'] = $reservation->admin->fullname;
            $reservation['mine_id'] = $reservation->mine->mine_name;
            $reservation['driver_id'] = $reservation->driver->fullname;

            $isRejected = $reservation->approvals->contains('status', 'Rejected');

            if ($isRejected)
            {
                $reservation['status'] = "Rejected";
                continue;
            }

            $isApproved = $reservation->approvals->every('status', 'Approved');

            if ($isApproved)
            {
                $reservation['status'] = "Approved";
                continue;
            }

            $reservation['status'] = "Pending";
        }


        return $reservations;
    }

    public function styles($sheet)
    {
        // Style the header row (bold and centered)
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:J1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:J1')->getFill()->getStartColor()->setRGB('DDDDDD'); // Set header background color
    }

    public function headings(): array
    {
        return [
            'ID Pemesanan',
            'Nama Kendaraan',
            'Nama Pemesan',
            'Tempat Tambang',
            'Nama Pengemudi',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Tanggal Pengajuan',
            'Tanggal Perbarui',
            'Status'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $event->sheet->freezePane('A2');

                // Apply border to all cells
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)
                      ->getBorders()
                      ->getAllBorders()
                      ->setBorderStyle(Border::BORDER_THIN);


                $event->sheet->getStyle('A1:' . $highestColumn . $highestRow)->getAlignment()->setHorizontal('center');
            },
        ];
    }
}
