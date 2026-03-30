-- Insertion d'articles d'exemple
USE news_db0000;

INSERT INTO articles (title, content, created_at) VALUES
(
    'La situation actuelle en Iran : Un regard géopolitique',
    'La République Islamique d\'Iran est actuellement au cœur de nombreux enjeux géopolitiques majeurs. Cette analyse examine les acteurs principaux et les dynamiques régionales qui façonnent la situation actuelle.

Les relations internationales et les tensions avec les puissances régionales créent un contexte complexe. Les principales parties prenantes incluent les gouvernements des États-Unis, d\'Israël, de l\'Arabie Saoudite et des puissances régionales plus petites.

Cette situation a des répercussions importantes sur la stabilité du Moyen-Orient et les économies mondiales, notamment concernant les prix du pétrole et la libre circulation des marchandises.',
    NOW()
),
(
    'Les acteurs principaux et leur influence',
    'Plusieurs acteurs clés jouent un rôle déterminant dans la configuration de la politique du Moyen-Orient:

1. Les États-Unis: Puissance mondiale avec des intérêts stratégiques significatifs dans la région
2. Israël: Acteur régional important avec des intérêts sécuritaires clairement définis
3. L\'Arabie Saoudite: Puissance régionale majeure influençant la politique du Golfe
4. Les factions régionales: Diverses millices et groupes influent sur la dynamique locale
5. La Russie et la Chine: Acteurs intervenants avec leurs propres intérêts stratégiques

La compréhension de ces acteurs est essentielle pour saisir les enjeux actuels et futurs.',
    NOW() - INTERVAL 2 DAY
),
(
    'Analyse des tensions récentes et causes profondes',
    'Les tensions actuelles ne sont pas nouvelles mais résultent de décennies de conflits géopolitiques et de rivalités régionales. Les causes profondes incluent:

- Les enjeux nucléaires et la sécurité régionale
- Les luttes d\'influence pour le contrôle des routes commerciales
- Les différences idéologiques et religieuses
- Les intérêts économiques liés aux ressources pétrolières
- Les rivalités entre puissances régionales

Ces facteurs créent un environnement volatile où même des incidents mineurs peuvent avoir des conséquences majeures.',
    NOW() - INTERVAL 5 DAY
),
(
    'Impact économique des tensions au Moyen-Orient',
    'Les tensions géopolitiques en Iran et dans la région ont un impact économique global significatif:

Les prix du pétrole restent sensibles à toute perturbation du Détroit d\'Ormuz, par où passe environ 20% du pétrole mondial. Toute escalade pourrait entraîner une augmentation rapide des prix énergétiques.

Le commerce international est également affecté, avec des routes commerciales critiques passant à proximité des zones sensibles. Les entreprises doivent adapter leurs stratégies de chaîne d\'approvisionnement.

Les investisseurs observent de près la région, craignant des perturbations qui pourraient affecter les marchés financiers mondiaux.',
    NOW() - INTERVAL 7 DAY
),
(
    'Perspectives et évolutions possibles',
    'En regardant vers l\'avenir, plusieurs scénarios sont possibles:

Dialogue diplomatique: Une réouverture des négociations pourrait atténuer les tensions
Statut quo maintenu: Les tensions actuelles pourraient persister sans escalade majeure
Escalade progressive: Une série d\'incidents pourrait mener à une confrontation directe
Résolution externe: L\'intervention d\'acteurs externes pourrait modifier la dynamique

Chaque scenario aurait des implications profondément différentes pour la région et le monde.',
    NOW() - INTERVAL 10 DAY
),
(
    'Rôle de la communauté internationale',
    'La communauté internationale joue un rôle crucial dans la gestion des tensions au Moyen-Orient.

Les Nations Unies, malgré leurs limitations, restent un forum important pour le dialogue. Les puissances mondiales utilisent divers canaux, des négociations bilatérales aux organisations régionales.

La diplomatie reste un outil vital pour prévenir une escalade incontrôlée. Les acteurs internationaux doivent équilibrer leurs différents intérêts tout en cherchant à promouvoir la stabilité et la paix.

Cette situation souligne l\'importance de la coopération internationale et du multilatéralisme dans la résolution des crises régionales.',
    NOW() - INTERVAL 12 DAY
);
