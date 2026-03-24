# 🏥 MediCare Tana — WordPress Theme

> Thème WordPress personnalisé pour clinique médicale — développé par **Bayane**

[![Live Demo](https://img.shields.io/badge/🌐_Live_Demo-Voir_le_site-0a6bb8?style=for-the-badge)](REMPLACER_PAR_LIEN_LIVE)
[![GitHub](https://img.shields.io/badge/GitHub-Code_source-181717?style=for-the-badge&logo=github)](https://github.com/Bayane-max219)

---

## 🔗 Démo en ligne

**URL** : `REMPLACER_PAR_LIEN_LIVE`

| Accès | Identifiant | Mot de passe |
|-------|-------------|--------------|
| Admin WP | `admin` | `Demo1234!` |
| Front-end | _(public)_ | _(aucun)_ |

---

## ✨ Fonctionnalités

| Feature | Technologie |
|---------|-------------|
| Thème 100% custom (sans page builder) | PHP + WordPress Core |
| Custom Post Type : Médecins | `register_post_type()` |
| Custom Post Type : Rendez-vous (DB) | `register_post_type()` |
| Meta boxes personnalisées | `add_meta_box()` |
| Formulaire AJAX sécurisé (nonce) | `wp_ajax` + `Fetch API` |
| Stockage des messages en base de données | `wp_insert_post()` |
| Navigation responsive + burger menu | Vanilla JS |
| Animations au scroll | Intersection Observer |
| SEO : meta descriptions automatiques | `wp_head` hook |
| Performance : suppression du bloat WP | `remove_action()` |
| Google Maps intégré (Alasora) | iframe embed |

---

## 🗂️ Structure du thème

```
medicare-tana/
├── style.css              ← Header du thème (requis par WP)
├── functions.php          ← CPT, hooks, AJAX, helpers
├── index.php              ← Template page d'accueil
├── header.php             ← Navigation + logo SVG unique
├── footer.php             ← Footer + Google Maps
└── assets/
    ├── css/main.css       ← Styles complets (~1100 lignes)
    └── js/main.js         ← Interactions + AJAX contact
```

---

## ⚙️ Installation locale (WAMP)

```bash
# 1. Cloner le repo
git clone https://github.com/Bayane-max219/medicare-tana-wp-theme.git

# 2. Copier dans WordPress
cp -r medicare-tana/ C:/wamp64/www/votre-site/wp-content/themes/

# 3. Activer dans WordPress
# Dashboard → Apparence → Thèmes → Medicare Tana → Activer
```

**Prérequis** : WordPress 6.0+, PHP 7.4+, MySQL 5.7+

---

## 📸 Aperçu

| Section | Fonctionnalité |
|---------|---------------|
| Hero | Image blob animée + statistiques |
| Services | 6 cards avec hover effect |
| Pourquoi nous | Photo clinique + checklist |
| Médecins | CPT dynamique (fallback statique) |
| À propos | Stats + badges flottants |
| Contact | Formulaire AJAX → email + DB |
| Maps | Google Maps — Alasora, Antananarivo |

---

## 👨‍💻 Développeur

**Bayane** — Développeur WordPress / Full-Stack

- 🌐 Portfolio : [miguel-next-portfolio.vercel.app](https://miguel-next-portfolio.vercel.app)
- 📧 Email : baymi312@gmail.com
- 💬 WhatsApp : +261 34 83 498 86
- 📘 Facebook : [Bayane Miguel Singcol](https://www.facebook.com/bayane.miguel.singcol)

---

*Projet portfolio — MediCare Tana, Alasora, Antananarivo, Madagascar*
