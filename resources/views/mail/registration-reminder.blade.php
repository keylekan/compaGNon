<x-mail-layout>
    <h1 style="margin:0 0 12px 0;">
        {{ $isReminder ? 'Relance d’inscription' : 'Invitation' }} — {{ $event->title }}
    </h1>

    <p style="margin:0 0 12px 0;">
        Bonjour,
    </p>

    <p style="margin:0 0 12px 0;">
        Vous êtes inscrit(e) à l’événement <strong>{{ $event->title }}</strong>,
        mais votre inscription n’est pas encore finalisée.
    </p>

    <p style="margin:0 0 12px 0;">
        Pour finaliser, il vous suffit de créer et d’associer un personnage à votre inscription.
    </p>

    <p style="margin:16px 0;">
        <a href="{{ $ctaUrl }}"
           style="display:inline-block; padding:10px 14px; text-decoration:none; border-radius:8px; background:#b07a2a; color:white;">
            Finaliser mon inscription
        </a>
    </p>

    <p style="margin:16px 0 0 0; font-size:12px; opacity:.8;">
        Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :<br>
        {{ $ctaUrl }}
    </p>
</x-mail-layout>
