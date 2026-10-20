@extends('layouts.admin')

@section('title', 'Dashboard - Admin Khara Consulting')
@section('header-search')
<form action="{{ route('admin.contacts.index') }}" method="GET" class="relative">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
    <input name="search" class="w-full bg-slate-50 border-none rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-khara-red/20 focus:outline-none placeholder:text-slate-400" placeholder="Search data, reports, settings..." type="text" value="{{ request('search') }}"/>
</form>
@endsection

@section('content')
<div class="-m-8 p-8 bg-slate-50 min-h-full">
<div class="mb-8 flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Dashboard Overview</h2>
        <p class="text-slate-500">Welcome back, here's what's happening with Khara Consulting today.</p>
    </div>
    <a href="{{ route('contact') }}" class="bg-khara-red hover:bg-khara-red/90 text-white px-4 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all shadow-lg shadow-khara-red/20">
        <span class="material-symbols-outlined text-xl">add</span>
        New Lead
    </a>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border-l-4 border-khara-red shadow-sm hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-khara-red/10 p-2 rounded-lg text-khara-red">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
            <span class="text-emerald-500 text-sm font-bold flex items-center">{{ $stats['leads_pct'] >= 0 ? '+' : '' }}{{ $stats['leads_pct'] }}%</span>
        </div>
        <p class="text-slate-500 text-sm font-medium mb-1">Total Leads</p>
        <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_contacts']) }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl border-l-4 border-khara-red shadow-sm hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-khara-red/10 p-2 rounded-lg text-khara-red">
                <span class="material-symbols-outlined">room_service</span>
            </div>
            <span class="text-slate-400 text-sm font-bold">Stable</span>
        </div>
        <p class="text-slate-500 text-sm font-medium mb-1">Active Services</p>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['active_services'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl border-l-4 border-khara-red shadow-sm hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-khara-red/10 p-2 rounded-lg text-khara-red">
                <span class="material-symbols-outlined">view_carousel</span>
            </div>
            <span class="text-emerald-500 text-sm font-bold flex items-center">+{{ $stats['active_slides'] }}</span>
        </div>
        <p class="text-slate-500 text-sm font-medium mb-1">Active Slides</p>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['active_slides'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl border-l-4 border-khara-red shadow-sm hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-khara-red/10 p-2 rounded-lg text-khara-red">
                <span class="material-symbols-outlined">article</span>
            </div>
            <span class="text-khara-red text-sm font-bold flex items-center">{{ $stats['active_pages'] ?? 0 }}</span>
        </div>
        <p class="text-slate-500 text-sm font-medium mb-1">Published Pages</p>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['active_pages'] ?? 0 }}</p>
    </div>
</div>

<!-- Central Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Activity Chart -->
    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold">Contact Leads Trends</h3>
            <select class="bg-slate-50 border-none text-xs font-semibold rounded-lg px-3 py-1.5 focus:ring-1 focus:ring-khara-red/20">
                <option>Last 30 Days</option>
                <option>Last 90 Days</option>
            </select>
        </div>
        <div class="h-64 flex flex-col justify-between">
            <div class="relative flex-1">
                <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 400 100">
                    <defs>
                        <linearGradient id="chartGradient" x1="0%" x2="0%" y1="0%" y2="100%">
                            <stop offset="0%" stop-color="#DC2626" stop-opacity="0.2"></stop>
                            <stop offset="100%" stop-color="#DC2626" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                    <path d="M0,80 Q25,70 50,75 T100,60 T150,85 T200,40 T250,55 T300,20 T350,45 T400,30 V100 H0 Z" fill="url(#chartGradient)"></path>
                    <path d="M0,80 Q25,70 50,75 T100,60 T150,85 T200,40 T250,55 T300,20 T350,45 T400,30" fill="none" stroke="#DC2626" stroke-width="2.5"></path>
                    <circle cx="300" cy="20" fill="#DC2626" r="4"></circle>
                </svg>
            </div>
            <div class="flex justify-between pt-4 border-t border-slate-50">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-tighter">Day 1</span>
                <span class="text-xs text-slate-400 font-medium uppercase tracking-tighter">Day 10</span>
                <span class="text-xs text-slate-400 font-medium uppercase tracking-tighter">Day 20</span>
                <span class="text-xs text-slate-400 font-medium uppercase tracking-tighter">Today</span>
            </div>
        </div>
    </div>
    <!-- Recent Activity Feed -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <h3 class="text-lg font-bold mb-6">Recent Activity</h3>
        <div class="space-y-6">
            @forelse($recent_contacts->take(4) as $index => $contact)
            <div class="flex gap-4">
                <div class="size-2 rounded-full {{ $index === 0 ? 'bg-khara-red shadow-[0_0_8px_rgba(220,38,38,0.5)]' : 'bg-slate-300' }} mt-1.5 shrink-0"></div>
                <div>
                    <p class="text-sm font-semibold text-slate-900">New Lead: {{ $contact->name }}</p>
                    <p class="text-xs text-slate-500 mb-1">{{ is_array($contact->needs) ? implode(', ', $contact->needs) : $contact->needs }}</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $contact->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-500">Aucune activité récente</p>
            @endforelse
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="w-full mt-8 py-2 text-khara-red font-semibold text-sm hover:bg-khara-red/5 rounded-lg transition-colors block text-center">
            View Full Logs
        </a>
    </div>
</div>

<!-- Bottom Table Section -->
<div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-50 flex justify-between items-center">
        <h3 class="text-lg font-bold">Latest Contacts</h3>
        <a href="{{ route('admin.contacts.index') }}" class="text-khara-red text-sm font-semibold flex items-center gap-1 hover:underline">
            Manage Contacts
            <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Service Interested</th>
                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recent_contacts as $contact)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600 shrink-0">
                                {{ strtoupper(substr($contact->name, 0, 2)) }}
                            </div>
                            <span class="text-sm font-medium">{{ $contact->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ is_array($contact->needs) ? implode(', ', $contact->needs) : ($contact->needs ?? '-') }}</td>
                    <td class="px-6 py-4">
                        @if($contact->email_sent)
                            <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full text-xs font-bold">Qualified</span>
                        @else
                            <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-xs font-bold">New</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $contact->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-slate-400 hover:text-khara-red transition-colors" title="Voir">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce contact ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-khara-red transition-colors" title="Supprimer">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <span class="material-symbols-outlined text-4xl mb-2 block">inbox</span>
                        Aucun contact pour le moment
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
