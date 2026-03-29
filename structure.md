news-site/                  ← racine du projet
│
├── docker/                 ← fichiers Docker
│   ├── apache/             ← build PHP + Apache
│   │   └── Dockerfile
│   └── mysql/              ← initialisation MySQL
│       └── init.sql
│
├── src/                    ← code PHP / site web
│   ├── admin/              ← back-office
│   │   ├── create_article.php
│   │   ├── edit_article.php
│   │   ├── delete_article.php
│   │   ├── login.php
│   │   └── dashboard.php
│   │
│   ├── config/             ← configuration PHP
│   │   └── db.php
│   │
│   ├── public/             ← front-office
│   │   ├── index.php
│   │   └── article.php
│   │
│   └── .htaccess           ← SEO friendly URLs
│
├── tinymce/                ← TinyMCE local (self-hosted)
│   ├── tinymce.min.js
│   ├── plugins/
│   ├── skins/
│   └── ...                 ← fichiers TinyMCE complets
│
└── docker-compose.yml      ← orchestration Docker