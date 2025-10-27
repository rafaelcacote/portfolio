@extends('layouts.app')

@section('title', 'Contato - Solicite seu Orçamento')
@section('description', 'Entre em contato para solicitar um orçamento personalizado para seu projeto de desenvolvimento web.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-primary text-white section-padding">
    <div class="container-custom text-center">
        <h1 class="heading-xl text-white mb-6">Entre em Contato</h1>
        <p class="text-lead text-blue-100 max-w-3xl mx-auto">
            Pronto para transformar sua ideia em realidade? Vamos conversar sobre seu projeto!
        </p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Contact Form -->
            <div>
                <h2 class="heading-lg mb-6">Solicite seu Orçamento</h2>
                <p class="text-gray-600 mb-8">
                    Preencha o formulário abaixo com os detalhes do seu projeto e entrarei em contato em até 24 horas.
                </p>
                
                @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
                @endif
                
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nome Completo *
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="form-input @error('name') border-red-500 @enderror" 
                                   required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                E-mail *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="form-input @error('email') border-red-500 @enderror" 
                                   required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Telefone/WhatsApp
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   class="form-input @error('phone') border-red-500 @enderror"
                                   placeholder="(11) 99999-9999">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Company -->
                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                                Empresa
                            </label>
                            <input type="text" 
                                   id="company" 
                                   name="company" 
                                   value="{{ old('company') }}"
                                   class="form-input @error('company') border-red-500 @enderror">
                            @error('company')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Assunto *
                        </label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               value="{{ old('subject') }}"
                               class="form-input @error('subject') border-red-500 @enderror" 
                               placeholder="Ex: Desenvolvimento de site institucional"
                               required>
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Type -->
                        <div>
                            <label for="project_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipo de Projeto
                            </label>
                            <select id="project_type" 
                                    name="project_type" 
                                    class="form-select @error('project_type') border-red-500 @enderror">
                                <option value="">Selecione...</option>
                                @foreach($projectTypes as $key => $type)
                                    <option value="{{ $key }}" {{ old('project_type') == $key ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Budget Range -->
                        <div>
                            <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-2">
                                Orçamento Estimado
                            </label>
                            <select id="budget_range" 
                                    name="budget_range" 
                                    class="form-select @error('budget_range') border-red-500 @enderror">
                                <option value="">Selecione...</option>
                                @foreach($budgetRanges as $key => $range)
                                    <option value="{{ $key }}" {{ old('budget_range') == $key ? 'selected' : '' }}>
                                        {{ $range }}
                                    </option>
                                @endforeach
                            </select>
                            @error('budget_range')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Timeline -->
                    <div>
                        <label for="timeline" class="block text-sm font-medium text-gray-700 mb-2">
                            Prazo Desejado
                        </label>
                        <input type="text" 
                               id="timeline" 
                               name="timeline" 
                               value="{{ old('timeline') }}"
                               class="form-input @error('timeline') border-red-500 @enderror"
                               placeholder="Ex: 2 meses, Urgente, Sem pressa">
                        @error('timeline')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Mensagem *
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="6" 
                                  class="form-textarea @error('message') border-red-500 @enderror" 
                                  placeholder="Descreva seu projeto, objetivos, funcionalidades desejadas e qualquer informação relevante..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                   <!-- reCAPTCHA -->
               <!-- Turnstile -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Verificação de Segurança *
                    </label>
                    
                    <div class="cf-turnstile" data-sitekey="{{ config('turnstile.site_key') }}"></div>
                    
                    @error('cf-turnstile-response')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar Mensagem
                        </button>
                    </div>
                    
                    <p class="text-sm text-gray-500 text-center">
                        * Campos obrigatórios. Respondo em até 24 horas.
                    </p>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h2 class="heading-lg mb-6">Outras Formas de Contato</h2>
                <p class="text-gray-600 mb-8">
                    Prefere falar diretamente? Entre em contato através dos canais abaixo:
                </p>
                
                <!-- Contact Methods -->
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">E-mail</h3>
                            <p class="text-gray-600 mb-2">Resposta em até 24 horas</p>
                            <a href="mailto:rafael.cacote@gmail.com" class="text-blue-600 hover:text-blue-800">
                                rafael.cacote@gmail.com
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fab fa-whatsapp text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">WhatsApp</h3>
                            <p class="text-gray-600 mb-2">Resposta rápida no horário comercial</p>
                            <a href="https://wa.me/5592992684391" target="_blank" class="text-green-600 hover:text-green-800">
                                (92) 99268-4391
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fab fa-linkedin text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">LinkedIn</h3>
                            <p class="text-gray-600 mb-2">Conecte-se profissionalmente</p>
                            <a href="https://www.linkedin.com/in/rafaelcacote" target="_blank" class="text-blue-600 hover:text-blue-800">
                                /in/rafaelcacote
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fab fa-github text-gray-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">GitHub</h3>
                            <p class="text-gray-600 mb-2">Veja meus códigos e projetos</p>
                            <a href="https://github.com/rafaelcacote" target="_blank" class="text-gray-600 hover:text-gray-800">
                                /rafaelcacote
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Availability -->
                <div class="mt-12 p-6 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold mb-3 flex items-center">
                        <i class="fas fa-clock mr-2 text-blue-600"></i>
                        Horário de Atendimento
                    </h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex justify-between">
                            <span>Segunda a Sexta:</span>
                            <span>9h às 18h</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sábado:</span>
                            <span>Fechado</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Domingo:</span>
                            <span>Fechado</span>
                        </li>
                    </ul>
                    <p class="text-xs text-gray-500 mt-3">
                        * Horário de Brasília. Emergências podem ser atendidas fora do horário comercial.
                    </p>
                </div>
                
                <!-- Location -->
                <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
                        Localização
                    </h3>
                    <p class="text-gray-600">
                        Manaus, AM - Brasil<br>
                        Atendimento presencial mediante agendamento
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Perguntas Frequentes</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Respostas rápidas para as dúvidas mais comuns sobre orçamentos e projetos.
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            @php
            $faqs = [
                [
                    'question' => 'Quanto tempo leva para receber um orçamento?',
                    'answer' => 'Normalmente envio orçamentos em até 24-48 horas após receber todas as informações necessárias sobre o projeto.'
                ],
                [
                    'question' => 'O orçamento é gratuito?',
                    'answer' => 'Sim, todos os orçamentos são completamente gratuitos e sem compromisso. Você só paga se decidir contratar o serviço.'
                ],
                [
                    'question' => 'Quais informações preciso fornecer?',
                    'answer' => 'Quanto mais detalhes sobre o projeto, melhor. Inclua objetivos, funcionalidades desejadas, referências visuais e prazo esperado.'
                ],
                [
                    'question' => 'Vocês fazem reuniões online?',
                    'answer' => 'Sim! Faço reuniões por Google Meet, Zoom ou WhatsApp para discutir projetos e esclarecer dúvidas.'
                ],
                [
                    'question' => 'Qual é a forma de pagamento?',
                    'answer' => 'Aceito PIX, transferência bancária e cartão de crédito. O pagamento é dividido em parcelas conforme acordado.'
                ]
            ];
            @endphp
            
            <div class="space-y-4">
                @foreach($faqs as $index => $faq)
                <div class="card">
                    <button class="w-full p-6 text-left focus:outline-none faq-toggle" data-target="contact-faq-{{ $index }}">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold">{{ $faq['question'] }}</h3>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="contact-faq-{{ $index }}" class="faq-content hidden px-6 pb-6">
                        <p class="text-gray-600">{{ $faq['answer'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-gradient-primary text-white">
    <div class="container-custom text-center">
        <h2 class="heading-lg text-white mb-6">Ainda tem dúvidas?</h2>
        <p class="text-lead text-blue-100 mb-8 max-w-2xl mx-auto">
            Não hesite em entrar em contato. Estou aqui para ajudar com seu projeto!
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/5592992684391" target="_blank" class="btn-secondary">
                <i class="fab fa-whatsapp mr-2"></i>
                Falar no WhatsApp
            </a>
            <a href="mailto:joao.silva@email.com" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600">
                <i class="fas fa-envelope mr-2"></i>
                Enviar E-mail
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')

<script>
    
    // FAQ Toggle
    document.querySelectorAll('.faq-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const target = document.getElementById(button.dataset.target);
            const icon = button.querySelector('i');
            
            if (target.classList.contains('hidden')) {
                target.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                target.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });
    
    // Phone mask
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 11) {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (value.length >= 7) {
            value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
        } else if (value.length >= 3) {
            value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
        }
        e.target.value = value;
    });
</script>

<!-- Script do Cloudflare Turnstile -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<script>
    // Debug no console
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Turnstile Site Key:', '{{ config('turnstile.site_key') }}');
    });

    // Seu código existente do FAQ e máscara de telefone
    document.querySelectorAll('.faq-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const target = document.getElementById(button.dataset.target);
            const icon = button.querySelector('i');
            
            if (target.classList.contains('hidden')) {
                target.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                target.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });
    
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 11) {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (value.length >= 7) {
            value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
        } else if (value.length >= 3) {
            value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
        }
        e.target.value = value;
    });
</script>

@endpush

