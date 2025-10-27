@extends('layouts.app')

@section('title', 'Serviços - Portfolio Profissional')
@section('description', 'Conheça todos os serviços de desenvolvimento web que ofereço: sites, aplicações, e-commerce, APIs e muito mais.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-primary text-white section-padding">
    <div class="container-custom text-center">
        <h1 class="heading-xl text-white mb-6">Meus Serviços</h1>
        <p class="text-lead text-blue-100 max-w-3xl mx-auto">
            Soluções completas em desenvolvimento web para transformar suas ideias em realidade digital.
        </p>
    </div>
</section>

<!-- Main Services -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            @php
            $mainServices = [
                [
                    'icon' => 'fas fa-laptop-code',
                    'title' => 'Desenvolvimento Web Completo',
                    'description' => 'Criação de sites e aplicações web do zero, desde o planejamento até a implementação final.',
                    'features' => [
                        'Sites institucionais e corporativos',
                        'Aplicações web complexas',
                        'Sistemas de gerenciamento',
                        'Portais e dashboards',
                        'Integração com APIs',
                        'Otimização de performance'
                    ],
                    'technologies' => ['Laravel', 'React', 'Vue.js', 'MySQL', 'PostgreSQL'],
                    'price_range' => 'A partir de R$ 2.500'
                ],
                [
                    'icon' => 'fas fa-shopping-cart',
                    'title' => 'E-commerce & Lojas Virtuais',
                    'description' => 'Desenvolvimento de lojas virtuais completas com sistema de pagamento e gestão.',
                    'features' => [
                        'Catálogo de produtos',
                        'Carrinho de compras',
                        'Sistema de pagamento',
                        'Gestão de pedidos',
                        'Painel administrativo',
                        'Integração com marketplaces'
                    ],
                    'technologies' => ['Laravel', 'WooCommerce', 'Stripe', 'PayPal', 'Mercado Pago'],
                    'price_range' => 'A partir de R$ 5.000'
                ],
                
                [
                    'icon' => 'fas fa-server',
                    'title' => 'APIs & Backend',
                    'description' => 'Desenvolvimento de APIs RESTful e sistemas backend robustos e escaláveis.',
                    'features' => [
                        'APIs RESTful',
                        'Microserviços',
                        'Autenticação JWT',
                        'Documentação completa',
                        'Testes automatizados',
                        'Deploy em cloud'
                    ],
                    'technologies' => ['Laravel', 'Node.js', 'Docker', 'AWS', 'Google Cloud'],
                    'price_range' => 'A partir de R$ 3.500'
                ]
            ];
            @endphp
            
            @foreach($mainServices as $service)
            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-primary rounded-full flex items-center justify-center mr-4">
                        <i class="{{ $service['icon'] }} text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="heading-sm mb-2">{{ $service['title'] }}</h3>
                        <!--<div class="text-blue-600 font-semibold">{{ $service['price_range'] }}</div>-->
                    </div>
                </div>
                
                <p class="text-gray-600 mb-6">{{ $service['description'] }}</p>
                
                <div class="mb-6">
                    <h4 class="font-semibold mb-3">O que está incluído:</h4>
                    <ul class="space-y-2">
                        @foreach($service['features'] as $feature)
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                            <span class="text-sm text-gray-600">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="mb-6">
                    <h4 class="font-semibold mb-3">Tecnologias utilizadas:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($service['technologies'] as $tech)
                        <span class="tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                
                <a href="{{ route('contact.index') }}" class="btn-primary w-full text-center">
                    Solicitar Orçamento
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Additional Services -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Serviços Complementares</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Serviços adicionais para complementar e potencializar seu projeto digital.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $additionalServices = [
                [
                    'icon' => 'fas fa-paint-brush',
                    'title' => 'UI/UX Design',
                    'description' => 'Design de interfaces intuitivas e experiências de usuário excepcionais.',
                    'price' => 'R$ 1.500 - R$ 3.000'
                ],
                [
                    'icon' => 'fas fa-search',
                    'title' => 'SEO & Performance',
                    'description' => 'Otimização para motores de busca e melhoria de performance.',
                    'price' => 'R$ 800 - R$ 2.000'
                ],
                [
                    'icon' => 'fas fa-tools',
                    'title' => 'Manutenção & Suporte',
                    'description' => 'Suporte técnico contínuo e manutenção de sistemas.',
                    'price' => 'R$ 500/mês'
                ],
                [
                    'icon' => 'fas fa-graduation-cap',
                    'title' => 'Consultoria Técnica',
                    'description' => 'Consultoria especializada em arquitetura e tecnologia.',
                    'price' => 'R$ 150/hora'
                ],
                [
                    'icon' => 'fas fa-cloud',
                    'title' => 'Deploy & Hospedagem',
                    'description' => 'Configuração de servidores e deploy em cloud.',
                    'price' => 'R$ 300 - R$ 800'
                ],
                [
                    'icon' => 'fas fa-shield-alt',
                    'title' => 'Segurança Web',
                    'description' => 'Implementação de medidas de segurança e auditoria.',
                    'price' => 'R$ 1.000 - R$ 2.500'
                ]
            ];
            @endphp
            
            @foreach($additionalServices as $service)
            <div class="card p-6 text-center">
                <div class="w-12 h-12 bg-gradient-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="{{ $service['icon'] }} text-xl text-white"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $service['title'] }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ $service['description'] }}</p>
                <!--<div class="text-blue-600 font-semibold text-sm">{{ $service['price'] }}</div>-->
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Meu Processo de Trabalho</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Um processo estruturado e transparente para garantir o sucesso do seu projeto.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $process = [
                [
                    'step' => '01',
                    'title' => 'Descoberta',
                    'description' => 'Entendimento das necessidades, objetivos e requisitos do projeto.'
                ],
                [
                    'step' => '02',
                    'title' => 'Planejamento',
                    'description' => 'Criação da arquitetura, wireframes e cronograma detalhado.'
                ],
                [
                    'step' => '03',
                    'title' => 'Desenvolvimento',
                    'description' => 'Implementação do projeto com atualizações regulares do progresso.'
                ],
                [
                    'step' => '04',
                    'title' => 'Entrega',
                    'description' => 'Testes finais, deploy e treinamento para uso da solução.'
                ]
            ];
            @endphp
            
            @foreach($process as $step)
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-lg">{{ $step['step'] }}</span>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $step['title'] }}</h3>
                <p class="text-gray-600 text-sm">{{ $step['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Pricing Plans -->
<!--<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Planos de Manutenção</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Mantenha seu projeto sempre atualizado e funcionando perfeitamente.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $plans = [
                [
                    'name' => 'Básico',
                    'price' => 'R$ 299',
                    'period' => '/mês',
                    'description' => 'Ideal para sites simples',
                    'features' => [
                        'Backup semanal',
                        'Atualizações de segurança',
                        'Suporte por email',
                        'Relatório mensal',
                        '2 horas de alterações'
                    ],
                    'popular' => false
                ],
                [
                    'name' => 'Profissional',
                    'price' => 'R$ 599',
                    'period' => '/mês',
                    'description' => 'Para aplicações em crescimento',
                    'features' => [
                        'Backup diário',
                        'Monitoramento 24/7',
                        'Suporte prioritário',
                        'Relatórios detalhados',
                        '5 horas de alterações',
                        'Otimização de performance'
                    ],
                    'popular' => true
                ],
                [
                    'name' => 'Enterprise',
                    'price' => 'R$ 1.299',
                    'period' => '/mês',
                    'description' => 'Para projetos críticos',
                    'features' => [
                        'Backup em tempo real',
                        'Suporte 24/7',
                        'SLA garantido',
                        'Consultoria técnica',
                        '10 horas de alterações',
                        'Auditoria de segurança'
                    ],
                    'popular' => false
                ]
            ];
            @endphp
            
            @foreach($plans as $plan)
            <div class="card p-8 text-center {{ $plan['popular'] ? 'ring-2 ring-blue-500 relative' : '' }}">
                @if($plan['popular'])
                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                        Mais Popular
                    </span>
                </div>
                @endif
                
                <h3 class="font-bold text-xl mb-2">{{ $plan['name'] }}</h3>
                <p class="text-gray-600 text-sm mb-6">{{ $plan['description'] }}</p>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold">{{ $plan['price'] }}</span>
                    <span class="text-gray-500">{{ $plan['period'] }}</span>
                </div>
                
                <ul class="space-y-3 mb-8">
                    @foreach($plan['features'] as $feature)
                    <li class="flex items-center justify-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span class="text-sm">{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>
                
                <a href="{{ route('contact.index') }}" class="{{ $plan['popular'] ? 'btn-primary' : 'btn-outline' }} w-full text-center">
                    Escolher Plano
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>-->

<!-- FAQ Section -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Perguntas Frequentes</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Respostas para as dúvidas mais comuns sobre meus serviços.
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            @php
            $faqs = [
                [
                    'question' => 'Qual é o prazo médio para desenvolvimento de um projeto?',
                    'answer' => 'O prazo varia conforme a complexidade do projeto. Sites simples levam de 2-4 semanas, aplicações complexas podem levar de 2-6 meses. Sempre forneço um cronograma detalhado após a análise inicial.'
                ],
                [
                    'question' => 'Vocês oferecem garantia nos projetos desenvolvidos?',
                    'answer' => 'Sim, todos os projetos incluem 3 meses de garantia para correção de bugs e ajustes. Também oferecemos planos de manutenção para suporte contínuo.'
                ],
                [
                    'question' => 'É possível fazer alterações durante o desenvolvimento?',
                    'answer' => 'Claro! Trabalho com metodologia ágil, permitindo ajustes durante o processo. Alterações significativas podem impactar prazo e orçamento, sempre comunicado previamente.'
                ],
                [
                    'question' => 'Quais formas de pagamento são aceitas?',
                    'answer' => 'Aceito PIX, transferência bancária e cartão de crédito. O pagamento é dividido em parcelas conforme acordado no contrato, geralmente 50% no início e 50% na entrega.'
                ],
                [
                    'question' => 'Vocês fazem a hospedagem dos sites/aplicações?',
                    'answer' => 'Posso configurar e gerenciar a hospedagem em serviços como AWS, Google Cloud ou outros. O custo da hospedagem é separado do desenvolvimento.'
                ]
            ];
            @endphp
            
            <div class="space-y-4">
                @foreach($faqs as $index => $faq)
                <div class="card">
                    <button class="w-full p-6 text-left focus:outline-none faq-toggle" data-target="faq-{{ $index }}">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold">{{ $faq['question'] }}</h3>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-{{ $index }}" class="faq-content hidden px-6 pb-6">
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
        <h2 class="heading-lg text-white mb-6">Pronto para Começar seu Projeto?</h2>
        <p class="text-lead text-blue-100 mb-8 max-w-2xl mx-auto">
            Entre em contato para discutirmos como posso ajudar a transformar sua ideia em realidade.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="btn-secondary">
                <i class="fas fa-envelope mr-2"></i>
                Solicitar Orçamento Gratuito
            </a>
            <a href="https://wa.me/5511999999999" target="_blank" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600">
                <i class="fab fa-whatsapp mr-2"></i>
                WhatsApp
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
</script>
@endpush

