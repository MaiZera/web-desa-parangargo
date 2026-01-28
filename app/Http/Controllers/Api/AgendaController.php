<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $events = collect();

        // 1. Fetch Local Events
        $query = Agenda::query();
        
        // FullCalendar sends 'start' and 'end' parameters (ISO strings)
        if ($request->filled('start') && $request->filled('end')) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
            
            $query->where(function($q) use ($start, $end) {
                $q->whereBetween('tanggal_mulai', [$start, $end])
                  ->orWhereBetween('tanggal_selesai', [$start, $end])
                  // Include events that span across the range
                  ->orWhere(function($sub) use ($start, $end) {
                      $sub->where('tanggal_mulai', '<', $start)
                          ->where('tanggal_selesai', '>', $end);
                  });
            });
        }
        
        $localEvents = $query->orderBy('tanggal_mulai')->get();

        foreach ($localEvents as $agenda) {
             $className = 'bg-emerald-600 border-emerald-700';
             if ($agenda->is_featured) {
                 $className = 'bg-amber-500 border-amber-600'; // Highlight color (Gold/Amber)
             }

             $events->push([
                'id' => 'local_' . $agenda->id,
                'title' => ($agenda->is_featured ? '⭐ ' : '') . $agenda->judul, // Add star icon
                'start' => $agenda->tanggal_mulai ? $agenda->tanggal_mulai->toIso8601String() : null,
                'end' => $agenda->tanggal_selesai ? $agenda->tanggal_selesai->toIso8601String() : null,
                'className' => $className,
                'extendedProps' => [
                    'location' => $agenda->lokasi,
                    'description' => $agenda->deskripsi,
                    'source' => 'local',
                    'is_featured' => $agenda->is_featured,
                    'gambar' => $agenda->gambar ? (str_starts_with($agenda->gambar, 'http') ? $agenda->gambar : asset('storage/' . $agenda->gambar)) : null,
                    'penyelenggara' => $agenda->penyelenggara,
                    'narahubung' => $agenda->narahubung,
                    'telepon' => $agenda->telepon,
                    'tanggal_mulai_formatted' => $agenda->tanggal_mulai ? $agenda->tanggal_mulai->translatedFormat('d F Y, H:i') : null,
                    'tanggal_selesai_formatted' => $agenda->tanggal_selesai ? $agenda->tanggal_selesai->translatedFormat('d F Y, H:i') : null,
                ]
            ]);
        }

        // 2. Fetch Indonesian Holidays (Tanggal Merah)
        try {
            $year = $request->start ? Carbon::parse($request->start)->year : now()->year;
            
            // Cache for 1 day to avoid rate limiting
            $holidays = Cache::remember("holidays_{$year}", 86400, function () use ($year) {
                // Using a public API for Indonesian holidays
                $response = Http::timeout(3)->get("https://dayoffapi.vercel.app/api?year={$year}");
                return $response->json();
            });

            if (is_array($holidays)) {
                foreach ($holidays as $holiday) {
                    if (isset($holiday['tanggal']) && isset($holiday['keterangan'])) {
                        $events->push([
                            'id' => 'holiday_' . $holiday['tanggal'],
                            'title' => $holiday['keterangan'],
                            'start' => $holiday['tanggal'],
                            'allDay' => true,
                            'className' => 'bg-red-500 border-red-600 text-white', // Red for holidays
                            'display' => 'block',
                            'extendedProps' => [
                                'description' => 'Libur Nasional',
                                'source' => 'holiday'
                            ]
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning('Holiday API Fetch Failed: ' . $e->getMessage());
        }

        // 3. Fetch Google Calendar Events
        // Only run if package is installed and config is present
        if (class_exists(\Spatie\GoogleCalendar\Event::class) && config('google-calendar.calendar_id')) {
            try {
                // Determine range for Google fetch
                $gStart = $request->start ? Carbon::parse($request->start) : now()->startOfMonth();
                $gEnd = $request->end ? Carbon::parse($request->end) : now()->endOfMonth();

                // Start searching from Google
                $googleEvents = \Spatie\GoogleCalendar\Event::get($gStart, $gEnd);

                foreach ($googleEvents as $event) {
                    $events->push([
                        'id' => $event->id,
                        'title' => $event->name,
                        'start' => $event->startDateTime ? $event->startDateTime->toIso8601String() : null,
                        'end' => $event->endDateTime ? $event->endDateTime->toIso8601String() : null,
                        'className' => 'bg-blue-600 border-blue-700', // Distinct color for Google events
                        'extendedProps' => [
                            'location' => $event->location,
                            'description' => $event->description,
                            'source' => 'google'
                        ]
                    ]);
                }
            } catch (\Exception $e) {
                // Log the error but don't break the response so local events still load
                Log::warning('Google Calendar Fetch Failed: ' . $e->getMessage());
            }
        }
        
        // Return directly as array (FullCalendar expects array of objects)
        return response()->json($events);
    }

    public function upcoming()
    {
        $agendas = Agenda::where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai', 'asc')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $agendas->map(function ($agenda) {
                return [
                    'id' => $agenda->id,
                    'title' => $agenda->judul,
                    'day' => $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('d') : '-',
                    'month' => $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('M') : '-',
                    'time' => $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('H:i') . ($agenda->tanggal_selesai ? ' - ' . $agenda->tanggal_selesai->format('H:i') : '') : '-',
                    'location' => $agenda->lokasi,
                ];
            })
        ]);
    }
}
