<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Service;
use App\Models\Slide;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalContacts = Contact::count();
        $contactsToday = Contact::whereDate('created_at', today())->count();
        $contactsThisWeek = Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $contactsLastWeek = Contact::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();

        $leadsPct = $contactsLastWeek > 0
            ? round((($contactsThisWeek - $contactsLastWeek) / $contactsLastWeek) * 100, 1)
            : ($contactsThisWeek > 0 ? 100 : 0);

        $msgPct = $totalContacts > 0
            ? round(($contactsToday / $totalContacts) * 100, 1)
            : 0;

        $stats = [
            'total_contacts' => $totalContacts,
            'contacts_today' => $contactsToday,
            'contacts_this_week' => $contactsThisWeek,
            'contacts_this_month' => Contact::whereMonth('created_at', now()->month)->count(),
            'active_services' => Service::active()->count(),
            'active_slides' => Slide::active()->count(),
            'active_pages' => Page::where('is_active', true)->count(),
            'leads_pct' => $leadsPct,
            'msg_pct' => $msgPct,
        ];

        $recent_contacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }
}
