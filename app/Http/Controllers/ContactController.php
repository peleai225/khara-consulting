<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        // Honeypot anti-spam : si le champ caché est rempli, c'est un bot.
        // On simule un succès sans rien enregistrer ni envoyer.
        if ($request->filled('website')) {
            return redirect()->route('contact')
                ->with('success', 'Votre message a été envoyé avec succès !');
        }

        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'type' => 'required|in:entrepreneur,entreprise,professionnel,etudiant,autre',
            'needs' => 'required|array|min:1',
            'needs.*' => 'in:formation,entrepreneuriat,rh,structuration,audit,autre',
            'budget' => 'nullable|in:<500k,500k-1m,1m-3m,3m-5m,>5m,discuter',
            'message' => 'required|string|min:50|max:2000',
            'contact_consent' => 'required|accepted',
            'privacy_consent' => 'required|accepted',
        ], [
            'name.required' => 'Le nom et prénom sont obligatoires.',
            'name.min' => 'Le nom doit contenir au moins 2 caractères.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.min' => 'Le numéro de téléphone doit contenir au moins 10 caractères.',
            'type.required' => 'Veuillez sélectionner votre profil.',
            'needs.required' => 'Veuillez sélectionner au moins un besoin.',
            'needs.min' => 'Veuillez sélectionner au moins un besoin.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 50 caractères.',
            'message.max' => 'Le message ne peut pas dépasser 2000 caractères.',
            'contact_consent.required' => 'Vous devez accepter d\'être contacté(e).',
            'contact_consent.accepted' => 'Vous devez accepter d\'être contacté(e).',
            'privacy_consent.required' => 'Vous devez accepter la politique de confidentialité.',
            'privacy_consent.accepted' => 'Vous devez accepter la politique de confidentialité.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact')
                ->withErrors($validator)
                ->withInput();
        }

        // 1) Enregistrement du contact (prioritaire) — si ça échoue, on prévient l'utilisateur.
        try {
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'type' => $request->type,
                'needs' => $request->needs,
                'budget' => $request->budget,
                'message' => $request->message,
                'contact_consent' => $request->has('contact_consent'),
                'privacy_consent' => $request->has('privacy_consent'),
                'email_sent' => false,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Échec enregistrement contact : ' . $e->getMessage());

            return redirect()->route('contact')
                ->with('error', 'Une erreur est survenue. Veuillez réessayer ou nous contacter directement par téléphone.')
                ->withInput();
        }

        // 2) Envoi des emails — ne bloque jamais la confirmation : un échec est loggé.
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'type' => $this->getTypeLabel($request->type),
                'needs' => $this->getNeedsLabels($request->needs),
                'budget' => $request->budget ? $this->getBudgetLabel($request->budget) : 'Non spécifié',
                'message' => $request->message,
            ];

            $adminEmail = \App\Models\Setting::get('mail_notification_to') ?: config('mail.from.address', 'contact@khara-consulting.com');
            Mail::to($adminEmail)->send(new ContactFormMail($data));

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($request->email)->send(new ContactFormMail($data, true));
            }

            $contact->update(['email_sent' => true]);
        } catch (\Throwable $e) {
            \Log::error('Échec envoi email contact (message enregistré id=' . $contact->id . ') : ' . $e->getMessage());
        }

        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }

    private function getTypeLabel($type)
    {
        $types = [
            'entrepreneur' => 'Entrepreneur / Porteur de projet',
            'entreprise' => 'Entreprise / Organisation',
            'professionnel' => 'Professionnel / Salarié',
            'etudiant' => 'Étudiant / Jeune diplômé',
            'autre' => 'Autre',
        ];

        return $types[$type] ?? $type;
    }

    private function getNeedsLabels($needs)
    {
        $labels = [
            'formation' => 'Formation',
            'entrepreneuriat' => 'Accompagnement entrepreneurial',
            'rh' => 'Ressources humaines / recrutement',
            'structuration' => 'Structuration / croissance d\'entreprise',
            'audit' => 'Audit',
            'autre' => 'Autre',
        ];

        return array_map(function($need) use ($labels) {
            return $labels[$need] ?? $need;
        }, $needs);
    }

    private function getBudgetLabel($budget)
    {
        $budgets = [
            '<500k' => 'Moins de 500 000 FCFA',
            '500k-1m' => '500 000 - 1 000 000 FCFA',
            '1m-3m' => '1 000 000 - 3 000 000 FCFA',
            '3m-5m' => '3 000 000 - 5 000 000 FCFA',
            '>5m' => 'Plus de 5 000 000 FCFA',
            'discuter' => 'À discuter',
        ];

        return $budgets[$budget] ?? $budget;
    }
}
