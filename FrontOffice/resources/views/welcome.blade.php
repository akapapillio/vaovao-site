<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site d'informations complet et sourcé sur la guerre en Iran, ses origines, son déroulement et ses conséquences géopolitiques mondiales.">
    <!-- Open Graph SEO -->
    <meta property="og:title" content="Informations sur la Guerre en Iran | Vaovao Site">
    <meta property="og:description" content="Site d'informations complet et sourcé sur la guerre en Iran, ses origines, son déroulement et ses conséquences géopolitiques mondiales.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <title>Informations sur la Guerre en Iran | Vaovao Site</title>
    
    <!-- Scripts & Styles Bootstrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Vaovao Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('articles.front') }}">Actualités</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-lg-2 px-3" href="{{ route('articles.index') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container shadow-sm p-4 bg-white rounded">
        
        <!-- H1: Titre Principal -->
        <h1 class="display-5 text-center mb-5 border-bottom pb-3">Dernières Actualités : Guerre en Iran</h1>
        
        <div class="row">
            <div class="col-md-8">
                @forelse($articles as $article)
                    <article class="mb-5 pb-4 border-bottom">
                        <h2 class="text-primary h3">{{ $article->title }}</h2>
                        <div class="text-muted small mb-2">
                            Par <strong>{{ $article->author }}</strong> | Publié le {{ $article->created_at->format('d/m/Y') }}
                        </div>
                        
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid rounded mb-3" style="max-height: 300px; width: 100%; object-fit: cover;">
                        @endif

                        <div class="article-excerpt">
                            {!! Str::limit($article->content, 250) !!}
                        </div>
                        <a href="{{ route('articles.details', ['category' => Str::slug($article->category_name ?? 'divers'), 'slug' => $article->slug, 'id' => $article->id, 'idcat' => $article->category_id ?? 0]) }}" class="btn btn-link p-0 mt-2">Lire la suite...</a>
                    </article>
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted italic">Aucun article n'a été publié pour le moment.</p>
                        <a href="{{ route('articles.create') }}" class="btn btn-primary">Créer le premier article</a>
                    </div>
                @endforelse

                @if($articles->count() > 0)
                    <div class="text-center mt-4">
                        <a href="{{ route('articles.front') }}" class="btn btn-primary px-4">Voir tous les articles anciens</a>
                    </div>
                @endif
            </div>

            <!-- Colonne Image / Sidebar -->
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="sticky-top" style="top: 20px;">
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6>À propos de Vaovao Malaza</h6>
                            <p class="small text-muted">Votre source d'information continue sur les enjeux géopolitiques au Moyen-Orient.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center py-4 mt-5 text-muted small">
        <p class="mb-0">&copy; 2026 Vaovao Site - Mini-projet Web Design</p>
    </footer>

</body>
</html>
