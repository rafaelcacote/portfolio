<?php

namespace App\Http\Controllers;

use App\Rules\Turnstile;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $projectTypes = ContactMessage::getProjectTypes();
        $budgetRanges = ContactMessage::getBudgetRanges();
        
        return view('contact.index', compact('projectTypes', 'budgetRanges'));
    }

     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'project_type' => 'nullable|in:website,app,ecommerce,system,other',
            'budget_range' => 'nullable|string|max:50',
            'timeline' => 'nullable|string|max:100',
            'cf-turnstile-response' => ['required', new Turnstile], // ✅ Mudar para Turnstile
        ], [
            'cf-turnstile-response.required' => 'Por favor, complete a verificação de segurança.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Criar mensagem de contato
        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'subject' => $request->subject,
            'message' => $request->message,
            'project_type' => $request->project_type,
            'budget_range' => $request->budget_range,
            'timeline' => $request->timeline,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Enviar email de notificação
        try {
            // Mail::to(config('mail.admin_email'))->send(new ContactMessageReceived($contactMessage));
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email de contato: ' . $e->getMessage());
        }

        return back()->with('success', 'Mensagem enviada com sucesso! Entrarei em contato em breve.');
    }

}
