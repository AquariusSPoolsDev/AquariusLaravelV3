@props(['table_keypoint_title', 'ph_concrete', 'table_concrete_body', 'ph_vinyl', 'table_vinyl_body', 'ph_fiberglass', 'table_fibreglass_body'])

<tr class="body-table-row">
    <th scope="row" class="table-row-keypoint">
        {{ $table_keypoint_title }}
    </th>
    <td class="table-row-concrete">
        <div class="pool-name-title-small">{{__('strings.table_concrete_title')}}:</div>
        <div class="max-lg:w-full">{!! $table_concrete_body !!}</div>
    </td>
    <td class="table-row-vinyl">
        <div class="pool-name-title-small">{{__('strings.table_vinyl_title')}}:</div>
        <div class="max-lg:w-full">{!! $table_vinyl_body !!}</div>
    </td>
    <td class="table-row-fibreglass">
        <div class="pool-name-title-small">{{__('strings.table_fibreglass_title')}}:</div>
        <div class="max-lg:w-full">{!! $table_fibreglass_body !!}</div>
    </td>
</tr>