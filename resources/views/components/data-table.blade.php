<div class="table-responsive">
    <table class="table table-sm table-bordered table-striped table-hover" id="datatable">
        <thead class="table-secondary text-center text-uppercase">
            @foreach ($head as $item)
                @if (!is_array($item))
                <th>{{ $item }}</th>
                @else
                <th>{{ $item['name'] }}</th>
                @endif
            @endforeach
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach ($array as $obj)
            <tr class="text-center text-uppercase">
                @foreach ($head as $item)
                    @if (!is_array($item))
                    <td class="text-center">{{ $obj[$item] }}</td>
                    @else
                    <?php
                        $attrs = explode('.', $item['attr']);
                        $data = $obj->{$attrs[0]};
                        for ($i = 1; $i < count($attrs); $i++)
                            if (!is_null($data)) $data = $data->{$attrs[$i]};
                    ?>
                    <td class="text-center">{{ $data }}</td>
                    @endif
                @endforeach
                <td class="text-center">
                    <a nohref class="link-secondary mx-1" onclick="show({{ $obj->id }})"><i class="bi bi-info-circle-fill"></i></a>
                    <a nohref class="link-secondary mx-1" onclick="edit({{ $obj->id }})"><i class="bi bi-pencil-fill"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
