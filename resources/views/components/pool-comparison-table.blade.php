<div class="aquarius-pool-compare-content">
    <table class="aquarius-pool-compare-table">
        <thead class="aquarius-pool-compare-table__head">
            <tr class="table-row-large">
                <th scope="col" class="table-head-keypoints">
                    {{__('strings.table_keypoints_title')}}
                </th>
                <th scope="col" class="table-head-concrete">
                    {{__('strings.table_concrete_title')}}
                </th>
                <th scope="col" class="table-head-vinyl">
                    {{__('strings.table_vinyl_title')}}
                </th>
                <th scope="col" class="table-head-fibreglass">
                    {{__('strings.table_fibreglass_title')}}
                </th>
            </tr>
        </thead>
        <tbody class="aquarius-pool-compare-table__body">

            {{ $slot }}

        </tbody>
    </table>
</div>