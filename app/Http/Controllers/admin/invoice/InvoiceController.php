<?php

namespace App\Http\Controllers\admin\invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pendingInvoiceindex()
    {
        // dd('here');
        $invoices = Invoice::where('status', 'Pending')->get();
        return view('admin.invoices.pendingInvoices', compact('invoices'));
    }


    public function paidInvoices()
    {
        $invoices = Invoice::where('status', 'Paid')->get();
        return view('admin.invoices.paidInvoices', compact('invoices'));
    }

    public function overDueInvoices()
    {
        $invoices = Invoice::where('status', 'Overdue')->get();
        return view('admin.invoices.overDueInvoices', compact('invoices'));
    }

    public function destroyInvoice(Request $request)
    {
        $invoice = Invoice::find($request->id);

        if ($invoice) {
            if ($invoice->status === 'Paid') {
                Toastr::error('Cannot delete a Paid invoice.');
            } else {
                // dd($request);
                $invoice->delete();
                Toastr::success('Invoice successfully deleted!');
            }
        } else {
            Toastr::error('Invoice not found or already deleted.');
        }

        return back();
    }
}
