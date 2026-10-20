# Configuration de l'envoi d'emails - Khara Consulting

## Configuration requise

Pour que le formulaire de contact fonctionne correctement, vous devez configurer l'envoi d'emails dans votre fichier `.env`.

### Option 1 : Configuration SMTP (Recommandé pour la production)

Ajoutez ces lignes dans votre fichier `.env` :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-application
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contact@khara-consulting.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Pour Gmail :**
- Vous devez activer les "Mots de passe d'application" dans votre compte Google
- Utilisez le mot de passe d'application, pas votre mot de passe Gmail normal

**Pour d'autres fournisseurs SMTP :**
- Outlook/Hotmail : `smtp-mail.outlook.com` (port 587)
- Yahoo : `smtp.mail.yahoo.com` (port 587)
- Serveur personnalisé : Utilisez les paramètres de votre hébergeur

### Option 2 : Configuration avec Mailgun (Recommandé pour la production)

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=votre-domaine.mailgun.org
MAILGUN_SECRET=votre-cle-secrete-mailgun
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS=contact@khara-consulting.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Option 3 : Mode développement (Log uniquement)

Pour le développement local, vous pouvez utiliser le mode "log" qui enregistre les emails dans les logs :

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=contact@khara-consulting.com
MAIL_FROM_NAME="${APP_NAME}"
```

Les emails seront enregistrés dans `storage/logs/laravel.log`.

## Fonctionnalités implémentées

✅ **Validation complète** du formulaire avec messages d'erreur personnalisés
✅ **Sauvegarde en base de données** de tous les contacts
✅ **Envoi d'email à l'administrateur** avec toutes les informations
✅ **Email de confirmation** automatique au client
✅ **Messages de succès/erreur** affichés dans l'interface
✅ **Gestion des erreurs** avec logs

## Structure de la base de données

La table `contacts` contient :
- Informations personnelles (nom, email, téléphone, WhatsApp)
- Type de profil
- Besoins sélectionnés (array JSON)
- Budget estimé
- Message
- Consentements
- Statut d'envoi d'email

## Test du formulaire

1. Remplissez le formulaire de contact
2. Vérifiez que vous recevez l'email de confirmation
3. Vérifiez que l'administrateur reçoit l'email de notification
4. Vérifiez dans la base de données que le contact est bien enregistré

## Dépannage

Si les emails ne sont pas envoyés :
1. Vérifiez la configuration dans `.env`
2. Vérifiez les logs dans `storage/logs/laravel.log`
3. Testez avec le mode "log" pour voir si le problème vient de la configuration SMTP
4. Vérifiez que votre serveur peut envoyer des emails (ports 25, 587, 465 non bloqués)

