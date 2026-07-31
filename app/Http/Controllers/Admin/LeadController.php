<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadTag;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with(['assignedAgent', 'tags'])->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by search (name / phone)
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('company', 'like', "%{$s}%");
            });
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('lead_tags.id', $request->tag));
        }

        // Filter by agent
        if ($request->filled('agent')) {
            $query->where('assigned_to', $request->agent);
        }

        // Filter overdue followups
        if ($request->boolean('overdue')) {
            $query->needsFollowup();
        }

        $leads   = $query->paginate(20)->withQueryString();
        $agents  = User::where('is_admin', true)->get();
        $tags    = LeadTag::all();
        $statuses = Lead::$statusLabels;

        // Stats for mini dashboard
        $stats = [
            'total'     => Lead::count(),
            'new'       => Lead::where('status', 'new')->count(),
            'won'       => Lead::where('status', 'won')->count(),
            'lost'      => Lead::where('status', 'lost')->count(),
            'overdue'   => Lead::needsFollowup()->count(),
        ];

        return view('admin.leads.index', compact('leads', 'agents', 'tags', 'statuses', 'stats'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status'      => 'sometimes|in:new,contacted,proposal,closing,won,lost',
            'notes'       => 'sometimes|nullable|string|max:5000',
            'assigned_to' => 'sometimes|nullable|exists:users,id',
            'followup_at' => 'sometimes|nullable|date',
        ]);

        // If marking as contacted, set last_contacted_at
        if (isset($validated['status']) && $validated['status'] === 'contacted') {
            $validated['last_contacted_at'] = now();
        }

        $lead->update($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'lead' => $lead->fresh(['assignedAgent', 'tags'])]);
        }

        return redirect()->back()->with('success', 'Lead diperbarui.');
    }

    public function addTag(Request $request, Lead $lead)
    {
        $request->validate(['tag_id' => 'required|exists:lead_tags,id']);
        $lead->tags()->syncWithoutDetaching([$request->tag_id]);
        return response()->json(['success' => true, 'tags' => $lead->fresh()->tags]);
    }

    public function removeTag(Request $request, Lead $lead)
    {
        $request->validate(['tag_id' => 'required|exists:lead_tags,id']);
        $lead->tags()->detach($request->tag_id);
        return response()->json(['success' => true]);
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead berhasil dihapus.');
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Lead::with(['assignedAgent', 'tags'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%{$s}%")->orWhere('phone', 'like', "%{$s}%"));
        }

        $leads = $query->get();

        $filename = 'leads_hvm_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($leads) {
            $out = fopen('php://output', 'w');
            // BOM for Excel UTF-8
            fputs($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Tanggal', 'Nama', 'No WA', 'Perusahaan', 'Kebutuhan', 'Status', 'Agent', 'Tags', 'Followup At', 'Sumber URL', 'Catatan']);
            foreach ($leads as $l) {
                fputcsv($out, [
                    $l->created_at->format('d/m/Y H:i'),
                    $l->name,
                    $l->phone,
                    $l->company ?? '',
                    $l->needs,
                    $l->status_label,
                    $l->assignedAgent?->name ?? '',
                    $l->tags->pluck('name')->join(', '),
                    $l->followup_at?->format('d/m/Y H:i') ?? '',
                    $l->source_url ?? '',
                    $l->notes ?? '',
                ]);
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function analytics()
    {
        $statuses   = Lead::$statusLabels;
        $statusColors = Lead::$statusColors;

        // Leads per month (last 12 months)
        $monthly = Lead::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Status distribution
        $byStatus = Lead::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        // Top sources
        $bySources = Lead::selectRaw("
            CASE
                WHEN source_url LIKE '%/jasa-website-%' THEN 'Landing Page Kota'
                WHEN source_url LIKE '%/layanan/%' THEN 'Halaman Layanan'
                WHEN source_url LIKE '%/artikel/%' THEN 'Artikel Blog'
                WHEN source_url LIKE '%/portfolio%' THEN 'Portfolio'
                WHEN source_url = '' OR source_url IS NULL THEN 'Direct / Unknown'
                ELSE 'Halaman Lain'
            END as source_group,
            COUNT(*) as total
        ")
            ->groupBy('source_group')
            ->orderByDesc('total')
            ->get();

        // Total KPIs
        $total      = Lead::count();
        $won        = Lead::where('status', 'won')->count();
        $lost       = Lead::where('status', 'lost')->count();
        $convRate   = $total > 0 ? round(($won / $total) * 100, 1) : 0;
        $overdue    = Lead::needsFollowup()->count();

        return view('admin.leads.analytics', compact(
            'monthly', 'byStatus', 'bySources',
            'total', 'won', 'lost', 'convRate', 'overdue',
            'statuses', 'statusColors'
        ));
    }

    // Manage Tags
    public function tags()
    {
        $tags = LeadTag::withCount('leads')->get();
        return view('admin.leads.tags', compact('tags'));
    }

    public function storeTag(Request $request)
    {
        $request->validate(['name' => 'required|string|max:50', 'color' => 'required|string|size:7']);
        LeadTag::create($request->only('name', 'color'));
        return redirect()->route('admin.leads.tags')->with('success', 'Tag ditambahkan.');
    }

    public function destroyTag(LeadTag $leadTag)
    {
        $leadTag->delete();
        return redirect()->route('admin.leads.tags')->with('success', 'Tag dihapus.');
    }
}
