<?php

namespace App\Http\Controllers;

use App\Http\Services\ApprovalService;
use App\Models\Approval;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    private $approvalSvc;

    public function __construct()
    {
        $this->approvalSvc = new ApprovalService();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        try {
            $approval = Approval::where('approver_id', '=', auth()->user()->user_id)->where('reservation_id','=',$reservation->reservation_id)->first();

            if (!$approval)
            {
                throw new \Exception("Persetujuan tidak dapat ditemukan");
            }

            $this->approvalSvc->update($request, $approval);

            return redirect()->back()->with('success', 'Successfully update approval');

        } catch(\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        //
    }

}
