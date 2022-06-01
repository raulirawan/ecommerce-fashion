<?php

namespace App\Http\Controllers\Admin;

use App\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaksi::query();
                    $query->with(['user'])
                          ->whereDate('created_at', $request->from_date);
                } else {
                    $query  = Transaksi::query();
                    $query->with(['user'])
                            ->whereBetween('created_at', [$request->from_date.' 00:00:00', $request->to_date.' 23:59:59']);
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaksi::query();
                $query->with(['user'])
                    ->whereDate('created_at', $today);
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="'.route('admin.transaksi.detail', $item->id).'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Detail</a>
                    <button
                    id="edit"
                    data-toggle="modal"
                    data-target="#modal-edit"
                    class="btn btn-primary btn-sm"
                    data-id="'.$item->id.'"
                    data-status="'.$item->status.'"
                    >Edit</button> ';
                })
                ->editColumn('status', function ($item) {
                    if($item->status == 'SUCCESS'){
                        return '<span class="badge badge-success">SUCCESS</span>';
                    } elseif($item->status == 'PENDING') {
                        return '<span class="badge badge-warning">PENDING</span>';
                    }
                    else {
                        return '<span class="badge badge-danger">CANCELLED</span>';
                    }
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at;
                })

                ->rawColumns(['action','status'])
                ->make();
        }
        return view('admin.transaksi.index');
    }
    public function update(Request $request, $id)
    {
        $data = Transaksi::findOrFail($id);

        $data->status = $request->status;
        $data->save();

        if($data != null) {
            return redirect()->route('admin.transaksi.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.transaksi.index')->with('error','Data Gagal di Update');
        }
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with(['detail','user'])->findOrFail($id);
        return view('admin.transaksi.detail', compact('transaksi'));
    }
}
