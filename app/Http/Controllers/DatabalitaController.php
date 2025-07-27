<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Services\ID3Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DatabalitaController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function doLogin(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $adminEmail = 'anggitmin@gmail.com';
    $adminPassword = 'admin123';

    if ($request->email === $adminEmail && $request->password === $adminPassword) {
        Session::put('is_admin', true);
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Email atau password salah');
    }

    public function logout(){
    Session::forget('is_admin');
    return redirect()->route('login');
    }


    public function index() {
        $balitasNormal = Balita::where('status_gizi', 'Normal')->get();
        $balitasLebih = Balita::where('status_gizi', 'Gizi Lebih')->get();
        $balitasKurang = Balita::where('status_gizi', 'Gizi Kurang')->get();
        $balitasBuruk = Balita::where('status_gizi', 'Gizi Buruk')->get();
        $balitasKosong = Balita::whereNull('status_gizi')->get();

        return view('balita.databalita', compact(
            'balitasNormal', 'balitasLebih', 'balitasKurang', 'balitasBuruk', 'balitasKosong'
        ));
    }

    public function total()
    {
        $balitas = Balita::all(); // <-- kirim semua data balita
        return view('balita.databalita', compact('balitas')); // <-- kirim ke view
    }

    public function byStatus($status)
    {
        $statusFormatted = match ($status) {
            'normal' => 'Normal',
            'gizi-lebih' => 'Gizi Lebih',
            'gizi-kurang' => 'Gizi Kurang',
            'gizi-buruk' => 'Gizi Buruk',
            'belum-klasifikasi' => null,
            default => abort(404)
        };

        $balitas = Balita::when($statusFormatted, function ($query, $statusFormatted) {
            return $query->where('status_gizi', $statusFormatted);
        }, function ($query) {
            return $query->whereNull('status_gizi');
        })->get();

        return view('balita.tabel', [
            'status' => ucfirst(str_replace('-', ' ', $status)),
            'balitas' => $balitas
        ]);
    }

    public function create() {
        return view('balita.create');
    }


    public function destroy($id){
        $balita = Balita::findOrFail($id);
        $balita->delete();

        return redirect()->route('balita.databalita')->with('success', 'Data balita berhasil dihapus');
    }


    public function destroyAll() {
        Balita::truncate(); // Menghapus semua data balita dari tabel
        return redirect()->route('balita.databalita')->with('success', 'Semua data berhasil dihapus.');
    }

    public function import(Request $request) {
        $file = fopen($request->file('csv_file'), 'r');
        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            Balita::create([
                'nama' => $data['nama'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'umur' => $data['umur'],
                'berat' => $data['berat'],
                'tinggi' => $data['tinggi'],
                'status_gizi' => $data['status_gizi'] ?? null,
            ]);
        }

        return redirect()->route('balita.databalita')->with('success', 'Data balita berhasil diimport');
    }



    public function store(Request $request, ID3Service $id3) {
        $data = $request->validate([
           'nama' => 'required',
           'jenis_kelamin' => 'required|in:L,P',
           'umur' => 'required|integer',
           'berat' => 'required|numeric',
           'tinggi' => 'required|numeric',
        ]);

        $balita = Balita::create($data);

        $trainingData = Balita::whereNotNull('status_gizi')->where('id', '!=', $balita->id)->get()->toArray();
        $attributes = ['jenis_kelamin', 'umur', 'berat', 'tinggi'];

        $tree = $id3->buildTree($trainingData, $attributes);
        $hasil = $id3->classify($tree, $balita->toArray());

        $balita->status_gizi = $hasil;
        $balita->save();

        return redirect()->route('balita.databalita')->with('success', 'Data balita berhasil disimpan');
    }


    public function klasifikasi(ID3Service $id3) {
        $trainingData = Balita::whereNotNull('status_gizi')->get()->toArray();
        $testingData = Balita::whereNull('status_gizi')->get();
        $attributes = ['jenis_kelamin', 'umur', 'berat', 'tinggi'];

        $tree = $id3->buildTree($trainingData, $attributes);

        foreach ($testingData as $balita) {
            $classified = $id3->classify($tree, $balita->toArray());
            $balita->status_gizi = $classified;
            $balita->save();
        }

        return redirect()->back()->with('success', 'Data balita berhasil diklasifikasi');
    }


    public function dashboard(ID3Service $id3)
    {
        if (!Session::get('is_admin')) {
        return redirect()->route('login');
        }

        // Data untuk uji akurasi
        $data = Balita::whereNotNull('status_gizi')->get()->toArray();
        $attributes = ['jenis_kelamin', 'umur', 'berat', 'tinggi'];

        $benar = 0;
        $salah = 0;
        $total = count($data);

        if ($total > 0) {
            foreach ($data as $i => $testSample) {
                $training = array_filter($data, fn($key) => $key !== $i, ARRAY_FILTER_USE_KEY);
                $training = array_values($training);
                $tree = $id3->buildTree($training, $attributes);
                $hasil = $id3->classify($tree, $testSample);

                if (strtolower($hasil) === strtolower($testSample['status_gizi'])) {
                    $benar++;
                } else {
                    $salah++;
                }
            }

            $accuracy = round(($benar / $total) * 100, 2);
        } else {
            $accuracy = 0;
        }

        // Statistik status gizi
        $totalData = Balita::count();
        $normal = Balita::where('status_gizi', 'Normal')->count();
        $lebih = Balita::where('status_gizi', 'Gizi Lebih')->count();
        $kurang = Balita::where('status_gizi', 'Gizi Kurang')->count();
        $buruk = Balita::where('status_gizi', 'Gizi Buruk')->count();

        return view('dashboard', compact(
            'total', 'benar', 'salah', 'accuracy',
            'totalData', 'normal', 'lebih', 'kurang', 'buruk'
        ));
    }


}
