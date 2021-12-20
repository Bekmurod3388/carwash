@extends('admin.master')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9"><h1 class="card-title">Расходы</h1></div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" onclick="createBus()">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Добавить Расходы
                        </button>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th class="col-3" scope="col">Имя</th>
                            <th class="col-5" scope="col">Цены</th>
                            <th class="col-5" scope="col">считать</th>
                            <th class="col-5" scope="col">Итоговая сумма</th>
                            <th class="col-5" scope="col">описание</th>
                            <th style="width: auto" scope="col">Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($costs as $cost)
                            <tr>
                                <th scope="row" class="col-1">{{$cost->id}}</th>
                                <td>{{$cost->name}}</td>
                                <td>{{$cost->sum}}</td>
                                <td>{{$cost->count}}</td>
                                <td>{{$cost->total_sum}}</td>
                                <td>{{$cost->description}}</td>
                                <td>
                                    <form action="{{route('admin.cost.destroy', ['cost' => $cost])}}" method="post"
                                          id="form_{{$cost->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="createBus('{{$cost->id}}', '{{route('admin.cost.update', ['cost' => $cost])}}')"
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
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Цена</label>
                            <input type="text" name="sum" id="sum" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">считать</label>
                            <input type="text" name="count" id="count" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Итоговая сумма</label>
                            <input type="text" name="total_sum" id="total_sum" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">описание</label>
                            <input type="text" name="description" id="description" class="form-control" autocomplete="off">
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

        function createBus(val = '', action = '') {
            let form = $('#firm')
            let method = $('#_method')
            if (val === '') {
                form.attr('action', "{{route('admin.cost.store')}}")
                $('#name').val('')
                $('#sum').val('')
                $('#count').val('')
                $('#total_sum').val('')
                $('#description').val('')
                // method.val("POST")
            } else {
                method.val("PUT")
                form.attr('action', action)
                $('#number').val(val)
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
