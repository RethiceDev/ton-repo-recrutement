<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registre d’Arrivée · Planetech Recrutement</title>

    {{-- Police --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind CSS (CDN) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="min-h-full bg-emerald-50 font-sans text-slate-800 antialiased">

    {{-- Fond décoratif discret --}}
    <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-emerald-200/50 blur-3xl"></div>
        <div class="absolute -bottom-40 -right-32 h-[28rem] w-[28rem] rounded-full bg-emerald-300/30 blur-3xl"></div>
    </div>

    <main class="flex min-h-screen items-center justify-center px-4 py-8 sm:px-6 sm:py-12">
        <div class="w-full max-w-md">

            {{-- Carte --}}
            <section class="overflow-hidden rounded-3xl border border-emerald-100 bg-white shadow-xl shadow-emerald-900/5">

                {{-- Liseré supérieur --}}
                <div class="h-1.5 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-800"></div>

                <div class="p-6 sm:p-9">

                    {{-- En-tête --}}
                    <header class="mb-8">
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3.5 py-1.5 text-xs font-semibold text-emerald-800 ring-1 ring-inset ring-emerald-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                            Planetech Recrutement
                        </span>

                        <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                            Registre d’Arrivée
                        </h1>
                        <p class="mt-2.5 text-[15px] leading-relaxed text-slate-500">
                            Vous êtes arrivé(e) pour un entretien ? Renseignez les informations ci-dessous afin que nous vous enregistrions.
                        </p>
                    </header>

                    {{-- Message de succès --}}
                    @if (session('success'))
                        <div id="success-alert" role="status"
                             class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-700 text-white">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-emerald-900">Arrivée enregistrée</p>
                                <p class="mt-0.5 text-sm text-emerald-800/80">{{ session('success') }}</p>
                            </div>
                            <button type="button" onclick="document.getElementById('success-alert').remove()"
                                    class="rounded-lg p-1 text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600"
                                    aria-label="Fermer le message">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{-- Erreur globale --}}
                    @if ($errors->any())
                        <div role="alert" class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                            </svg>
                            <p class="text-sm text-red-800">Certains champs sont à corriger avant de valider.</p>
                        </div>
                    @endif

                    {{-- Formulaire --}}
                    <form id="registre-form" method="POST" action="{{ route('recrutement.store') }}" class="space-y-5" novalidate>
                        @csrf

                        {{-- Nom --}}
                        <div>
                            <label for="nom" class="mb-1.5 block text-sm font-medium text-slate-600">Nom</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.5-1.632z"/>
                                    </svg>
                                </span>
                                <input type="text" id="nom" name="nom" value="{{ old('nom') }}"
                                       placeholder="Ex : Adjovi" autocomplete="family-name" required
                                       class="block w-full rounded-xl border bg-slate-50/60 py-3.5 pl-12 pr-4 text-[15px] text-slate-900 placeholder:text-slate-400 transition focus:bg-white focus:outline-none focus:ring-4
                                              {{ $errors->has('nom') ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-slate-200 focus:border-emerald-600 focus:ring-emerald-100' }}">
                            </div>
                            @error('nom')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Prénom(s) --}}
                        <div>
                            <label for="prenoms" class="mb-1.5 block text-sm font-medium text-slate-600">Prénom(s)</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
                                    </svg>
                                </span>
                                <input type="text" id="prenoms" name="prenoms" value="{{ old('prenoms') }}"
                                       placeholder="Ex : Marie Claire" autocomplete="given-name" required
                                       class="block w-full rounded-xl border bg-slate-50/60 py-3.5 pl-12 pr-4 text-[15px] text-slate-900 placeholder:text-slate-400 transition focus:bg-white focus:outline-none focus:ring-4
                                              {{ $errors->has('prenoms') ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-slate-200 focus:border-emerald-600 focus:ring-emerald-100' }}">
                            </div>
                            @error('prenoms')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Poste visé --}}
                        <div>
                            <label for="poste" class="mb-1.5 block text-sm font-medium text-slate-600">Poste visé</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                                    </svg>
                                </span>
                                <input type="text" id="poste" name="poste" value="{{ old('poste') }}"
                                       placeholder="Ex : Développeur, Commercial, Technicien…" required
                                       class="block w-full rounded-xl border bg-slate-50/60 py-3.5 pl-12 pr-4 text-[15px] text-slate-900 placeholder:text-slate-400 transition focus:bg-white focus:outline-none focus:ring-4
                                              {{ $errors->has('poste') ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-slate-200 focus:border-emerald-600 focus:ring-emerald-100' }}">
                            </div>
                            @error('poste')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bouton --}}
                        <button type="submit" id="submit-btn"
                                class="group mt-2 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-4 text-base font-semibold text-white shadow-lg shadow-emerald-700/25 transition duration-200 hover:bg-emerald-800 hover:shadow-xl hover:shadow-emerald-800/30 focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-70">
                            <svg id="btn-spinner" class="hidden h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span id="btn-label">Enregistrer mon arrivée</span>
                        </button>
                    </form>
                </div>
            </section>

            {{-- Pied de page --}}
            <p class="mt-6 text-center text-xs text-slate-500">
                © {{ date('Y') }} PLANETECH SARL · recrutement.planetexal.com
            </p>
        </div>
    </main>

    <script>
        // Empêche les doubles envois et affiche un état de chargement
        const form = document.getElementById('registre-form');
        form.addEventListener('submit', function () {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            document.getElementById('btn-spinner').classList.remove('hidden');
            document.getElementById('btn-label').textContent = 'Enregistrement…';
        });

        // Le message de succès disparaît après 8 secondes
        const alertBox = document.getElementById('success-alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.transition = 'opacity .4s';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 400);
            }, 8000);
        }
    </script>
</body>
</html>
