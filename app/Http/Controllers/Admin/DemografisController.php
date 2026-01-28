<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demografis;
use Illuminate\Http\Request;

class DemografisController extends Controller
{
    public function edit()
    {
        $demografis = Demografis::firstOrCreate([]);
        return view('admin.demografis.edit', compact('demografis'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jumlah_penduduk' => 'nullable|integer',
            'kepadatan_penduduk' => 'nullable|string',
            'jumlah_laki_laki' => 'nullable|integer',
            'jumlah_perempuan' => 'nullable|integer',
            'jumlah_kk' => 'nullable|integer',
            'jumlah_dusun' => 'nullable|integer',
            'jumlah_rw' => 'nullable|integer',
            'jumlah_rt' => 'nullable|integer',
            'tingkat_pendidikan' => 'nullable|array',
            'tingkat_pendidikan.mode' => 'required_with:tingkat_pendidikan|in:percentage,number',
            'tingkat_pendidikan.sd' => 'required_with:tingkat_pendidikan|numeric|min:0',
            'tingkat_pendidikan.smp' => 'required_with:tingkat_pendidikan|numeric|min:0',
            'tingkat_pendidikan.sma' => 'required_with:tingkat_pendidikan|numeric|min:0',
            'tingkat_pendidikan.pt' => 'required_with:tingkat_pendidikan|numeric|min:0',
            'mata_pencaharian' => 'nullable|array',
            'mata_pencaharian.mode' => 'required_with:mata_pencaharian|in:percentage,number',
            'mata_pencaharian.data' => 'nullable|array',
            'mata_pencaharian.data.*.name' => 'required|string',
            'mata_pencaharian.data.*.amount' => 'required|numeric|min:0',
            'agama' => 'nullable|array',
            'agama.mode' => 'required_with:agama|in:percentage,number',
            'agama.islam' => 'required_with:agama|numeric|min:0',
            'agama.kristen' => 'required_with:agama|numeric|min:0',
            'agama.katolik' => 'required_with:agama|numeric|min:0',
            'agama.hindu' => 'required_with:agama|numeric|min:0',
            'agama.buddha' => 'required_with:agama|numeric|min:0',
            'agama.konghucu' => 'required_with:agama|numeric|min:0',
        ]);

        // Logic Consistency for Population Data
        $pendudukMode = $request->input('penduduk_mode', 'total');
        $inputs = $request->all();

        if ($pendudukMode === 'total') {
            // If inputting total, split equally
            $total = (int) $request->input('jumlah_penduduk', 0);
            $half = floor($total / 2);
            $remainder = $total % 2;

            $inputs['jumlah_laki_laki'] = $half + $remainder;
            $inputs['jumlah_perempuan'] = $half;
        } else {
            // If inputting details, sum them up
            $laki = (int) $request->input('jumlah_laki_laki', 0);
            $perempuan = (int) $request->input('jumlah_perempuan', 0);

            $inputs['jumlah_penduduk'] = $laki + $perempuan;
        }
        if ($request->has('tingkat_pendidikan') && $request->input('tingkat_pendidikan.mode') === 'percentage') {
            $total = array_sum([
                $request->input('tingkat_pendidikan.sd', 0),
                $request->input('tingkat_pendidikan.smp', 0),
                $request->input('tingkat_pendidikan.sma', 0),
                $request->input('tingkat_pendidikan.pt', 0),
            ]);

            if ($total > 100) {
                return back()->withErrors(['tingkat_pendidikan' => 'Total persentase tingkat pendidikan tidak boleh lebih dari 100%. Total saat ini: ' . $total . '%'])->withInput();
            }
        }

        // Custom Validation for Percentage Mode (Mata Pencaharian)
        if ($request->has('mata_pencaharian') && $request->input('mata_pencaharian.mode') === 'percentage') {
            $data = $request->input('mata_pencaharian.data', []);
            $total = 0;
            foreach ($data as $item) {
                $total += $item['amount'] ?? 0;
            }

            if ($total > 100) {
                return back()->withErrors(['mata_pencaharian' => 'Total persentase mata pencaharian tidak boleh lebih dari 100%. Total saat ini: ' . $total . '%'])->withInput();
            }
        }

        // Custom Validation for Percentage Mode (Agama)
        if ($request->has('agama') && $request->input('agama.mode') === 'percentage') {
            $total = array_sum([
                $request->input('agama.islam', 0),
                $request->input('agama.kristen', 0),
                $request->input('agama.katolik', 0),
                $request->input('agama.hindu', 0),
                $request->input('agama.buddha', 0),
                $request->input('agama.konghucu', 0),
            ]);

            if ($total > 100) {
                return back()->withErrors(['agama' => 'Total persentase agama tidak boleh lebih dari 100%. Total saat ini: ' . $total . '%'])->withInput();
            }
        }

        // --- NEW VALIDATION: Number Limit Check ---
        $populationLimit = $inputs['jumlah_penduduk'];

        // 1. Validation for Number Mode (Tingkat Pendidikan)
        if ($request->has('tingkat_pendidikan') && $request->input('tingkat_pendidikan.mode') === 'number') {
            $total = array_sum([
                $request->input('tingkat_pendidikan.sd', 0),
                $request->input('tingkat_pendidikan.smp', 0),
                $request->input('tingkat_pendidikan.sma', 0),
                $request->input('tingkat_pendidikan.pt', 0),
            ]);

            if ($total > $populationLimit) {
                return back()->withErrors(['tingkat_pendidikan' => 'Total jumlah tingkat pendidikan (' . number_format($total) . ') tidak boleh melebihi jumlah penduduk (' . number_format($populationLimit) . ').'])->withInput();
            }
        }

        // 2. Validation for Number Mode (Mata Pencaharian)
        if ($request->has('mata_pencaharian') && $request->input('mata_pencaharian.mode') === 'number') {
            $data = $request->input('mata_pencaharian.data', []);
            $total = 0;
            foreach ($data as $item) {
                $total += $item['amount'] ?? 0;
            }

            if ($total > $populationLimit) {
                return back()->withErrors(['mata_pencaharian' => 'Total jumlah mata pencaharian (' . number_format($total) . ') tidak boleh melebihi jumlah penduduk (' . number_format($populationLimit) . ').'])->withInput();
            }
        }

        // 3. Validation for Number Mode (Agama)
        if ($request->has('agama') && $request->input('agama.mode') === 'number') {
            $total = array_sum([
                $request->input('agama.islam', 0),
                $request->input('agama.kristen', 0),
                $request->input('agama.katolik', 0),
                $request->input('agama.hindu', 0),
                $request->input('agama.buddha', 0),
                $request->input('agama.konghucu', 0),
            ]);

            if ($total > $populationLimit) {
                return back()->withErrors(['agama' => 'Total jumlah agama (' . number_format($total) . ') tidak boleh melebihi jumlah penduduk (' . number_format($populationLimit) . ').'])->withInput();
            }
        }

        $demografis = Demografis::firstOrCreate([]);
        $demografis->update($inputs);

        return redirect()->route('admin.demografis.edit')->with('success', 'Data Demografis berhasil diupdate.');
    }
}
