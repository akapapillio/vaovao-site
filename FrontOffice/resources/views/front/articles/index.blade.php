<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Archives complètes des articles et actualités de Vaovao Site sur la guerre en Iran.">
    <title>Toutes les Actualités | Vaovao Site</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Vaovao Site</a>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('articles.front') }}">Actualités</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container shadow-sm p-4 bg-white rounded mb-5">
        <h1 class="display-6 mb-4 border-bottom pb-2">Archives des Articles</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @forelse($articles as $article)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" class="card-img-top" alt="{{ $article->title }}" style="height: 180px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 180px;">
                                <span class="small">Pas d'image</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title h6 text-primary">{{ $article->title }}</h5>
                            <p class="card-text small text-muted">
                                {!! Str::limit(strip_tags($article->content), 120) !!}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0 text-muted x-small">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                                <a href="{{ route('articles.details', ['category' => Str::slug($article->category_name ?? 'divers'), 'slug' => $article->slug, 'id' => $article->id, 'idcat' => $article->category_id ?? 0]) }}" class="btn btn-sm btn-link p-0">Lire</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Aucun article dans les archives.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </main>

    <footer class="text-center py-4 mt-5 text-muted small">
        <p class="mb-0">&copy; 2026 Vaovao Site - Mini-projet Web Design</p>
    </footer>

</body>
</html>
