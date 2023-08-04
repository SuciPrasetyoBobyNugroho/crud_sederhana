@extends('layout.template')

        <!-- START DATA -->
        @section('content')
            
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            
            <form action="{{ route('rumahsakit.index') }}" method="get">
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ app('request')->input('date_from') }}">
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="">Date To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ app('request')->input('date_to') }}">
                    </div>
                    <div class="col-md-2 form-group" style="margin-top:25px;">
                        <input type="submit" class="btn btn-primary" value="Search">
                    </div>
                </div>
            </form>

             <!-- TOMBOL TAMBAH DATA DAN REFRESH -->
             <div class="pb-3 mt-2 d-flex justify-content-start">
                <div class="btn-group mr-2" role="group">
                    <a href="{{url('rumahsakit/create')}}" class="btn btn-primary rounded">+ Add Data</a>
                    <a href="{{url('rumahsakit')}}" class="btn btn-success mx-3 rounded">Refresh</a>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                     <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Mother Name</th>
                        <th class="text-center">Mother Age</th>
                        <th class="text-center">Infant Gender</th>
                        <th class="text-center">Infant Birth date and time</th>
                        <th class="text-center">Gestational Age (in weeks)</th>
                        <th class="text-center">Height</th>
                        <th class="text-center">Weight</th>
                    </tr>
                </thead>
                </thead>
                <tbody>
                    <?php $i =$data->firstItem() ?>
                    @foreach ($data as $item)    
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{$item->mother_name}}</td>
                        <td class="text-center">{{$item->mother_age}}</td>
                        <td class="text-center">{{$item->infant_gender}}</td>
                        <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->infant_birth_datetime)->locale('id')->isoFormat('D MMMM Y, HH:mm') }}</td>
                        <td class="text-center">{{$item->gestational_age_weeks}}</td>
                        <td class="text-center">{{$item->height_cm}}</td>
                        <td class="text-center">{{ number_format($item->weight_kg, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ url('rumahsakit/'.$item->mother_name.'/edit') }}" class="btn btn-warning btn-sm mx-2 rounded">Edit</a>
                                <form onsubmit="return confirm('Are you sure you want to delete the data?')" class="d-inline" action="{{ url('rumahsakit/'.$item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm ml-1">Del</button>
                                </form>
                            </div>
                        </td>
                        
                        
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                @if (isset($avgWeightMaleByDateAndGender) && isset($countMaleByDateAndGender) && isset($avgWeightFemaleByDateAndGender) && isset($countFemaleByDateAndGender))
                    @if ($dateFrom && $dateTo)
                        <p>Nilai rata-rata berat badan untuk jenis kelamin male dari tanggal {{ $dateFrom }} hingga {{ $dateTo }}:<span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;"> {{ number_format($avgWeightMaleByDateAndGender, 2, ',', '.') }} kg </span></p>
                        <p>Jumlah data jenis kelamin male dari tanggal {{ $dateFrom }} hingga {{ $dateTo }}: <span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;"> {{ $countMaleByDateAndGender }}</span></p>
                        <p>Nilai rata-rata berat badan untuk jenis kelamin female dari tanggal {{ $dateFrom }} hingga {{ $dateTo }}:<span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;"> {{ number_format($avgWeightFemaleByDateAndGender, 2, ',', '.') }} kg</span></p>
                        <p>Jumlah data jenis kelamin female dari tanggal {{ $dateFrom }} hingga {{ $dateTo }}:<span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;">  {{ $countFemaleByDateAndGender }}</span></p>
                    @else
                        <p>Nilai rata-rata berat badan untuk semua data:<span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;"> {{ number_format($avgWeightMaleByDateAndGender, 2, ',', '.') }} kg </span></p>
                        <p>Jumlah data jenis kelamin male: <span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;">{{ $countMaleByDateAndGender }}</span></p>
                        <p>Jumlah data jenis kelamin female:<span style="font-size: 24px; color: #FF0000; border-bottom: 2px solid #000000;">  {{ $countFemaleByDateAndGender }}</span></p>
                    @endif
                @endif
            </div>

            {{$data->links()}}
        </div>
        <!-- AKHIR DATA -->
        @endsection
