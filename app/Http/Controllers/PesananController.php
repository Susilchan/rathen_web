<?php

namespace App\Http\Controllers;

use App\Models\ModelStep1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PesananController extends Controller
{
    public function form_1(Request $request)
    {
        $data = DB::table('tbl_step1')->get('*');


        return view('landing_page.form-order', [
            'pesanan' => $data,
        ]);
    }
    public function form_2(Request $request)
    {
        $data = DB::table('tbl_step2')->get('*');


        return view('landing_page.form-2', [
            'pesanan' => $data,
        ]);
    }
    public function form_3(Request $request)
    {
        $data = DB::table('tbl_step3')->get('*');


        return view('landing_page.form-3', [
            'pesanan' => $data,
        ]);
    }
    public function form_4(Request $request)
    {
        $data = DB::table('tbl_data_pesanan')->get('*');


        return view('landing_page.form-4', [
            'pesanan' => $data,
        ]);
    }

    // ================================ add ==================================
    public function addForm1(Request $request)
    {
        $nm = $request->nama_tim;
        $dm = $request->dom;
        $np = $request->np;
        $nw = $request->nw;
        $ap = $request->alamat_p;
        $jp = $request->jp;
        $kt = $request->kategori;
        $kl = $request->kualitas;
        $ud = $request->up3d;
        $lc = $request->logo_celana;
        $lp = $request->lengan_panjang;
        $xxl = $request->xxl;
        $xxxl = $request->xxxl;
        $xxxxl = $request->xxxxl;
        $cp = $request->celana_panjang;
        $kk = $request->kaoskaki;
        $cookie = $request->cookie;

        $str = Str::random(12);
        $data = ModelStep1::create([
            'kd_pembelian' => 'R' . $str,
            'nama_tim' => $nm,
            'domisili' => $dm,
            'nama_pemesanan' => $np,
            'kontak' => $nw,
            'alamat_pengirim' => $ap,
            'jumlah_pemesanan' => $jp,
            'kategori_harga' => $kt,
            'kualitas' => $kl,
            'upgrade_logo_3d' => $ud,
            'logo_tim_dicelana' => $lc,
            'lengan_panjang' => $lp,
            'size_2xl' => $xxl,
            'size_3xl' => $xxxl,
            'size_4xl' => $xxxxl,
            'celana_panjang' => $cp,
            'kaoskaki' => $kk,
        ]);
        return redirect('/form-2');
    }
    public function invoice(Request $request)
    {
        $data = DB::table('tbl_step1')
            ->join('tbl_step2', 'tbl_step1.kd_step2', '=', 'tbl_step2.kd_step2')
            ->join('tbl_step3', 'tbl_step1.kd_step3', '=', 'tbl_step3.kd_step3')
            ->select('tbl_step1.*', 'tbl_step2.*', 'tbl_step3.*')
            ->get();
        foreach ($data as $pesanan) {

            return view('landing_page.invoice', [
                'data' => $pesanan,
            ]);
        }
    }
    public function tambahDataPesanan(Request $request)
    {
        $np = $request->namaPunggung;
        $no = $request->nomor;
        $uk = $request->ukuran;
        $data = DB::table('tbl_data_pesanan')->get();
        // dd($np, $no, $uk);

        $insert =  DB::table('tbl_data_pesanan')->insert([
            'namapunggung' => $np,
            'nomor' => $no,
            'ukuran' => $uk,
        ]);

        return redirect()->back();
    }
}