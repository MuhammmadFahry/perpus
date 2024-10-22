<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Historybooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorybooksController extends Controller
{
    public function tambahhistorybook(Request $request)
    {
        // dd('berhasil', $request->all());
        Historybooks::create([
            'user_id'=> Auth::id(),
            'book_id'=> $request->book_id,
            'tanggal_dipinjam' => $request->tanggal_dipinjam
        ]);
        // $buku_yang_dipinjam = Borrowing::where('book_id', $request->book_id)->where('user_id', Auth::id())->first();
        $buku_yang_dipinjam = Borrowing::where('id', $request->id)->where('user_id', Auth::id())->first();
        $buku_yang_dipinjam->delete();
        return redirect()->back();
    }

    public function historypeminjamansemuauser(Request $request)
    {
        $historysemuanya=Historybooks::all();
        return view('admin.borrowHistory',[
            'historysemuanya'=>$historysemuanya
        ]);
    }
}
