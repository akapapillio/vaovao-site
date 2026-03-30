<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Str::limit(strip_tags($article->content), 150) }}">
    <title>{{ $article->title }} | Vaovao Site</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Vaovao Site</a>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('articles.front') }}">Actualités</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container shadow-sm p-4 bg-white rounded mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.front') }}">Actualités</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $article->category_name }}</li>
                    </ol>
                </nav>

                <h1 class="display-4 text-dark mb-3">{{ $article->title }}</h1>
                
                <div class="d-flex align-items-center mb-4 text-muted small">
                    <span class="me-3">Par <strong>{{ $article->author }}</strong></span>
                    <span class="me-3">Publié le {{ $article->created_at->format('d M Y') }}</span>
                    <span class="badge bg-primary">{{ $article->category_name }}</span>
                </div>

                @if($article->image_url)
                    <div class="text-center mb-5">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid rounded shadow-sm" style="max-height: 500px; width: 100%; object-fit: cover;">
                    </div>
                @endif

                <div class="article-content fs-5 leading-relaxed">
                    {!! $article->content !!}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <a href="{{ route('articles.front') }}" class="btn btn-outline-primary">&larr; Retour aux archives</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 mt-5 text-muted small">
        <p class="mb-0">&copy; 2026 Vaovao Site - Mini-projet Web Design</p>
    </footer>

</body>
</html>
