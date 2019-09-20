@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Student
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                        <div class="">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="{{ route('import_process_student') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('department_id', 'Department Id:') !!}
                                        {!! Form::select('department_id', $department, null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Session Id Field -->
                                    <div class="form-group col-sm-6 pull-right">
                                        {!! Form::label('session_id', 'Session Id:') !!}
                                        {!! Form::select('session_id', $session, null, ['class' => 'form-control']) !!}
                                    </div>
                                    <table class="table">
                                        @if (isset($csv_header_fields))
                                        <tr>
                                            @foreach ($csv_header_fields as $csv_header_field)
                                                <th>{{ $csv_header_field }}</th>
                                            @endforeach
                                        </tr>
                                        @endif
                                        @foreach ($csv_data as $row)
                                            <tr>
                                            @foreach ($row as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                            </tr>
                                        @endforeach
                                        <tr>
                                            @foreach ($csv_data[0] as $key => $value)
                                                <td>
                                                    <select class="form-control" name="fields[{{ $key }}]">
                                                        @foreach (config('app.db_fields') as $db_field)
                                                            <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}"
                                                                @if ($key === $db_field) selected @endif>{{ $db_field }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>

                                    <button type="submit" class="btn btn-primary">
                                        Import Data
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection