<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://drive.google.com/file/d/1XM-MztY6Ginw4MQFSfVDa2-EKmlIishK/view" class="logo" alt="Indicadores">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
