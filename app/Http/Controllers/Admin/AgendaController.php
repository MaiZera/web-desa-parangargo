<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('admin.agendas.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agendas.create');
    }

    public function store(Request $request)
    {
        \Log::info('Agenda Store - DEBUG START', [
            'post_keys' => array_keys($_POST),
            'files_keys' => array_keys($_FILES),
            'has_file_in_request' => $request->hasFile('gambar')
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if (!$file->isValid()) {
                $errorMsg = match($file->getError()) {
                    1 => 'Ukuran file melebihi batas upload server (upload_max_filesize di php.ini).',
                    2 => 'Ukuran file melebihi batas form HTML.',
                    3 => 'File hanya terupload sebagian.',
                    4 => 'Tidak ada file yang terupload.',
                    6 => 'Folder sementara (tmp) tidak ditemukan di server.',
                    7 => 'Gagal menulis file ke disk.',
                    default => 'Gagal upload: ' . $file->getErrorMessage()
                };
                return back()->withErrors(['gambar' => $errorMsg])->withInput();
            }
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'nullable|string|max:255',
            'narahubung' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'status' => 'required|in:scheduled,ongoing,completed',
            'is_featured' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('agendas', 'public');
        }

        Agenda::create($validated);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        \Log::info('Agenda Update - DEBUG START', [
            'post_keys' => array_keys($_POST),
            'files_keys' => array_keys($_FILES),
            'has_file_in_request' => $request->hasFile('gambar')
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if (!$file->isValid()) {
                $errorMsg = match($file->getError()) {
                    1 => 'Ukuran file melebihi batas upload server (upload_max_filesize di php.ini).',
                    2 => 'Ukuran file melebihi batas form HTML.',
                    3 => 'File hanya terupload sebagian.',
                    4 => 'Tidak ada file yang terupload.',
                    6 => 'Folder sementara (tmp) tidak ditemukan di server.',
                    7 => 'Gagal menulis file ke disk.',
                    default => 'Gagal upload: ' . $file->getErrorMessage()
                };
                return back()->withErrors(['gambar' => $errorMsg])->withInput();
            }
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'nullable|string|max:255',
            'narahubung' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'is_featured' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('agendas', 'public');
        }

        // Auto Status Logic
        $now = now();
        $start = \Illuminate\Support\Carbon::parse($request->tanggal_mulai);
        $end = $request->tanggal_selesai ? \Illuminate\Support\Carbon::parse($request->tanggal_selesai) : null;

        if ($end && $now->greaterThan($end)) {
            $validated['status'] = 'completed';
        } elseif ($now->greaterThan($start)) {
            $validated['status'] = 'ongoing';
        } else {
            $validated['status'] = 'scheduled';
        }

        $agenda->update($validated);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil diperbarui. Status diperbarui secara otomatis.');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }
        $agenda->delete();
        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
