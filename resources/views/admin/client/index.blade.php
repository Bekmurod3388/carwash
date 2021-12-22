@extends('admin.master')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9"><h1 class="card-title">Клиент</h1></div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" onclick="createBus()">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Добавить Клиент
                        </button>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-bordered" id="example">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th class="col-3" scope="col">номер</th>
                            <th class="col-5" scope="col">имя рабочего</th>
                            <th class="col-5" scope="col">Цена</th>
                            <th class="col-5" scope="col">статус</th>
                            <th class="col-5" scope="col">Цена</th>
                            <th style="width: auto" scope="col">Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($clients as $client)
                            <tr>
{{--                                price_id','number','worker_id','status','sum--}}
                                <th scope="row" class="col-1">{{$client->id}}</th>
                                <td>{{$client->number}}</td>
                                <td>{{$client->worker->fullname}}</td>
                                <td>{{$client->price->name}}</td>
                                <td>{{$client->status}}</td>
                                <td>{{$client->sum}}</td>
                                <td>
                                    <form action="{{route('admin.client.destroy', ['client' => $client])}}" method="post"
                                          id="form_{{$client->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="createBus('{{$client->id}}', '{{route('admin.client.update', ['client' => $client])}}')"
                                                class="btn btn-warning" type="button" title="Изменить"><i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" onclick="remove(this.parentNode)"
                                                title="Удалить">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.cost.store')}}" method="post" id="firm">
                @csrf
                <input type="hidden" name="_method" id="_method" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Добавить Расходы</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="number">Имя</label>
                            <select class="custom-select" onchange="driver(bus_id)" id="worker_id" name="worker_id">

                                @foreach($workers as $worker)
                                    <option value="{{$worker->id}}">{{$worker->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="number">Цена</label>
                            <select class="custom-select" onchange="driver(bus_id)" id="price_id" name="price_id">

                                @foreach($prices as $price)
                                    <option value="{{$price->id}}">{{$price->sum}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="number">number</label>
                            <input type="text" name="number" id="number" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Итоговая сумма</label>
                            <input type="text" name="status" id="status" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">описание</label>
                            <input type="text" name="sum" id="sum" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#table_search').keyup(function () {
            let qiymat = this.value.toLowerCase();
            $('tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(qiymat) > - 1)
            })
        });
        $(document).ready( function () {
            $('#example').DataTable(
                {
                    "language": {"url":"//cdn.datatables.net/plug-ins/1.11.3/i18n/ru.json"},
                    "responsive": true
                }
            );
        } );

        function createBus(val = '', action = '') {
            let form = $('#firm')
            let method = $('#_method')
            if (val === '') {
                form.attr('action', "{{route('admin.client.store')}}")
                $('#worker_id').val('')
                $('#price_id').val('')
                $('#number').val('')
                $('#sum').val('')
                $('#status').val('')
                // method.val("POST")
            } else {
                method.val("PUT")
                form.attr('action', action)
                $('#worker_id').val(val)
                $('#price_id').val(val)
                $('#number').val(val)
                $('#sum').val(val)
                $('#status').val(val)
            }

            $('#modal').modal()
        }
        function remove(form) {
            Swal.fire({
                title: 'Точно хотите?',
                text: "После удаление всех данные будет потеряны",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dd3333',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Да',
                cancelButtonText: 'Нет'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        title: 'Успешно удалено!',
                        icon: 'success',
                        showConfirmButton: false,
                    });
                }
            });
        }
    </script>
@stop
