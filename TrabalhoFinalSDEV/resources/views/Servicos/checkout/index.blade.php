@extends('layouts.dashboard')

@section('content')
    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4 font-mono">
        <a href="{{ route('servicos.checkout.home') }}"
            class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono">&lt;REGISTOS DE SAÍDA/&gt;</h1>
    </div>
    <main class="px-4 md:px-8 font-mono">
        <div class="max-w-7xl mx-auto font-mono">
            <!-- Filtro de pesquisa -->
            <form method="GET" action="{{ route('servicos.checkout.index') }}"
                class="w-full flex flex-col gap-6 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600 font-mono">
                <div class="w-full flex flex-col">
                    <label for="search" class="block text-base font-semibold text-blue-200 mb-3 font-mono">PESQUISAR
                        REGISTO DE SAÍDA</label>
                    <input type="text" name="search" id="search"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono"
                        placeholder="Pesquisar por evento ou colaborador" value="{{ request('search') }}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="data" class="block text-base font-semibold text-blue-200 mb-3 font-mono">DATA DO
                        REGISTO DE SAÍDA</label>
                    <input type="date" name="data" id="data"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono"
                        value="{{ request('data') }}">
                </div>
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-center w-full pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white font-mono rounded-lg font-semibold shadow transition-all duration-200 text-center">FILTRAR</button>
                    <a href="{{ route('servicos.checkout.index') }}"
                        class="px-8 py-3 bg-slate-700 hover:bg-sky-800 font-mono text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">LIMPAR
                        FILTROS</a>
                </div>
            </form>
            <!-- Resultados -->
            <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 mt-10 shadow-xl font-mono">
                <h3 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide text-center font-mono">LISTA DE REGISTO DE SAÍDAS
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] divide-y divide-slate-600 rounded-lg overflow-hidden font-mono">
                        <thead class="bg-slate-800">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Evento</th>
                                <th
                                    class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Colaborador(es)</th>
                                <th
                                    class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Função(ões)</th>
                                <th
                                    class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Kits Levantados</th>
                                <th
                                    class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Data Registo</th>
                                <th
                                    class="px-4 py-3 text-center text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($checkouts as $checkout)
                                <tr class="border-b border-slate-600 hover:bg-slate-600 transition font-mono">
                                    <td class="px-4 py-2 font-mono">
                                        {{ $checkout->nome_servico ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        @foreach ($checkout->funcionarios as $func)
                                            <div>{{ $func->nome }}</div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        @foreach ($checkout->funcionarios as $func)
                                            <div>
                                                {{ optional($func->funcoes->where('cod_funcao', $func->pivot->funcao_no_servico)->first())->funcao ??
                                                    (optional(\App\Models\Funcao::find($func->pivot->funcao_no_servico))->funcao ?? '-') }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        @foreach ($checkout->kits as $kit)
                                            <div>{{ $kit->nome_kit }}</div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        {{ \Carbon\Carbon::parse($checkout->data_check_out ?? $checkout->created_at)->format('d/m/Y ') }}
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        <div class="flex flex-row flex-nowrap gap-2 items-center justify-center">
                                            <a href="{{ route('servicos.show', $checkout->cod_servico) }}"
                                                class="w-10 h-10 flex items-center justify-center bg-sky-800 hover:bg-slate-700 text-white rounded font-mono shadow transition"
                                                title="Ver Evento">
                                                <img src="{{ asset('images/pesquisar.png') }}" alt="Ver Evento" class="w-5 h-5" />
                                            </a>
                                            <a href="{{ route('servicos.checkout.edit', $checkout->cod_servico) }}"
                                                class="w-10 h-10 flex items-center justify-center bg-sky-800 text-white rounded hover:bg-slate-700 font-mono shadow transition"
                                                title="Editar">
                                                <img src="{{ asset('images/edit.png') }}" alt="Editar" class="w-5 h-5" />
                                            </a>
                                            <form action="{{ route('servicos.checkout.destroy', $checkout->cod_servico) }}"
                                                method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-10 h-10 flex items-center justify-center bg-slate-800 text-white rounded hover:bg-sky-800 shadow transition"
                                                    onclick="return confirm('Tem certeza que deseja eliminar este check-out? Esta ação é irreversível!')"
                                                    title="Eliminar">
                                                    <img src="{{ asset('images/lixo.png') }}" alt="Eliminar" class="w-5 h-5" />
                                                </button>
                                            </form>
                                            <a href="mailto:?subject=PDF%20do%20Evento%20{{ urlencode($checkout->nome_servico ?? '') }}&body=Segue%20o%20link%20para%20o%20PDF%20do%20evento:%20{{ urlencode(route('servicos.pdf', $checkout->cod_servico)) }}"
                                                class="w-10 h-10 flex items-center justify-center bg-sky-800 hover:bg-slate-700 text-white rounded font-mono shadow transition"
                                                title="Enviar por Email">
                                                <img src="{{ asset('images/email.png') }}" alt="Email" class="w-5 h-5" />
                                            </a>
                                            <a href="https://wa.me/?text={{ urlencode('Segue o link para o PDF do evento: ' . route('servicos.pdf', $checkout->cod_servico)) }}"
                                                target="_blank"
                                                class="w-10 h-10 flex items-center justify-center bg-sky-800 hover:bg-slate-700 text-white rounded font-mono shadow transition"
                                                title="Enviar por WhatsApp">
                                                <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="w-5 h-5" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-4 py-2 text-center text-slate-400 font-mono border-b border-slate-600">
                                        Nenhum check-out encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
