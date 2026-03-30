<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Article | Vaovao Site Admin</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Script TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/us935zc410b3tbqo7hn8k4fm45leyzhj0wv8mvu9bqgpoe2y/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#content',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | help'
      });
    </script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Vaovao Site Admin</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
            </div>
        </div>
    </nav>

    <main class="container bg-white p-4 shadow-sm rounded mb-5">
        <div class="mb-4 d-flex justify-content-between">
            <h1>Modifier : {{ $article->title }}</h1>
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Titre de l'article</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="author" class="form-label">Auteur</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $article->author) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">Catégorie SEO</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">Choisir une catégorie...</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ old('category_id', $article->category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label">Changer l'image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    
                    @if($article->image_url)
                        <div class="mt-2 text-center">
                            <img src="{{ $article->image_url }}" alt="Aperçu" class="img-thumbnail" style="max-height: 50px;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label for="content" class="form-label">Contenu (Éditeur TinyMCE)</label>
                <textarea id="content" name="content" class="form-control" rows="10">{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-5">Mettre à jour l'Article</button>
            </div>
        </form>
    </main>
</body>
</html>
