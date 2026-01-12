@props([
    'title' => config('app.name', 'Les Derniers de Solace'),
    'logoUrl' => 'https://example.com/logo.png', // à remplacer
    'preheader' => null,
])

    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ $title }}</title>

    <style>
        /* Mobile tweaks */
        @media (max-width: 600px) {
            .container { width: 100% !important; }
            .content { padding: 20px !important; }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#FCFBF9;">
{{-- Preheader (texte d’aperçu dans les boîtes mail) --}}
@if($preheader)
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        {{ $preheader }}
    </div>
@endif

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#FCFBF9;">
    <tr>
        <td align="center" style="padding:28px 16px;">
            <table role="presentation" class="container" width="600" cellspacing="0" cellpadding="0" style="width:600px;max-width:600px;">
                {{-- Header --}}
                <tr>
                    <td align="center" style="padding:0 0 18px 0;">
                        <a href="{{ config('app.url') }}" style="text-decoration:none;display:inline-block;">
                            <img src="{{ $logoUrl }}"
                                 width="56"
                                 height="56"
                                 alt="{{ $title }}"
                                 style="display:block;border:0;outline:none;text-decoration:none;border-radius:12px;">
                        </a>
                        <div style="font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial; font-size:14px; color:#7B766F; margin-top:10px;">
                            {{ $title }}
                        </div>
                    </td>
                </tr>

                {{-- Card --}}
                <tr>
                    <td style="background:#FFFFFF;border:1px solid #F2EBE2;border-radius:16px;">
                        <div class="content" style="padding:28px;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial;color:#4C4944;line-height:1.5;">
                            {{ $slot }}
                        </div>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td align="center" style="padding:18px 6px 0 6px;">
                        <div style="font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial;font-size:12px;color:#AAA39A;line-height:1.4;">
                            © {{ date('Y') }} {{ $title }} — Association de Grandeur Nature<br>
                            Si vous pensez ne pas devoir recevoir ce mail, contactez-nous à <a href="mailto:contact@lesderniersdesolace.com">contact@lesderniersdesolace.com</a>.
                        </div>
                        <div style="height:18px;"></div>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
