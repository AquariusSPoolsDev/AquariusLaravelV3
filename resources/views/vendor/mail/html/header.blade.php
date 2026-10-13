@props(['url'])
{{-- Matches the admin panel's brand (filament/components/logo.blade.php). Email apps need a full image URL and inline styles. --}}
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
<table role="presentation" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
<tr>
<td style="padding-right: 10px; vertical-align: middle;">
<img src="{{ rtrim(config('app.url'), '/') }}/assets/favicon/aquarius-logo-192.png" width="40" height="40" alt="Aquarius Swimming Pools logo" style="display: block; width: 40px; height: 40px; border: 0;">
</td>
<td style="vertical-align: middle; text-align: left; line-height: 1.25;">
<span style="display: block; color: #1f2937; font-size: 17px; font-weight: 700;">{{ $slot }}</span>
<span style="display: block; color: #9ca3af; font-size: 13px; font-weight: 600;">Admin Panel</span>
</td>
</tr>
</table>
</a>
</td>
</tr>
