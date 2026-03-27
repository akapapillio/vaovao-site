<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site d'informations complet et sourcé sur la guerre en Iran, ses origines, son déroulement et ses conséquences géopolitiques mondiales.">
    <title>Informations sur la Guerre en Iran | Vaovao Site</title>
    
    <!-- Scripts & Styles Bootstrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Vaovao Site FrontOffice</a>
        </div>
    </nav>

    <main class="container shadow-sm p-4 bg-white rounded">
        
        <!-- H1: Titre Principal -->
        <h1 class="display-5 text-center mb-4 border-bottom pb-3">Comprendre la Guerre en Iran</h1>
        
        <div class="row">
            <div class="col-md-8">
                <!-- H2: Sous-titre de section -->
                <h2 class="text-primary mt-4">Contexte Historique</h2>
                <p class="lead">Découvrez les origines complexes de ce conflit qui a façonné le Moyen-Orient.</p>
                
                <!-- H3, H4, H5, H6 pour respecter les consignes SEO / structure sémantique -->
                <h3 class="mt-4">Les acteurs principaux</h3>
                <p>Analyse des forces en présence et de leurs motivations.</p>

                <h4 class="mt-3">Implications régionales</h4>
                <p>Conséquences directes sur les pays frontaliers et la géopolitique locale.</p>

                <h5 class="mt-3">Impact sur l'économie internationale</h5>
                <p>Comment les marchés mondiaux ont réagi face aux événements.</p>

                <h6 class="mt-3 mb-4 text-muted">Auteur : Rédaction Vaovao</h6>
                
            </div>

            <!-- Colonne Image / Sidebar -->
            <div class="col-md-4 mt-4 mt-md-0">
                <!-- Image avec l'attribut ALT exigé par le SEO Lighthouse -->
                <img src="https://via.placeholder.com/400x300.png?text=Guerre+en+Iran" 
                     alt="Illustration représentant la carte de l'Iran et les éléments du conflit" 
                     class="img-fluid rounded border mb-3">
                
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <h6>Optimisation SEO</h6>
                        <ul class="small mb-0 text-muted ps-3">
                            <li>URL Rewriting natif (Laravel)</li>
                            <li>Structure H1 &rarr; H6 respectée</li>
                            <li>Balises Meta complétées</li>
                            <li>Attributs "alt" sur les images</li>
                        </ul>
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
