@foreach (range(1, $rows) as $row)
<tr class="animate-pulse">
    @foreach (range(1, $cols) as $col)
    <td class="px-6 py-4 text-sm">
        <span class="block h-3 bg-gray-400 rounded"></span>
    </td>
    @endforeach
</tr>
@endforeach