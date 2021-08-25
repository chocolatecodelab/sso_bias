<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src={{ asset('image/logo-bias.png') }} class="logo" alt="Bias Education">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
