@extends('layouts.app')

@section('title', 'Sobre Mim - Portfolio Profissional')
@section('description', 'Conheça mais sobre minha trajetória, experiências e paixão por desenvolvimento web. Desenvolvedor Full Stack especializado em soluções modernas.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-primary text-white section-padding">
    <div class="container-custom text-center">
        <h1 class="heading-xl text-white mb-6">Sobre Mim</h1>
        <p class="text-lead text-blue-100 max-w-3xl mx-auto">
            Conheça minha trajetória, experiências e a paixão que me move no mundo do desenvolvimento web.
        </p>
    </div>
</section>

<!-- Main Content -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <!-- Profile Image -->
            <div class="text-center lg:text-left">
                <div class="relative inline-block">
                    <div class="w-80 h-80 bg-gradient-secondary rounded-2xl flex items-center justify-center mx-auto overflow-hidden">
                        <img src="{{ asset('images/eu.png') }}" alt="Rafael Caçote" class="w-full h-full object-cover rounded-2xl">
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-blue-500 rounded-full opacity-20"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-purple-500 rounded-full opacity-20"></div>
                </div>
            </div>

            <!-- About Content -->
            <div>
                <h2 class="heading-lg mb-6">Rafael Caçote</h2>
                <p class="text-gray-600 mb-6">
                    Sou um desenvolvedor Full Stack apaixonado por tecnologia e inovação, com mais de 5 anos de experiência
                    criando soluções digitais que fazem a diferença na vida das pessoas e no sucesso dos negócios.
                </p>
                <p class="text-gray-600 mb-6">
                    Minha jornada começou em 2019, quando descobri o poder da programação para resolver problemas reais.
                    Desde então, tenho me dedicado a aprender continuamente e aplicar as melhores práticas de desenvolvimento
                    para criar aplicações web robustas, escaláveis e com excelente experiência do usuário.
                </p>
                <p class="text-gray-600 mb-8">
                    Acredito que a tecnologia deve ser acessível e útil, por isso me esforço para criar soluções que não apenas
                    funcionem bem, mas que também sejam intuitivas e agradáveis de usar.
                </p>

                <!-- Contact Info -->
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-envelope w-5 h-5 mr-3 text-blue-600"></i>
                        <span>rafael.cacote@gmail.com</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone w-5 h-5 mr-3 text-blue-600"></i>
                        <span>(92) 99268-4391</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt w-5 h-5 mr-3 text-blue-600"></i>
                        <span>Manaus, AM - Brasil</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Experience Timeline -->
        <div class="mb-20">
            <h2 class="heading-lg text-center mb-12">Experiência Profissional</h2>

            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-blue-200"></div>

                <div class="space-y-12">
                    @php
                    $experiences = [
                        [
                            'period' => '2022 - Presente',
                            'position' => 'Desenvolvedor Full Stack Pleno',
                            'company' => 'Prefeitura Municipal de Manaus',
                            'description' => 'Liderança técnica em projetos de grande escala, desenvolvimento de arquiteturas robustas e mentoria de desenvolvedores juniores.',
                            'achievements' => [
                                'Desenvolveu mais de 8 projetos web completos',
                                'Implementou sistema de CI/CD que aumentou a produtividade em 60%',
                                'Otimizou performance de aplicações'
                            ]
                        ],
                        [
                            'period' => '2018 - 2022',
                            'position' => 'Desenvolvedor de Sistemas',
                            'company' => 'Hospital Beneficente Portugues',
                            'description' => 'Desenvolvimento de aplicações web personalizadas utilizando Laravel, com foco na automação de processos hospitalares. Transformamos operações manuais ou baseadas em planilhas em sistemas eficientes, agilizando fluxos de trabalho nas áreas financeira, farmacêutica e administrativa, garantindo maior precisão e produtividade.',
                            'achievements' => [
                                'Desenvolveu mais de 9 projetos web completos',
                                'Implementou integrações com APIs de terceiros',
                                'Otimizou performance de aplicações legadas'
                            ]
                        ],
                        
                    ];
                    @endphp

                    @foreach($experiences as $index => $exp)
                    <div class="relative flex items-center {{ $index % 2 == 0 ? 'justify-start' : 'justify-end' }}">
                        <!-- Timeline dot -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-600 rounded-full border-4 border-white shadow-lg z-10"></div>

                        <div class="w-5/12 {{ $index % 2 == 0 ? 'pr-8' : 'pl-8' }}">
                            <div class="card p-6">
                                <div class="text-sm text-blue-600 font-semibold mb-2">{{ $exp['period'] }}</div>
                                <h3 class="font-bold text-lg mb-1">{{ $exp['position'] }}</h3>
                                <div class="text-gray-500 mb-3">{{ $exp['company'] }}</div>
                                <p class="text-gray-600 mb-4">{{ $exp['description'] }}</p>

                                <ul class="space-y-1">
                                    @foreach($exp['achievements'] as $achievement)
                                    <li class="text-sm text-gray-500 flex items-start">
                                        <i class="fas fa-check text-green-500 mr-2 mt-1 text-xs"></i>
                                        {{ $achievement }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Skills & Technologies -->
        <div class="mb-20">
            <h2 class="heading-lg text-center mb-12">Habilidades & Tecnologias</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Technical Skills -->
                <div>
                    <h3 class="heading-sm mb-6">Habilidades Técnicas</h3>
                    <div class="space-y-4">
                        @php
                        $skills = [
                            ['name' => 'Laravel/PHP', 'level' => 95],
                            ['name' => 'React/JavaScript', 'level' => 90],
                            ['name' => 'Vue.js', 'level' => 85],
                            ['name' => 'Node.js', 'level' => 80],
                            ['name' => 'MySQL/PostgreSQL', 'level' => 90],
                            ['name' => 'Docker/DevOps', 'level' => 75]
                        ];
                        @endphp

                        @foreach($skills as $skill)
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="font-medium">{{ $skill['name'] }}</span>
                                <span class="text-gray-500">{{ $skill['level'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-primary h-2 rounded-full transition-all duration-1000" style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Soft Skills -->
                <div>
                    <h3 class="heading-sm mb-6">Competências Pessoais</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @php
                        $softSkills = [
                            'Liderança de Equipe',
                            'Comunicação',
                            'Resolução de Problemas',
                            'Pensamento Analítico',
                            'Gestão de Tempo',
                            'Adaptabilidade',
                            'Trabalho em Equipe',
                            'Mentoria'
                        ];
                        @endphp

                        @foreach($softSkills as $skill)
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-sm">{{ $skill }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Education & Certifications -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Education -->
            <div>
                <h3 class="heading-sm mb-6">Formação</h3>
                <div class="space-y-4">
                    <div class="card p-6">
                        <h4 class="font-bold mb-2">Bacharelado em Ciência da Computação</h4>
                        <div class="text-gray-500 mb-2">CIESA - Centro Universitário de Ensino Superior do Amazonas - 2006 - 2010</div>
                        <p class="text-sm text-gray-600">
                            Formação sólida em fundamentos da computação, algoritmos, estruturas de dados e engenharia de software.
                        </p>
                    </div>

                    <!-- <div class="card p-6">
                        <h4 class="font-bold mb-2">Pós-graduação em Desenvolvimento Web</h4>
                        <div class="text-gray-500 mb-2">FIAP - 2020-2021</div>
                        <p class="text-sm text-gray-600">
                            Especialização em tecnologias web modernas, arquitetura de software e metodologias ágeis.
                        </p>
                    </div> -->
                </div>
            </div>

            <!-- Certifications -->
            <!-- <div>
                <h3 class="heading-sm mb-6">Certificações</h3>
                <div class="space-y-4">
                    @php
                    $certifications = [
                        'AWS Certified Developer',
                        'Google Cloud Professional',
                        'Laravel Certified Developer',
                        'Scrum Master Certified',
                        'MongoDB Developer'
                    ];
                    @endphp

                    @foreach($certifications as $cert)
                    <div class="flex items-center card p-4">
                        <i class="fas fa-certificate text-blue-600 mr-3"></i>
                        <span>{{ $cert }}</span>
                    </div>
                    @endforeach
                </div>
            </div> -->
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Meus Valores</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Princípios que guiam meu trabalho e relacionamento com clientes e colegas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $values = [
                [
                    'icon' => 'fas fa-heart',
                    'title' => 'Paixão',
                    'description' => 'Amo o que faço e isso se reflete na qualidade do meu trabalho.'
                ],
                [
                    'icon' => 'fas fa-handshake',
                    'title' => 'Transparência',
                    'description' => 'Comunicação clara e honesta em todos os projetos.'
                ],
                [
                    'icon' => 'fas fa-rocket',
                    'title' => 'Inovação',
                    'description' => 'Sempre buscando as melhores e mais modernas soluções.'
                ],
                [
                    'icon' => 'fas fa-users',
                    'title' => 'Colaboração',
                    'description' => 'Trabalho em equipe e compartilhamento de conhecimento.'
                ]
            ];
            @endphp

            @foreach($values as $value)
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="{{ $value['icon'] }} text-2xl text-white"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $value['title'] }}</h3>
                <p class="text-gray-600 text-sm">{{ $value['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-gradient-primary text-white">
    <div class="container-custom text-center">
        <h2 class="heading-lg text-white mb-6">Vamos Trabalhar Juntos?</h2>
        <p class="text-lead text-blue-100 mb-8 max-w-2xl mx-auto">
            Estou sempre aberto a novos desafios e oportunidades de colaboração.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="btn-secondary">
                <i class="fas fa-envelope mr-2"></i>
                Entre em Contato
            </a>
            <a href="{{ route('portfolio.index') }}" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600">
                <i class="fas fa-eye mr-2"></i>
                Ver Portfolio
            </a>
        </div>
    </div>
</section>
@endsection

