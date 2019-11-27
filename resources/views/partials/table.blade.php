<table class="zero_config table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th></th>
        @foreach ($thead as $th)
            @if (!$loop->last)
                <th>{{ $th }}</th>
            @else
                <th class="no-sort">{{ $th }}</th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $data)
        <tr>
            <td></td>
            @foreach ($data as $d)
                @if(is_array($d))
                    <td class="{{ $d['class'] }}">{!! $d['value'] !!}</td>
                @else
                    <td>{!! $d !!}</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th></th>
        @foreach ($thead as $th)
            <th>{{ $th }}</th>
        @endforeach
    </tr>
    </tfoot>
</table>
