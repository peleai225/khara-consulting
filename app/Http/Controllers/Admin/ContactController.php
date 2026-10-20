<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            if ($request->status === 'replied') {
                $query->where('email_sent', true);
            } elseif ($request->status === 'new') {
                $query->where('email_sent', false);
            }
        }

        // Tri
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $contacts = $query->paginate(15)->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact supprimé avec succès.');
    }

    /**
     * Marquer un contact comme lu/non lu
     */
    public function toggleRead(Contact $contact)
    {
        // Vous pouvez ajouter un champ 'read' à la table contacts si nécessaire
        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    /**
     * Export contacts to CSV
     */
    public function exportCsv(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        if ($request->filled('type')) $query->where('type', $request->type);
        if ($request->filled('status')) {
            if ($request->status === 'replied') $query->where('email_sent', true);
            elseif ($request->status === 'new') $query->where('email_sent', false);
        }
        if ($request->filled('date_from')) $query->whereDate('created_at', '>=', $request->date_from);
        if ($request->filled('date_to')) $query->whereDate('created_at', '<=', $request->date_to);

        $contacts = $query->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts-'.date('Y-m-d').'.csv"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nom', 'Email', 'Téléphone', 'Type', 'Besoins', 'Budget', 'Message', 'Date'], ';');
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->type,
                    is_array($contact->needs) ? implode(', ', $contact->needs) : '',
                    $contact->budget ?? '',
                    $contact->message,
                    $contact->created_at->format('d/m/Y H:i'),
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
