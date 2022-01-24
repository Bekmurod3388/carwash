@extends('admin.master')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9"><h1 class="card-title">Рабочий</h1></div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" onclick="createBus()">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Добавить Рабочий
                        </button>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-bordered" id="example">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th class="col-3" scope="col">имя и фамилия</th>
                            <th class="col-5" scope="col">Тел</th>
                            <th class="col-5" scope="col">паспорт</th>
                            <th style="width: auto" scope="col">Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($workers as $worker)
                            <tr>
                                <th scope="row" class="col-1">{{$worker->id}}</th>
                                <td>{{$worker->fullname}}</td>
                                <td>{{$worker->phone}}</td>
                                <td>{{$worker->passport}}</td>
                                <td>
                                    <form action="{{route('admin.worker.destroy', ['worker' => $worker])}}" method="post"
                                          id="form_{{$worker->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="createBus('{{$worker->id}}', '{{route('admin.worker.update', ['worker' => $worker])}}')"
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
                        <h5 class="modal-title" id="modalLabel">Добавить Рабочий</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="number">имя и фамилия:</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Тел</label>
                            <input type="text" name="phone" id="phone" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">паспорт</label>
                            <input type="text" name="passport" id="passport" class="form-control" autocomplete="off">
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
                form.attr('action', "{{route('admin.worker.store')}}")
                $('#fullname').val('')
                $('#phone').val('')
                $('#passport').val('')

                // method.val("POST")
            } else {
                method.val("PUT")
                form.attr('action', action)
                $('#fullname').val(val)
                $('#phone').val(val)
                $('#passport').val(val)
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
        $(document).ready( function () {
            $('#example').DataTable(
                {
                    "language": {"url":"//cdn.datatables.net/plug-ins/1.11.3/i18n/ru.json"},
                    "responsive": true
                }
            );
        } );
    </script>
@stop
