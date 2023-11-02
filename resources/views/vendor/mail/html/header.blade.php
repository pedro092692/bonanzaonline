@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/login.png') }}" class="logo" alt="Bonanza Online Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
