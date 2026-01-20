@php
    /**
     * Variables attendues :
     * - $url (string) : le lien de connexion (magic link)
     * - $expiresInMinutes (int|null) : durée de validité (facultatif)
     * - $recipientName (string|null) : nom/alias du destinataire (facultatif)
     */
    $appName = config('app.name', 'Les Derniers de Solace');
@endphp

<x-mail-layout
    :preheader="'Votre lien de connexion sécurisé pour ' . $appName"
>
    <h1 style="margin:0 0 10px 0;font-size:20px;line-height:1.25;color:#4C4944;">
        Connexion à {{ $appName }}
    </h1>

    <p style="margin:0 0 16px 0;">
        @if(!empty($recipientName))
            Bonjour {{ $recipientName }},
        @else
            Bonjour,
        @endif
        <br>
        Voici votre lien de connexion sécurisé.
    </p>

    <div style="margin:22px 0 18px 0;">
        <a href="{{ $url }}"
           style="
             display:inline-block;
             background:#9E5E2A;
             color:#FCFBF9;
             text-decoration:none;
             padding:12px 18px;
             border-radius:12px;
             font-weight:600;
             font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial;
           ">
            Se connecter
        </a>
    </div>

    @if(!empty($expiresInMinutes))
        <p style="margin:0 0 14px 0;color:#7B766F;font-size:13px;">
            Ce lien expirera dans {{ $expiresInMinutes }} minutes.
        </p>
    @endif

    <p style="margin:0 0 10px 0;color:#7B766F;font-size:13px;">
        Si le bouton ne fonctionne pas, copiez/collez ce lien dans votre navigateur :
    </p>

    <p style="margin:0 0 18px 0;word-break:break-all;font-size:13px;">
        <a href="{{ $url }}" style="color:#326B76;text-decoration:underline;">
            {{ $url }}
        </a>
    </p>

    <hr style="border:0;border-top:1px solid #F2EBE2;margin:18px 0;">

    <p style="margin:0;color:#AAA39A;font-size:12px;">
        Si vous n’avez pas demandé ce lien, vous pouvez ignorer cet email.
    </p>
</x-mail-layout>
